<?php
/**
 * The template for displaying archive pages
 *
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="page-wrapper" id="archive-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php if ( have_posts() ) : ?>

				<div class="page-breadcrumb">
					<?php
						if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
						}
					?>
				</div>

				<div class="row gx-3">

					<?php while ( have_posts() ): 
						the_post();

						get_template_part( 'loop-templates/content', get_post_format() );

					endwhile; 

					else: 
						get_template_part( 'loop-templates/content', 'none' );
					?>

				</div>

			<?php endif; ?>

		</main>

		<?php understrap_pagination(); ?>

	</div>

</div>
<?php
get_footer();
