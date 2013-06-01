<?php
/**
 * shortcode.php
 * 
 * this file defines and activates all the themes shortcodes and related features
 *
 * @author Eric Akkerman
 */

//////////////////////////////////////////////////////////////
// Editor Shortcode Button
/////////////////////////////////////////////////////////////
/**
 * Add a button for shortcodes to the WP editor.
 *
 * @access public
 * @return void
 */
function ewd_bootpress_add_shortcode_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) return;
	if ( get_user_option('rich_editing') == 'true') :
		add_filter('mce_external_plugins', 'ewd_bootpress_add_shortcode_tinymce_plugin');
		add_filter('mce_buttons', 'ewd_bootpress_register_shortcode_button');
	endif;
}

/**
 * Register the shortcode button.
 *
 * @access public
 * @param mixed $buttons
 * @return array
 */
function ewd_bootpress_register_shortcode_button($buttons) {
	array_push($buttons, "|", "ewd_bootpress_shortcodes_button");
	return $buttons;
}

/**
 * Add the shortcode button to TinyMCE
 *
 * @access public
 * @param mixed $plugin_array
 * @return array
 */
function ewd_bootpress_add_shortcode_tinymce_plugin($plugin_array) {
	global $echotheme;
	$plugin_array['echothemeShortcodes'] = get_bloginfo('template_url') . '/js/editor_plugin.js';
	return $plugin_array;
}

/**
 * Force TinyMCE to refresh.
 *
 * @access public
 * @param mixed $ver
 * @return int
 */
function ewd_bootpress_refresh_mce( $ver ) {
	$ver += 3;
	return $ver;
}

/**
 * Shortcode buttons
 *
 * @see ewd_bootpress_add_shortcode_button()
 * @see ewd_bootpress_refresh_mce()
 */
add_action( 'init', 'ewd_bootpress_add_shortcode_button' );
add_filter( 'tiny_mce_version', 'ewd_bootpress_refresh_mce' );

//////////////////////////////////////////////////////////////
// Theme Absolute URL Shortcode
/////////////////////////////////////////////////////////////
function absurl_shortcode_func( $atts ){
    return ABSURL;
}
add_shortcode( 'absurl', 'absurl_shortcode_func' );

//////////////////////////////////////////////////////////////
// Carousel Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_carousel( $atts ){
	get_template_part('part', 'carousel-gallery');
}
add_shortcode( 'carousel', 'ewd_bootpress_shortcode_carousel' );

//////////////////////////////////////////////////////////////
// Hero Unit Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_hero($atts, $content = null)
{
	return '<div class="hero-unit">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'hero', 'ewd_bootpress_shortcode_hero' );

//////////////////////////////////////////////////////////////
// Page Header Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_page_header($atts, $content = null)
{
	return '<div class="page-header">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'header', 'ewd_bootpress_shortcode_page_header' );

//////////////////////////////////////////////////////////////
// "Small" Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_small($atts, $content = null)
{
	return '<small>' . do_shortcode($content) . '</small>';
}

add_shortcode( 'small', 'ewd_bootpress_shortcode_small' );

//////////////////////////////////////////////////////////////
// Type Emphasis Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_type_emphasis($atts, $content = null)
{
	extract(shortcode_atts(array(
		'class' => 'text-info'
	), $atts));
	return '<p class="' . $class . '">' . do_shortcode($content) . '</p>';
}

add_shortcode( 'emph', 'ewd_bootpress_shortcode_type_emphasis' );

//////////////////////////////////////////////////////////////
// Lead Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_lead($atts, $content = null)
{
	return '<p class="lead">' . do_shortcode($content) . '</p>';
}
add_shortcode( 'lead', 'ewd_bootpress_shortcode_lead' );

//////////////////////////////////////////////////////////////
// Well Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_well($atts, $content = null)
{
	return '<div class="well">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'well', 'ewd_bootpress_shortcode_well' );

//////////////////////////////////////////////////////////////
// Row Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_column_row($atts, $content = null)
{
	return '<div class="row">' . do_shortcode($content) . '</div>';
}
add_shortcode('row', 'ewd_bootpress_shortcode_column_row');

//////////////////////////////////////////////////////////////
// Grid Column Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_col( $atts, $content = null ) {
	$arr = shortcode_atts(array(
		'span' 		=> false,
		'offset' 	=> false,
		'push' 		=> false,
		'pull' 		=> false
	), $atts);
	
	$class = '';
	
	if ($arr['span']) {
		$class  .= 'span' . $arr['span'];
	}
	
	if ($arr['offset']) {
		$class  .= ' offset' . $arr['offset'];
	}
	
	if ($arr['push']) {
		$class  .= ' push' . $arr['push'];
	}
	
	if ($arr['pull']) {
		$class  .= ' pull' . $arr['pull'];
	}
	
	return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('col', 'ewd_bootpress_shortcode_col');

//////////////////////////////////////////////////////////////
// Thumbnail Section Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_thumbnails($atts, $content)
{
	return '<div class="thumbnails">' . do_shortcode($content) . '</div>';
}
add_shortcode('thumbnails', 'ewd_bootpress_shortcode_thumbnails');

//////////////////////////////////////////////////////////////
// Thumbnail Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_thumbnail($atts, $content)
{
	return '<div class="thumbnail">' . do_shortcode($content) . '</div>';
}
add_shortcode('thumbnail', 'ewd_bootpress_shortcode_thumbnail');

//////////////////////////////////////////////////////////////
// Thumbnail Caption Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_caption($atts, $content)
{
	return '<div class="caption">' . do_shortcode($content) . '</div>';
}
add_shortcode('caption', 'ewd_bootpress_shortcode_caption');

//////////////////////////////////////////////////////////////
// Clear Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_clear($atts, $content = null)
{
	return '<div class="clearfix"></div>';
}
add_shortcode('clear', 'ewd_bootpress_clear');

//////////////////////////////////////////////////////////////
// Horizontal Rule Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_hr($atts, $content = null)
{
	return '<hr class="" />';
}
add_shortcode('hr', 'ewd_bootpress_hr');

//////////////////////////////////////////////////////////////
// Button Shortcode
/////////////////////////////////////////////////////////////
function ewd_bootpress_shortcode_button($atts, $content)
{
	extract(shortcode_atts(array(
		'style' => null,
		'label' => 'Learn More',
		'url' => null,
		'size' => null,
		'extra' => null,
		'disabled' => null,
		'type' => 'a'
	), $atts));
	
	$class = 'btn';
	
	if ($style) {
		$class .= ' btn-' . $style;
	}
	
	if ($size) {
		$class .= ' btn-' . $size;
	}
	
	if ($extra) {
		$class .= ' ' . $extra;
	}
	
	
	return '<' . $type . ' class="' . strtolower($class) . '" href="' . $url . '"> '. $label . '</' . $type . '>';
}
add_shortcode('button', 'ewd_bootpress_shortcode_button');


//////////////////////////////////////////////////////////////
// Tabs and Toggles
/////////////////////////////////////////////////////////////

// Shortcode: tab
// Usage: [tab title="title 1"]Your content goes here...[/tab]
function ewd_bootpress_tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'	=> '',
    ), $atts));
    global $tabs;
    $tabs[] = array('title' => $title, 'content' => trim(wpautop(do_shortcode($content))));
    return $tabs;
}
add_shortcode('tab', 'ewd_bootpress_tab_func');

/* Shortcode: tabs
 * Usage:   [tabs]
 * 		[tab title="title 1"]Your content goes here...[/tab]
 * 		[tab title="title 2"]Your content goes here...[/tab]
 * 	    [/tabs]
 */
function ewd_bootpress_tabs_func( $atts, $content = null ) {
    global $tabs;
    $tabs = array(); // clear the array
	do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content

    $tabs_nav = '<div class="clear"></div>';
    $tabs_nav .= '<div class="tabs-wrapper">';
    $tabs_nav .= '<ul class="tabs">';
	$tabs_content .= '<ul class="tabs-content">';
    
	foreach ($tabs as $tab => $tab_atts) {
		$id = str_replace(' ', '-', $tab_atts['title']);
		$default = ( $tab == 0 ) ? ' class="active"' : '';
	
		$tabs_nav .= '<li><a href="#'.$id.'"'.$default.'>'.$tab_atts['title'].'</a></li>';
		$tabs_content .= '<li id="'.$id.'"'.$default.'>'.$tab_atts['content'].'</li>';
    }

    $tabs_nav .= '</ul>';
	$tabs_content .= '</ul>';
    $tabs_output .= $tabs_nav . $tabs_content;
    $tabs_output .= '</div><!-- tabs-wrapper end -->';
    $tabs_output .= '<div class="clear"></div>';
	
    return $tabs_output;
}
add_shortcode('tabs', 'ewd_bootpress_tabs_func');

// Shortcode: toggle_content
// Usage: [toggle_content title="Title"]Your content goes here...[/toggle_content]
function ewd_bootpress_toggle( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));

    $html = '<h4 class="slide_toggle"><a href="#">' .$title. '</a></h4>';
    $html .= '<div class="slide_toggle_content" style="display: none;">'.wpautop(do_shortcode($content)).'</div>';
    
	return $html;
}
add_shortcode('toggle_content', 'ewd_bootpress_toggle');

/*//////////////////////////////////////////////////////////
// Message boxes and Block Quotes
//////////////////////////////////////////////////////////*/

function ewd_bootpress_message_box($atts, $content = null)
{
	extract(shortcode_atts(array(
		'type' => 'plain'
	), $atts));
	
	return '<div class="box '.$type.'">'.wpautop($content).'</div>';
}
add_shortcode('box', 'ewd_bootpress_message_box');