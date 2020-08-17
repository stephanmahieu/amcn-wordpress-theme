<?php
/**
 * AMCN Theme functions and definitions (child of Twenty Fourteen)
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
//if ( ! isset( $content_width ) ) {
$content_width = 774;
//}


// Disable auto-embeds for WordPress >= v3.5 (in addition to the "Disable Embeds" plugin)
// Removed embeds are still placed in a <blockquote class>, removing this filter will fix this.
remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
// More removals too make sure nothing happens to links I add to content
remove_shortcode( 'embed' );
remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
remove_action( 'edit_form_advanced', array( $GLOBALS['wp_embed'], 'maybe_run_ajax_cache' ), 8 );


function amcn_theme_enqueue_styles() {
	// get the parent style as a base for further customization
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'amcn_theme_enqueue_styles' );


function amcn_scripts() {
	wp_enqueue_script( 'amcn_fix_navigation', get_stylesheet_directory_uri() . '/js/navigation.js', array('jquery'), '20150315', true );
	wp_enqueue_script( 'amcn_custom_script',  get_stylesheet_directory_uri() . '/js/amcnCustom.js', array('jquery'), '20150315', true );
}
add_action( 'wp_enqueue_scripts', 'amcn_scripts' );


// Use SSL for loading fonts (otherwise refuses to load in FF)
//function amcn_fonts() {
//	//fixed in twentyfourteen v1.5
//	//wp_dequeue_style( 'twentyfourteen-lato' );
//	//wp_enqueue_style( 'twentyfourteen-lato-ssl', amcn_twentyfourteen_lato_font_url(), array(), null );
//
//	//awesome now only used by the 'WP Mailto Links' plugin which already uses the ssl variant
//	//and only loads this when (mail)icons are being used
//	//wp_dequeue_style( 'font-awesome' );
//	//wp_enqueue_style( 'font-awesome-ssl', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
//}
//add_action( 'wp_enqueue_scripts', 'amcn_fonts', 11 );


// Define some AMCN Specific shortcodes (plus TinyMCE editor buttons)
require_once( get_stylesheet_directory() . '/inc/amcn_shortcodes.php');
add_action( 'init', 'register_amcn_shortcodes');
add_action( 'init', 'register_amcn_buttons');


// enable the paste-as-plain-text button by default
function enablePasteAsPlainText( $mceInit ) {
	$mceInit[ 'paste_as_text' ] = true;
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'enablePasteAsPlainText' );

// Add custom editor styling
function amcn_theme_editor_styles() {
	add_editor_style( get_stylesheet_directory_uri() . '/css/custom-editor-style.css' );
}
add_action( 'admin_init', 'amcn_theme_editor_styles' );

// Add custom Gutenberg (block) styling
function amcn_theme_custom_block_styles() {
    wp_enqueue_style( 'amcn_theme_custom_block_styles', get_stylesheet_directory_uri() . '/css/custom-block-styles.css' );
}
add_action( 'enqueue_block_assets', 'amcn_theme_custom_block_styles' );

// Special translation of the twentyfourteen textdomain
function amcn_language_setup() {
    load_child_theme_textdomain( 'twentyfourteen', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'amcn_language_setup' );

// add scroll to top functionality
function amcn_scroll_top_header() {
	wp_enqueue_script( 'amcn_scroll_top_lib', get_stylesheet_directory_uri() . '/js/scroll-top.js', array('jquery'), '20150315', true );
	wp_enqueue_style(  'amcn_scroll_top_css', get_stylesheet_directory_uri() . '/css/scroll-top.css' );
}
function amcn_scroll_top_footer() {
	echo '<div id="scroll-to-top" title="Naar boven"></div>';
}
add_action( 'wp_enqueue_scripts', 'amcn_scroll_top_header' );
add_action( 'wp_footer', 'amcn_scroll_top_footer' );

// Change the marker for the basic-google-maps-placemarks plugin
function setBGMPDefaultIcon( $iconURL ) {
    return get_stylesheet_directory_uri() . '/images/bgmp-map-marker.png';
}
add_filter( 'bgmp_default-icon', 'setBGMPDefaultIcon' );

/**
 * Add table sort functionality using the (very small) Stupid-Table-Plugin lib
 *
 * @see http://joequery.github.io/Stupid-Table-Plugin/
 * 
 * Example:
 * <table id="simpleTable">
 *   <thead>
 *     <tr>
 *       <th data-sort="int">int</th>
 *       <th data-sort="float">float</th>
 *       <th data-sort="string">string</th>
 *     </tr>
 *   </thead>
 *   <tbody>
 *     ...
 */
function amcn_tablesort_scripts() {
	wp_enqueue_script( 'amcn_tablesort_lib', get_stylesheet_directory_uri() . '/js/stupidtable.min.js', array('jquery'), '20150315', true );
	wp_enqueue_script( 'amcn_tablesort_script', get_stylesheet_directory_uri() . '/js/tablesort.js', array('jquery'), '20150315', true );
	//put styling in amcn-theme style.css
	//wp_enqueue_style('amcn_tablesort_css', get_stylesheet_directory_uri() . '/css/tablesort.css');
}
add_action( 'wp_enqueue_scripts', 'amcn_tablesort_scripts' );
