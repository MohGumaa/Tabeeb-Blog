<?php
/**
 * The template for displaying all single calculator
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<div class="bg-white page-wrapper single-post single-calculator" id="single-wrapper">

	<div class="container" id="content" tabindex="-1">
		<div class="page-breadcrumb">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
				}
			?>
		</div>

		<div class="row">

			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'single-calculator' );
				}
				?>

			</main>

			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div>

	</div>

</div>

<?php
get_footer();
