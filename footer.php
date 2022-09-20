<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<footer class="text-center text-light py-2 footer-wrapper">
	<div class="container small">
		<?php understrap_site_info(); ?>
	</div>
</footer>

</div>
<!-- Exit Ads Jubna -->
<div class="JC-WIDGET-DMROOT" data-widget-id="4b64dd833c594558f19c7e9005ec308f"></div>
<script type="text/javascript" async="async" src="https://static.jubnaadserve.com/api/widget.js"></script>

<?php wp_footer(); ?>

</body>

</html>

