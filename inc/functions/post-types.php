<?php 
/**
 * This file controls the post types for the theme
 * it defines the common functions and includes all the other 
 * post-type files
 */

// Define our custom prefix
$prefix = "_echotheme_";

// Define a placeholder for our post types custom meta boxes
$meta_box_groups = array();

// Array of custom post type files to include
$post_types = array(
	'slideshow',
	'works',
	'projects',
	'page'
);

foreach ($post_types as $file) {
	$file = __DIR__ . '/../post-types/' . $file . '.php';

	if (is_file($file)) {
		require_once($file);
	}
}

/**
 * List custom post type taxonomies
 */ 
function echotheme_get_terms( $id = '' ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $post_taxonomies = array();
    $post_type = get_post_type( $id );
    $taxonomies = get_object_taxonomies( $post_type , 'names' );

    foreach ( $taxonomies as $taxonomy ) {
      $term_links = array();
      $terms = get_the_terms( $id, $taxonomy );

      if ( is_wp_error( $terms ) )
        return $terms;

      if ( $terms ) {
        foreach ( $terms as $term ) {
          $link = get_term_link( $term, $taxonomy );
          if ( is_wp_error( $link ) )
            return $link;
          $term_links[] = '<li><span><a href="'.$link.'">' . $term->name . '</a></span></li>';
        }
      }

      $term_links = apply_filters( "term_links-$taxonomy" , $term_links );
      $post_terms[$taxonomy] = $term_links;
    }
    return $post_terms;
  } else {
    return false;
  }
}

/**
 * Output the terms list
 */
function echotheme_get_terms_list( $id = '' , $echo = true ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $my_terms = echotheme_get_terms( $id );
    if ( $my_terms ) {
      $my_taxonomies = array();
      foreach ( $my_terms as $taxonomy => $terms ) {
        $my_taxonomy = get_taxonomy( $taxonomy );
        if ( !empty( $terms ) ) $my_taxonomies[] = implode( $terms);
      }

      if ( !empty( $my_taxonomies ) ) {
	    $output = "";
        foreach ( $my_taxonomies as $my_taxonomy ) {
          $output .= $my_taxonomy . "\n";
        }        
      }

      if ( $echo )
        if(isset($output)) echo $output;
      else
        if(isset($output)) return $output;
    } else {
      return;
    }
  } else {
    return false;
  }
}


/**
 * Callback for add_meta_box to display our inputs
 */
function new_meta_box($post, $metabox) {	
	
	$meta_boxes_inputs = $metabox['args']['inputs'];
	
	foreach($meta_boxes_inputs as $meta_box) {
	
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		if($meta_box_value == "") $meta_box_value = $meta_box['std'];
		
		echo'<div class="meta-field">';
		
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		
		echo'<p><strong>'.$meta_box['title'].'</strong></p>';
		
		if(isset($meta_box['type']) && $meta_box['type'] == 'checkbox') {
		
			if($meta_box_value == 'true') {
				$checked = "checked=\"checked\"";
			} elseif($meta_box['std'] == "true") {	
					$checked = "checked=\"checked\"";	
			} else {
					$checked = "";
			}
		
			echo'<p class="clearfix"><input type="checkbox" class="meta-radio" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="true" '.$checked.' /> ';		
			echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';		
		
		} elseif(isset($meta_box['type']) && $meta_box['type'] == 'textarea')  {			
			
			echo'<textarea rows="4" style="width:98%" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';			
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		} else {
			
			echo'<input style="width:70%"type="text" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" /><br />';		
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		}
		
		echo'</div>';
		
	} // end foreach
		
	echo'<br style="clear:both" />';
	
}

/**
 * Function(hook) for saving any custom meta box data
 */

add_action('save_post', 'save_postdata');

function save_postdata( $post_id ) {
	global $post, $meta_box_groups;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if( defined('DOING_AJAX') && DOING_AJAX ) { //Prevents the metaboxes from being overwritten while quick editing.
		return $post_id;
	}

	if( ereg('/\edit\.php', $_SERVER['REQUEST_URI']) ) { //Detects if the save action is coming from a quick edit/batch edit.
		return $post_id;
	}

	foreach($meta_box_groups as $group) {
		foreach($group as $meta_box) {

			// Verify
			if(isset($_POST[$meta_box['name'].'_noncename'])){
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
					return $post_id;
				}
			}
			
			if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			}

			$data = "";
			if(isset($_POST[$meta_box['name'].'_value'])){
				$data = $_POST[$meta_box['name'].'_value'];
			}
			
			
			if(get_post_meta($post_id, $meta_box['name'].'_value') == "") {
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			} else if ($data != get_post_meta($post_id, $meta_box['name'].'_value', true)) {
				update_post_meta($post_id, $meta_box['name'].'_value', $data);
			} else if ($data == "" || $data == $meta_box['std'] ){
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
			}

		} 
	} 
	
} 