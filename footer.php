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

<?php wp_footer(); ?>

</body>

</html>

