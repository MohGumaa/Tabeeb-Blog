<?php
/**
 * The template for displaying the author pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-wrapper author-page" id="author-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php
				if ( get_query_var( 'author_name' ) ) {
					$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
				} else {
					$curauth = get_userdata( intval( $author ) );
				}

				$author_description    = get_field('doctor_description', 'user_'. $curauth->ID);
				$author_specialty      =  get_field('doctor_specialty', 'user_'. $curauth->ID); 
				$author_qualifications =  get_field('doctor_qualifications', 'user_'. $curauth->ID);
				$author_review         = get_field('number_review', 'user_'. $curauth->ID);
				$author_stars          = get_field('stars_number', 'user_'. $curauth->ID);  
			?>

			<section class="d-flex flex-column flex-md-row bg-white section-box-header py-4 mb-4">
				<div>
					<?php 
						if ( ! empty( $curauth->ID ) ) {
							echo get_avatar( $curauth->ID, 195, '', $curauth->display_name );
						}
					?>
				</div>

				<div class="me-0 me-md-4 author-meta">
					<p class="text-primary fs-4 mb-1 author-name"><?php echo esc_html( $curauth->display_name ); ?></p>

					<?php if ( $author_specialty ) : ?>
						<span class="text-info"><?php echo $author_specialty; ?></span>
					<?php endif; ?>

					<?php if ( $author_qualifications ) : ?>
						<span class="author-badge me-2"><?php echo $author_qualifications; ?></span>
					<?php endif; ?>

					<div class="review mt-2">
						<?php if ( $author_review ) : ?>
							<span class="text-secondary">(<?php echo $author_review; ?>)</span>
						<?php endif; ?>
						<?php if ( $author_stars ) :?>
							<i class="fa fa-star stars" style="--rating: <?php echo $author_stars; ?>;" aria-label="Rating is <?php echo $author_stars; ?> out of 5."></i>
							<span class="text-secondary"><?php echo $author_stars; ?> <i class="fa fa-google" aria-hidden="true"></i></span>
						<?php endif; ?>
					</div>

					<?php if ( $author_description ) : ?>
						<?php echo $author_description; ?>
					<?php endif; ?>

				</div>
			</section>

			<div class="section-box-header bg-white mb-4">
				<p class="text-info mb-0 section-title fs-5">
					<?php if ( strcasecmp( $curauth->roles[0], 'contributor' ) == 0 ) :?>
						<?php echo esc_html__( 'مقالات تمت مراجعتها بواسطة الطبيب', 'understrap' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'مقالات تمت كتابتها بواسطة المؤلف', 'understrap' ); ?>
					<?php endif; ?>
				</p>
			</div>

			<?php 
				$tabeeb_user = $curauth->ID;
				$postsPerPage = 5;
				$page = 1;

				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page'=> $postsPerPage,
					'paged' => $page,
					'author' => $tabeeb_user,
				);

				$tabeeb_author_posts = new WP_Query( $args );
				if ( $tabeeb_author_posts->have_posts(  ) ) :
			?>

			<div class="posts">
				<?php while ( $tabeeb_author_posts->have_posts() ): $tabeeb_author_posts->the_post();
					get_template_part( 'loop-templates/content', 'author' );
					endwhile;
				?>
			</div>

			<button 
				id="show_more" 
				class="btn btn-info btn-lg w-100 text-light mt-3" 
				data-tabeebuser="<?php echo $tabeeb_user; ?>" 
				data-perpage="<?php echo $postsPerPage; ?>" 
				data-page="<?php echo $page; ?>" 
			>
				<?php echo esc_html__( 'عرض المزيد', 'understrap' ); ?>
				<span class="spinner-border spinner-border-sm d-none" id="spinner-post" role="status" aria-hidden="true"></span>
			</button>

			<?php else : ?> 
				<p class="pe-1 fs-4 text-secondary"><?php esc_html_e( 'عذراً، لا توجد مقالات منشورة حاليا', 'understrap' ); ?></p>
			<?php 	
			    endif;
				wp_reset_postdata(); 
			?>

		</main>

	</div>

</div>

<?php
get_footer();
