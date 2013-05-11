<?php
/**
 * This file outputs styles as set in the theme options panel
 */
// set root
$root = $_SERVER['DOCUMENT_ROOT'];

if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}

// output content type for CSS
header("Content-type: text/css");
?>