<?php
if (!class_exists('MultiPostThumbnails')) {
	class MultiPostThumbnails {
		
		public function __construct($args = array()) {
			$this->register($args);
		}
		
		public function register($args = array()) {
			$defaults = array(
				'label' => null,
				'id' => null,
				'post_type' => 'post',
				'priority' => 'low',
			);
			
			$args = wp_parse_args($args, $defaults);
			// Create and set properties
			foreach($args as $k => $v) {
				$this->$k = $v;
			}
			
			// Need these args to be set at a minimum
			if (null === $this->label || null === $this->id) {
				if (WP_DEBUG) {
					trigger_error(sprintf("The 'label' and 'id' values of the 'args' parameter of '%s::%s()' are required", __CLASS__, __FUNCTION__));
				}
				return;
			}
			
			// add theme support if not already added
			if (!current_theme_supports('post-thumbnails')) {
				add_theme_support( 'post-thumbnails' );
			}
			
			add_action('add_meta_boxes', array($this, 'add_metabox'));
			add_filter('attachment_fields_to_edit', array($this, 'add_attachment_field'), 20, 2);
			add_action('admin_head', array($this, 'enqueue_admin_scripts'));
			add_action("wp_ajax_set-{$this->post_type}-{$this->id}-thumbnail", array($this, 'set_thumbnail'));
		}
		
		public function add_metabox() {
			add_meta_box("{$this->post_type}-{$this->id}", __($this->label), array($this, 'thumbnail_meta_box'), $this->post_type, 'side', $this->priority);
		}
	
		public function thumbnail_meta_box() {
			global $post;
			$thumbnail_id = get_post_meta($post->ID, "{$this->post_type}_{$this->id}_thumbnail_id", true);
			echo $this->post_thumbnail_html($thumbnail_id);
		}
		
		public function add_attachment_field($form_fields, $post) {
			$calling_post_id = 0;
			if (isset($_GET['post_id']))
				$calling_post_id = absint($_GET['post_id']);
			elseif (isset($_POST) && count($_POST)) // Like for async-upload where $_GET['post_id'] isn't set
				$calling_post_id = $post->post_parent;
			// check the post type to see if link needs to be added
			$calling_post = get_post($calling_post_id);
			if ($calling_post && $calling_post->post_type != $this->post_type) {
				return $form_fields;
			}
			$ajax_nonce = wp_create_nonce("set_post_thumbnail-{$this->post_type}-{$this->id}-{$calling_post_id}");
			$link = sprintf('<a id="%4$s-%1$s-thumbnail-%2$s" class="%1$s-thumbnail" href="#" onclick="MultiPostThumbnailsSetAsThumbnail(\'%2$s\', \'%1$s\', \'%4$s\', \'%5$s\');return false;">Set as %3$s</a>', $this->id, $post->ID, $this->label, $this->post_type, $ajax_nonce);
			$form_fields["{$this->post_type}-{$this->id}-thumbnail"] = array(
				'label' => $this->label,
				'input' => 'html',
				'html' => $link);
			return $form_fields;
		}
	
		public function enqueue_admin_scripts() {
			?>
			
<script type="text/javascript">			
			function MultiPostThumbnailsSetThumbnailHTML(html, id, post_type){
	jQuery('.inside', '#' + post_type + '-' + id).html(html);
};

function MultiPostThumbnailsSetThumbnailID(thumb_id, id, post_type){
	var field = jQuery('input[value=_' + post_type + '_' + id + '_thumbnail_id]', '#list-table');
	if ( field.size() > 0 ) {
		jQuery('#meta\\[' + field.attr('id').match(/[0-9]+/) + '\\]\\[value\\]').text(thumb_id);
	}
};

function MultiPostThumbnailsRemoveThumbnail(id, post_type, nonce){
	jQuery.post(ajaxurl, {
		action:'set-' + post_type + '-' + id + '-thumbnail', post_id: jQuery('#post_ID').val(), thumbnail_id: -1, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
	}, function(str){
		if ( str == '0' ) {
			alert( setPostThumbnailL10n.error );
		} else {
			MultiPostThumbnailsSetThumbnailHTML(str, id, post_type);
		}
	}
	);
};

function MultiPostThumbnailsSetAsThumbnail(thumb_id, id, post_type, nonce){
	var $link = jQuery('a#' + post_type + '-' + id + '-thumbnail-' + thumb_id);
	$link.text( setPostThumbnailL10n.saving );
	jQuery.post(ajaxurl, {
		action:'set-' + post_type + '-' + id + '-thumbnail', post_id: post_id, thumbnail_id: thumb_id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
	}, function(str){
		var win = window.dialogArguments || opener || parent || top;
		$link.text( setPostThumbnailL10n.setThumbnail );
		if ( str == '0' ) {
			alert( setPostThumbnailL10n.error );
		} else {
			$link.show();
			$link.text( setPostThumbnailL10n.done );
			$link.fadeOut( 2000, function() {
				jQuery('tr.' + post_type + '-' + id + '-thumbnail').hide();
			});
			win.MultiPostThumbnailsSetThumbnailID(thumb_id, id, post_type);
			win.MultiPostThumbnailsSetThumbnailHTML(str, id, post_type);
		}
	}
	);
}			
	</script>		
			<?php
		}
	
		public static function has_post_thumbnail($post_type, $id, $post_id = null) {
			if (null === $post_id) {
				$post_id = get_the_ID();
			}
			if (!$post_id) {
				return false;
			}
			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}
	
		public static function the_post_thumbnail($post_type, $id, $post_id = null, $size = 'post-thumbnail', $attr = '', $link_to_original = false) {
			echo self::get_the_post_thumbnail($post_type, $id, $post_id, $size, $attr, $link_to_original);
		}
	
		public static function get_the_post_thumbnail($post_type, $thumb_id, $post_id = NULL, $size = 'post-thumbnail', $attr = '' , $link_to_original = false) {
			global $id;
			$post_id = (NULL === $post_id) ? $id : $post_id;
			$post_thumbnail_id = self::get_post_thumbnail_id($post_type, $thumb_id, $post_id);
			$size = apply_filters("{$post_type}_{$id}_thumbnail_size", $size);
			if ($post_thumbnail_id) {
				do_action("begin_fetch_multi_{$post_type}_thumbnail_html", $post_id, $post_thumbnail_id, $size); // for "Just In Time" filtering of all of wp_get_attachment_image()'s filters
				$html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );
				do_action("end_fetch_multi_{$post_type}_thumbnail_html", $post_id, $post_thumbnail_id, $size);
			} else {
				$html = '';
			}
			
			if ($link_to_original) {
				$html = sprintf('<a href="%s">%s</a>', wp_get_attachment_url($post_thumbnail_id), $html);
			}
			
			return apply_filters("{$post_type}_{$id}_thumbnail_html", $html, $post_id, $post_thumbnail_id, $size, $attr);
		}
		
		public static function get_the_post_thumbnail_url($post_type, $thumb_id, $post_id = NULL, $size = 'post-thumbnail', $attr = '' , $link_to_original = false) {
			global $id;
			$post_id = (NULL === $post_id) ? $id : $post_id;
			$post_thumbnail_id = self::get_post_thumbnail_id($post_type, $thumb_id, $post_id);
			$img_src = wp_get_attachment_image_src($post_thumbnail_id, "full");
			$img_url = $img_src[0];		
			return $img_url;			
		}
	
		public static function get_post_thumbnail_id($post_type, $id, $post_id) {
			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}
	
		private function post_thumbnail_html($thumbnail_id = NULL) {
			global $content_width, $_wp_additional_image_sizes, $post_ID;
			$set_thumbnail_link = sprintf('<p class="hide-if-no-js"><a title="%1$s" href="%2$s" id="set-%3$s-%4$s-thumbnail" class="thickbox">%%s</a></p>', esc_attr__( "Set {$this->label}" ), get_upload_iframe_src('image'), $this->post_type, $this->id);
			$content = sprintf($set_thumbnail_link, esc_html__( "Set {$this->label}" ));
			if ($thumbnail_id && get_post($thumbnail_id)) {
				$old_content_width = $content_width;
				$content_width = 266;
				if ( !isset($_wp_additional_image_sizes["{$this->post_type}-{$this->id}-thumbnail"]))
					$thumbnail_html = wp_get_attachment_image($thumbnail_id, array($content_width, $content_width));
				else
					$thumbnail_html = wp_get_attachment_image($thumbnail_id, "{$this->post_type}-{$this->id}-thumbnail");
				if (!empty($thumbnail_html)) {
					$ajax_nonce = wp_create_nonce("set_post_thumbnail-{$this->post_type}-{$this->id}-{$post_ID}");
					$content = sprintf($set_thumbnail_link, $thumbnail_html);
					$content .= sprintf('<p class="hide-if-no-js"><a href="#" id="remove-%1$s-%2$s-thumbnail" onclick="MultiPostThumbnailsRemoveThumbnail(\'%2$s\', \'%1$s\', \'%4$s\');return false;">%3$s</a></p>', $this->post_type, $this->id, esc_html__( "Remove {$this->label}" ), $ajax_nonce);
				}
				$content_width = $old_content_width;
			}
			return $content;
		}
	
		public function set_thumbnail() {
			global $post_ID; // have to do this so get_upload_iframe_src() can grab it
			$post_ID = intval($_POST['post_id']);
			if ( !current_user_can('edit_post', $post_ID))
				die('-1');
			$thumbnail_id = intval($_POST['thumbnail_id']);
			check_ajax_referer("set_post_thumbnail-{$this->post_type}-{$this->id}-{$post_ID}");
			if ($thumbnail_id == '-1') {
				delete_post_meta($post_ID, "{$this->post_type}_{$this->id}_thumbnail_id");
				die($this->post_thumbnail_html(NULL));
			}
			if ($thumbnail_id && get_post($thumbnail_id)) {
				$thumbnail_html = wp_get_attachment_image($thumbnail_id, 'thumbnail');
				if (!empty($thumbnail_html)) {
					update_post_meta($post_ID, "{$this->post_type}_{$this->id}_thumbnail_id", $thumbnail_id);
					die($this->post_thumbnail_html($thumbnail_id));
				}
			}
			die('0');
		}
	}
}
		
?>