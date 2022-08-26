<?php
/**
 * The main template file
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

?>

<div class="page-wrapper" id="index-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 
					'paged' => $paged,
					'post_type' => 'post',
					'posts_per_page'   => 12,
					'post_status'      => 'publish',
					'category__not_in' => array(92),
				); 

				$tabeeb_latest_topics = new WP_Query( $args );

				if ( $tabeeb_latest_topics->have_posts() ) : 
			?>

				<div class="page-breadcrumb">
					<?php
						if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
						}
					?>
				</div>

				<div class="row gx-3">

					<?php while ( $tabeeb_latest_topics->have_posts() ): 
						$tabeeb_latest_topics->the_post();

						get_template_part( 'loop-templates/content', get_post_format() );

					endwhile; 

					else: 
						get_template_part( 'loop-templates/content', 'none' );
					?>

				</div>

			<?php endif; wp_reset_postdata();?>

		</main>

		<?php understrap_pagination(); ?>

	</div>

</div>

<?php
get_footer();
