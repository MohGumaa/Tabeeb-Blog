<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<title><?php if (is_front_page()) :?> <?php bloginfo('name'); ?> - <?php bloginfo('description'); ?><?php else: ?><?php wp_title(); ?><?php endif; ?></title>
	
	<style>
		@font-face {
			font-family: 'Helvetica-Neue-SKY-Bd';
			src: url(<?php echo get_theme_file_uri( 'fonts/HelveticaBd/Helvetica\ Neue\ W23\ for\ SKY\ Bd.otf' ); ?>);
			src: url(<?php echo get_theme_file_uri( 'fonts/HelveticaBd/Helvetica\ Neue\ W23\ for\ SKY\ Bd.ttf' ); ?>);
			src: url(<?php echo get_theme_file_uri( 'fonts/HelveticaBd/Helvetica\ Neue\ W23\ for\ SKY\ Bd.woff' ); ?>);
			font-weight: bold;
			font-style: normal;
			font-display: swap;
		}

		@font-face {
			font-family: 'Helvetica-Neue-SKY-Reg';
			src: url(<?php echo get_theme_file_uri( 'fonts/HelveticaReg/Helvetica\ Neue\ W23\ for\ SKY\ Reg.otf' ); ?>);
			src: url(<?php echo get_theme_file_uri( 'fonts/HelveticaReg/Helvetica\ Neue\ W23\ for\ SKY\ Reg.ttf' ); ?>);
			src: url(<?php echo get_theme_file_uri( 'fonts/HelveticaReg/Helvetica\ Neue\ W23\ for\ SKY\ Reg.woff' ); ?>);
			font-weight: 400;
			font-style: normal;
			font-display: swap;
		}
	</style>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>

	</header><!-- #wrapper-navbar end -->
