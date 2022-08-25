<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<div class="bg-white page-wrapper single-post" id="single-wrapper">

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
					get_template_part( 'loop-templates/content', 'single' );
				}
				?>

				<div class="d-flex flex-wrap flex-md-row flex-column justify-content-between align-items-center section-box-header like-section mt-3 mb-4">
					<?php echo do_shortcode("[social]"); ?>
					<div class="d-flex flex-wrap flex-md-row flex-column justify-content-between align-items-center">
						<h4 class="text-primary section-title my-3 my-md-0 ms-0 ms-md-4"><?php echo esc_html_e( 'هل أعجبك هذا المقال', 'understrap' ); ?></h4>
						<?php echo do_shortcode('[posts_like_dislike]');?>
					</div>
				</div>

				<?php get_template_part('loop-templates/content', 'relatedposts'); ?>

			</main>

			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div>

	</div>

</div>

<?php
get_footer();
