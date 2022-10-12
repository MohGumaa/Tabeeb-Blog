<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found">

	<?php if (!is_author()) : ?>
		<div class="page-breadcrumb">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
				}
			?>
		</div>
	<?php endif; ?>

	<h1 class="page-title mb-3 mb-md-4"><?php esc_html_e( 'لم يتم العثور على شيء', 'understrap' ); ?></h1>

	<div class="page-content mb-5 mb-md-3">
		<?php if ( is_search() ) : ?>
			<?php 
				printf(
					'<p class="text-secondary mb-3">%s<p>',
					esc_html__( 'آسف, ولكن لا شيء يطابق مصطلحات البحث الخاصة بك. يرجى المحاولة مرة أخرى مع بعض الكلمات الرئيسية المختلفة.', 'understrap' )
				);	
			?>
		<?php else :?>
			<?php 
			printf(
				'<p class="text-secondary mb-3">%s<p>',
				esc_html__('عذراً، لم يتم العثور على نتائج بخصوص الأرشيف المطلوب، ربما يساعدك البحث في العثور على نتائج مناسبة.', 'understrap' )
			);
			?>
		<?php endif; ?>

		<?php get_search_form(); ?>

		<?php 
			$args = array( 
				'posts_per_page'   => 8,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'category__not_in' => array(92),

				// required by PVC
				'suppress_filters' => false,
				'orderby' => 'post_views',
				'fields' => ''
			); 

			$tabeeb_popular_posts = new WP_Query( $args );

			if ( $tabeeb_popular_posts->have_posts() ) :
				$special_loop = 1;
		?>
			<div class="section-box-header bg-white mt-5">
				<h2 class="text-info mb-0 section-title"><?php esc_html_e( 'مقالات مقترحة', 'understrap' ); ?></h2>
			</div>

			<div class="row gx-3">
				<?php while ( $tabeeb_popular_posts->have_posts() ) : $tabeeb_popular_posts->the_post();?>
					<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3 <?php echo ($special_loop == 7 or $special_loop == 8) ? 'd-block d-md-none d-lg-block' : '' ; ?> card-box card-br">
						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							<div class="card h-100">
								<a href="<?php the_permalink();?>" class="card-img-top">
									<?php echo get_the_post_thumbnail( $post->ID, 'tabeeb-large' ); ?>
								</a>
								<div class="card-body px-0 pb-0">
									<?php
										the_title(
											sprintf( '<h3 class="card-title mb-0"><a href="%s" rel="bookmark" class="article-title">', esc_url( get_permalink() ) ),
											'</a></h3>'
										);
									?>
								</div>
							</div>
							<?php echo htmlspecialchars(get_primary_category());?>
						</article>
					</div>
				<?php endwhile; ?>
			</div>
			
		<?php endif; wp_reset_postdata(); ?>

	</div>

</section>
