<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/tabeeb-custom-post.php',              // Video Post 
	'/live-search.php',                     // Live Search Function Form 
	'/alphabet-generator.php',              // Generate Arabic Letter
	'/primary-category.php',                // Primary Category
	'/likes-shares-icons.php',              // Like & Share Icons
	'/recent-posts-thumbnail.php',          // Recent Post Thumbnail
	'/tabeeb-users.php',                    // Search For Users
	'/load-more-posts.php',                 // Load More Post
	'/post-like.php',                       // Post Like
	'/author-social.php',                   // Author Social Icon
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}

// Deactivate new block editor
function phi_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'phi_theme_support' );

// Change Time to time ago and full publish date for post old than week
function altered_post_time_ago_function() {
	return get_the_date();
}
add_filter( 'the_time', 'altered_post_time_ago_function' );

/**
 * Increase excerpt length to 100.
 *
 * @param $length
 *
 * @return int
 */
function tabeeb_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'tabeeb_excerpt_length', 20 );

// Quality of image
add_filter('jpeg_quality', function($arg){return 100;});

// Set post views to 1 on post save.
add_action('save_post', function ($postId) {
    if ( pvc_get_post_views( $post_id = $postId ) < 1 ){
        pvc_view_post( $post_id = $postId );
    }
});

// Clean Header
function tabeeb_remove_version() {
	return '';
}
add_filter('the_generator', 'tabeeb_remove_version');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function tabeeb_cleanup_query_string( $src ){ 
	$parts = explode( '?', $src ); 
	return $parts[0]; 
} 
add_filter( 'script_loader_src', 'tabeeb_cleanup_query_string', 15, 1 ); 
add_filter( 'style_loader_src', 'tabeeb_cleanup_query_string', 15, 1 );

// Add form to mobile menu
function qode_adding_a_search_form_to_the_mobile_menu( $items, $args ) {
if ( 'mobile' === $args->theme_location ) {
	$start_menu_item = '<li class="menu-item custom-item">' .get_search_form(false). '</li>';
	$items = $start_menu_item . $items;
}
return $items;
}
add_filter( 'wp_nav_menu_items', 'qode_adding_a_search_form_to_the_mobile_menu', 10, 2 );

// Exclude Category From Search
function exclude_category_from_search($query) {
	if ($query->is_search) {
		$cat_id = get_cat_ID('politics');
		$query->set('cat', '-92');
	}
	return $query;
}
add_filter('pre_get_posts','exclude_category_from_search');

// Disable curly smart quotes in post content, comment and title.
remove_filter('the_title', 'wptexturize');
remove_filter('the_content', 'wptexturize');

// ACF Map
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyCrxRhBDWJOIp525SyQC841g9OlmHaceE4';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Tabeeb Calculator
function my_shortcode($atts, $content = null, $tag = '')
{

	ob_start();

	set_query_var('attributes', $atts);

	get_template_part('inc/calculator', 'formula');

	return ob_get_clean();

}
add_shortcode('medical_calculator', 'my_shortcode');