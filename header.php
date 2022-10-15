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
	<meta name="facebook-domain-verification" content="p1puiehj56uqoghwghmjebon8uor1w" />
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

		@font-face {
			font-family: 'icomoon';
			src:  url(<?php echo get_theme_file_uri( 'fonts/icomoon.eot?nutge5' ); ?>);
			src:  url(<?php echo get_theme_file_uri( 'fonts/icomoon.eot?nutge5#iefix' ); ?>) format('embedded-opentype'),
				url( <?php echo get_theme_file_uri( 'fonts/icomoon.ttf?nutge5' ); ?> ) format('truetype'),
				url( <?php echo get_theme_file_uri( 'fonts/icomoon.woff?nutge5' ); ?> ) format('woff'),
				url( <?php echo get_theme_file_uri( 'fonts/icomoon.svg?nutge5#icomoon' ); ?> ) format('svg');
			font-weight: normal;
			font-style: normal;
			font-display: block;
			font-display: swap;
		}

		.article-content strong > a::after {
			content: url('<?php echo get_theme_file_uri( 'images/icon-check.svg' ); ?>');
			padding-right: 2px;
			position: relative;
			top: -10px;
    		left: 0px;
		}

		.mega-first-link-tabeeb > .mega-menu-link , .mega-first-link-tabeeb > .mega-menu-link:hover {
			background-image: url('<?php echo get_theme_file_uri( 'images/kit-medical.svg' ); ?>') !important;
			background-repeat: no-repeat !important; 
			background-position: right !important;
			background-size: 20px !important;
		}
		
		.mega-second-link-tabeeb > .mega-menu-link, .mega-second-link-tabeeb > .mega-menu-link:hover {
			background-image: url('<?php echo get_theme_file_uri( 'images/head-side-medical.svg' ); ?>') !important;
			background-repeat: no-repeat !important; 
			background-position: right !important;
			background-size: 20px !important;
		}

		.mega-third-link-tabeeb > .mega-menu-link, .mega-third-link-tabeeb > .mega-menu-link:hover {
			background-image: url('<?php echo get_theme_file_uri( 'images/baby-tabeeb.svg' ); ?>') !important;
			background-repeat: no-repeat !important; 
			background-position: right !important;
			background-size: 20px !important;
		}

		.mega-fourth-link-tabeeb > .mega-menu-link, .mega-fourth-link-tabeeb > .mega-menu-link:hover {
			background-image: url('<?php echo get_theme_file_uri( 'images/hands-holding-heart.svg' ); ?>') !important;
			background-repeat: no-repeat !important; 
			background-position: right !important;
			background-size: 20px !important;
		}

		.mega-fifth-link-tabeeb > .mega-menu-link, .mega-fifth-link-tabeeb > .mega-menu-link:hover {
			background-image: url('<?php echo get_theme_file_uri( 'images/ballot-check.svg' ); ?>') !important;
			background-repeat: no-repeat !important; 
			background-position: right !important;
			background-size: 20px !important;
		}

		@media screen and (max-width: 991px) {
			.slide-menu .tabeeb-icon:nth-of-type(2) > a::before, .slide-menu .tabeeb-icon:nth-of-type(2) > .sub-menu .slide-menu__backlink::before {
				background: url('<?php echo get_theme_file_uri( 'images/kit-medical-blue.svg' ); ?>') no-repeat center center/contain;
			} 
			
			.slide-menu .tabeeb-icon:nth-of-type(3) > a::before, .slide-menu .tabeeb-icon:nth-of-type(3) > .sub-menu .slide-menu__backlink::before {
				background: url('<?php echo get_theme_file_uri( 'images/head-side-medical-blue.svg' ); ?>') no-repeat center center/contain;
			}

			.slide-menu .tabeeb-icon:nth-of-type(4) > a::before, .slide-menu .tabeeb-icon:nth-of-type(4) > .sub-menu .slide-menu__backlink::before {
				background: url('<?php echo get_theme_file_uri( 'images/baby-tabeeb-blue.svg' ); ?>') no-repeat center center/contain;
			}

			.slide-menu .tabeeb-icon:nth-of-type(5) > a::before, .slide-menu .tabeeb-icon:nth-of-type(5) > .sub-menu .slide-menu__backlink::before {
				background: url('<?php echo get_theme_file_uri( 'images/hands-holding-heart-blue.svg' ); ?>') no-repeat center center/contain;
			}

			.slide-menu .tabeeb-icon:nth-of-type(6) > a::before, .slide-menu .tabeeb-icon:nth-of-type(6) > .sub-menu .slide-menu__backlink::before {
				background: url('<?php echo get_theme_file_uri( 'images/ballot-check-blue.svg' ); ?>') no-repeat center center/contain;
			}	
		}
		
	</style>

	<script> window._izq = window._izq || []; window._izq.push(["init" ]); </script>
    <script src="https://cdn.izooto.com/scripts/fe5a9407d2f874871ab6502742cc1d3634228319.js"></script>
	
	<!-- Google tag (gtag.js) -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-S8SBYDE84L"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-S8SBYDE84L');
	</script> -->

	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '586637989800288');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=586637989800288&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Meta Pixel Code -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<header id="wrapper-navbar" class="fixed-top bg-info text-white header-wrapper">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>

	</header>
