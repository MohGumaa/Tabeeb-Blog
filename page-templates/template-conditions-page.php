<?php
/**
 * Template Name: Tabeeb Case Layout
 *
 * Template for displaying a page search of case
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$is_search = count( $_GET );
?>

<div class="page-wrapper condition-page" id="condition-page-wrapper">

	<div class="container" id="content">

		<div class="page-breadcrumb">
			<span id="breadcrumbs">
				<span>
					<span>
						<a href="<?php echo get_home_url(); ?>">الرئيسية</a>
						<span>

							<?php if ( $is_search ) :?>
								<a href="<?php echo get_category_link( sanitize_text_field($_GET['case']) );?>" class="breadcrumb_last">
									<?php echo get_cat_name( $category_id = sanitize_text_field($_GET['case']) );?>
								</a>
							<?php else : ?>
								<a href="<?php echo get_category_link( '82' );?>" class="breadcrumb_last">
									<?php echo get_cat_name( $category_id = '82' );?>
								</a>
							<?php endif; ?>

						</span>
					</span>
				</span>
			</span>
		</div>

		<form action="<?php echo esc_url( get_page_link( 3715 ) ); ?>" class="mb-3 case-search-form">
			<label class="screen-reader-text" for="disease"><?php echo esc_html_x( 'ابحث في الأمراض :', 'label', 'understrap' ); ?></label>
			<div class="input-group">
				<input type="search" 
				class="field search-field form-control border-0 rounded-right" 
				id="disease" name="keyword" 
				value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '';?>" 
				placeholder="<?php echo esc_attr_x( 'ابحث في الأمراض', 'placeholder', 'understrap' ); ?>"  
				required 
				oninvalid="this.setCustomValidity('من فضلك ادخل كلمة البحث')"
				oninput="setCustomValidity('')"
				>
				<input type="hidden" name="case" value="<?php echo  isset( $_GET['case'] ) ? sanitize_text_field($_GET['case']) : ''; ?>">
				<input type="hidden" name="disease" value="<?php echo  isset( $_GET['disease'] ) ? sanitize_text_field($_GET['disease']) : ''; ?>">
				<span class="input-group-append">
					<button class="btn btn-light btn-lg text-info d-flex align-items-center h-100 rounded-left">
						<i class="icon-search me-2 fs-5"></i>
					</button>
				</span>
			</div>
		</form>

		<?php 
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1 ;

			$args = [
				'paged'          => $paged,
				'post_type'      => 'post', 
				'post_status'    => 'publish',
				'posts_per_page' => '12',
				'category__not_in' => array(92),
				
			];

			if ( isset( $_GET['case'] ) ) {    
				if ( ! empty( $_GET['case'] ) ) {
					$args['cat'] =  sanitize_text_field($_GET['case']); 
				}
			}

			if ( isset( $_GET['disease'] ) ) {    
				if ( ! empty( $_GET['disease'] ) ) {
					$args['meta_key'] =  sanitize_text_field($_GET['disease']);
					$args['meta_value'] = '1'; 
				}
			}

			if ( isset( $_GET['keyword'] ) ) {    
				if ( ! empty( $_GET['keyword'] ) ) {
					$args['s'] =  sanitize_text_field($_GET['keyword']);
				}
			}

			$tabeeb_case_posts = new WP_Query( $args );

			if ( $tabeeb_case_posts->have_posts() )  :
		?>
			    <div class="section-box-header bg-white">
					<?php if ( isset( $_GET['case'] ) && isset( $_GET['disease'] ) && isset( $_GET['keyword'] ) ) : ?>
						<h3 class="text-info mb-0 section-title">آخر المقالات</h3>
                    <?php elseif ( isset( $_GET['case'] ) && isset( $_GET['disease'] ) ) : ?>
						<h3 class="text-info mb-0 section-title">كافة انواع مرض <?php echo get_cat_name( $category_id = $_GET['case'] );?></h3>
					<?php elseif ( isset( $_GET['case'] ) ) : ?>
						<h3 class="text-info mb-0 section-title">المقالات المتعلقة ب<?php echo get_cat_name( $category_id = $_GET['case'] );?></h3>
					<?php else : ?>
						<h3 class="text-info mb-0 section-title">آخر sالمقالات</h3>
					<?php endif; ?>
                </div>

			<section class="posts">
				<?php
					while ( $tabeeb_case_posts->have_posts() ) :
						$tabeeb_case_posts->the_post();
						get_template_part( 'loop-templates/content', 'search' );
					endwhile;
				?>
				<?php else : ?>
					<h3 class="page-title my-3 my-md-4"><?php esc_html_e( 'لم يتم العثور على شيء', 'understrap' ); ?></h3>
			</section>

		<?php endif; wp_reset_postdata();?>

		<?php 
			echo '<nav aria-labelledby="posts-nav-label" class="d-flex justify-content-center mt-5 mb-4 pagination-custom">';
			echo paginate_links(array(
				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'total'        => $tabeeb_case_posts->max_num_pages,
				'current'      => max( 1, get_query_var( 'paged' ) ),
				'format'       => '?paged=%#%',
				'show_all'     => false,
				'type'         => 'plain',
				'end_size'     => 2,
				'mid_size'     => 1,
				'prev_next'    => true,
				'prev_text'    => sprintf( '<i class="icon-chevron-right d-flex justify-content-center algin-items-center" aria-hidden="true"></i>', __( 'Prev', 'understrap' ) ),
				'next_text'    => sprintf( '<i class="icon-chevron-left d-flex justify-content-center algin-items-center" aria-hidden="true"></i>', __( 'Next', 'understrap' ) ),
				'add_args'     => false,
				'add_fragment' => '',
				));
			echo '</nav>';
		?>

	</div>

</div>

<?php
get_footer();