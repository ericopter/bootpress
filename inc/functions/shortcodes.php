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
function echotheme_add_shortcode_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) return;
	if ( get_user_option('rich_editing') == 'true') :
		add_filter('mce_external_plugins', 'echotheme_add_shortcode_tinymce_plugin');
		add_filter('mce_buttons', 'echotheme_register_shortcode_button');
	endif;
}

/**
 * Register the shortcode button.
 *
 * @access public
 * @param mixed $buttons
 * @return array
 */
function echotheme_register_shortcode_button($buttons) {
	array_push($buttons, "|", "echotheme_shortcodes_button");
	return $buttons;
}

/**
 * Add the shortcode button to TinyMCE
 *
 * @access public
 * @param mixed $plugin_array
 * @return array
 */
function echotheme_add_shortcode_tinymce_plugin($plugin_array) {
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
function echotheme_refresh_mce( $ver ) {
	$ver += 3;
	return $ver;
}

/**
 * Shortcode buttons
 *
 * @see echotheme_add_shortcode_button()
 * @see echotheme_refresh_mce()
 */
add_action( 'init', 'echotheme_add_shortcode_button' );
add_filter( 'tiny_mce_version', 'echotheme_refresh_mce' );

/**
 * Shortcodes
 * [foobar]
 */
function absurl_shortcode_func( $atts ){
    return ABSURL;
}
add_shortcode( 'absurl', 'absurl_shortcode_func' );

//////////////////////////////////////////////////////////////
// EchoSlider - IN PROGRESS
/////////////////////////////////////////////////////////////
function echotheme_jquerycycle_shortcode( $atts ){
	ob_start();
	get_template_part('part', 'jquerycycle-gallery');
	return ob_get_clean();
}
add_shortcode( 'jquerycycle', 'echotheme_jquerycycle_shortcode' );

//////////////////////////////////////////////////////////////
// Flexslider Shortcode
/////////////////////////////////////////////////////////////
function echotheme_flexslider_shortcode($atts)
{
	ob_start();
	get_template_part('part', 'flexslider-gallery');
	return ob_get_clean();
}
add_shortcode('flexslider', 'echotheme_flexslider_shortcode');

//////////////////////////////////////////////////////////////
// Nivoslider Shortcode
/////////////////////////////////////////////////////////////
function echotheme_nivoslider_shortcode($atts)
{
	ob_start();
	get_template_part('part', 'nivo-slider');
	return ob_get_clean();
}
add_shortcode('nivoslider', 'echotheme_nivoslider_shortcode');

//////////////////////////////////////////////////////////////
// Button Shortcode
/////////////////////////////////////////////////////////////

function echotheme_button($a) {
	extract(shortcode_atts(array(
		'label' 	=> 'Button Text',
		'id' 	=> '1',
		'url'	=> '',
		'target' => '_parent',		
		'size'	=> '',
		'ptag'	=> false
	), $a));
	
	$link = $url ? $url : get_permalink($id);	
	
	if($ptag) :
		return  wpautop('<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>');
	else :
		return '<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>';
	endif;
	
}
add_shortcode('button', 'echotheme_button');

//////////////////////////////////////////////////////////////
// Column Shortcodes
/////////////////////////////////////////////////////////////

function echotheme_one_third_first( $atts, $content = null ) {
   return '<div class="one-third column alpha">' . wpautop(do_shortcode($content)) . '</div>';
}
add_shortcode('one_third_first', 'echotheme_one_third_first');

function echotheme_one_third( $atts, $content = null ) {
   return '<div class="one-third column">' . wpautop(do_shortcode($content)) . '</div>';
}
add_shortcode('one_third', 'echotheme_one_third');

function echotheme_one_third_last( $atts, $content = null ) {
   return '<div class="one-third column omega">' . wpautop(do_shortcode($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'echotheme_one_third_last');

function echotheme_two_third( $atts, $content = null ) {
   return '<div class="two-thirds column alpha">' . wpautop(do_shortcode($content)) . '</div>';
}
add_shortcode('two_thirds', 'echotheme_two_third');

function echotheme_two_third_last( $atts, $content = null ) {
   return '<div class="two-thirds column omega">' . wpautop(do_shortcode($content)) . '</div><div class="clear"></div>';
}
add_shortcode('two_thirds_last', 'echotheme_two_third_last');

function echotheme_one_half( $atts, $content = null ) {
   return '<div class="eight columns alpha">' . wpautop(do_shortcode($content)) . '</div>';
}
add_shortcode('one_half', 'echotheme_one_half');

function echotheme_one_half_last( $atts, $content = null ) {
   return '<div class="eight columns omega">' . wpautop(do_shortcode($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'echotheme_one_half_last');

function echotheme_clear($atts, $content = null)
{
	return '<br class="clear" />';
}
add_shortcode('clear', 'echotheme_clear');

function echotheme_hr($atts, $content = null)
{
	return '<hr class="" />';
}
add_shortcode('hr', 'echotheme_hr');


//////////////////////////////////////////////////////////////
// Tabs and Toggles
/////////////////////////////////////////////////////////////

// Shortcode: tab
// Usage: [tab title="title 1"]Your content goes here...[/tab]
function echotheme_tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'	=> '',
    ), $atts));
    global $tabs;
    $tabs[] = array('title' => $title, 'content' => trim(wpautop(do_shortcode($content))));
    return $tabs;
}
add_shortcode('tab', 'echotheme_tab_func');

/* Shortcode: tabs
 * Usage:   [tabs]
 * 		[tab title="title 1"]Your content goes here...[/tab]
 * 		[tab title="title 2"]Your content goes here...[/tab]
 * 	    [/tabs]
 */
function echotheme_tabs_func( $atts, $content = null ) {
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
add_shortcode('tabs', 'echotheme_tabs_func');

// Shortcode: toggle_content
// Usage: [toggle_content title="Title"]Your content goes here...[/toggle_content]
function echotheme_toggle( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));

    $html = '<h4 class="slide_toggle"><a href="#">' .$title. '</a></h4>';
    $html .= '<div class="slide_toggle_content" style="display: none;">'.wpautop(do_shortcode($content)).'</div>';
    
	return $html;
}
add_shortcode('toggle_content', 'echotheme_toggle');

/*//////////////////////////////////////////////////////////
// Message boxes and Block Quotes
//////////////////////////////////////////////////////////*/

function echotheme_message_box($atts, $content = null)
{
	extract(shortcode_atts(array(
		'type' => 'plain'
	), $atts));
	
	return '<div class="box '.$type.'">'.wpautop($content).'</div>';
}
add_shortcode('box', 'echotheme_message_box');