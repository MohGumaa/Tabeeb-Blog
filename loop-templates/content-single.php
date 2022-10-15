<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$medicine_category = has_category('92', $post->ID);

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php the_title( '<h1 class="text-primary article-title-main">', '</h1>' ); ?>

	<div class="d-flex align-items-center mb-3 author-meta">

		<!-- Check if post sponsored -->
		<?php if ( !( has_category('Sponsored') ) ) :?>
			<?php if ( function_exists( 'coauthors_posts_links' ) ) : ?>
				
				<?php 
					$coauthors = get_coauthors();
					$author_loop = 1;
					$names_loop = 1;
					if ( count($coauthors) > 1 ) : 
				?>
					<?php foreach ($coauthors as $coauthor) : if ($author_loop == 1) : ?>
						<a href="<?php echo get_author_posts_url( $coauthor->ID); ?>" title="<?php echo $coauthor->display_name; ?>" class="author url fn" rel="author">
							<?php echo get_avatar($coauthor->ID, 60); ?>
						</a>
					<?php endif; $author_loop++; endforeach ; ?>

					<div class="flex-grow-1 author-info">
						<?php foreach ($coauthors as $coauthor) : if ($names_loop == 1) : ?>
							<div>
								<span class="author-reviewer">المراجعة الطبية -</span>
								<a href="<?php echo get_author_posts_url( $coauthor->ID); ?>" title="<?php echo $coauthor->display_name; ?>" class="author url fn me-1" rel="author">
									<?php echo $coauthor->display_name; ?>
								</a>
								<?php
									$doctor_qualifications = get_field('doctor_qualifications', 'user_'. $coauthor->ID);
									$activation_booking = get_field('activation_booking', 'user_'. $coauthor->ID);
									$doctor_user = $coauthor; 
									if ( ! empty( $doctor_qualifications )  ) : 
								?>
									<span class="author-badge me-1"><?php echo $doctor_qualifications; ?></span>
								<?php endif; ?>
							</div>
						<?php else :?>
							<span class="writer">الكاتب -</span>
							<a href="<?php echo get_author_posts_url( $coauthor->ID); ?>" title="<?php echo $coauthor->display_name; ?>" class="author url fn" rel="author">
								<?php echo $coauthor->display_name; ?>
							</a>
						<?php endif; $names_loop++; endforeach; ?>
						<?php if ( get_the_modified_time( 'Y-m-d H:m' ) > get_the_time( 'Y-m-d H:m' ) ) :?>
							<span class="last-update d-block">أخر تحديث <?php echo get_the_modified_time('j F Y'); ?></span>
						<?php else: ?>
							<span class="posted-date d-block"><?php the_time(); ?></span>
						<?php endif; ?>
					</div>

				<?php else: ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>
					</a>
					<div class="author-info">
						<span class="ms-1">الكاتب -</span>
						<?php the_author_posts_link(); ?>
						<?php if ( get_the_modified_time( 'Y-m-d H:m' ) > get_the_time( 'Y-m-d H:m' ) ) :?>
							<span class="last-update d-block">أخر تحديث <?php echo get_the_modified_time('j F Y'); ?></span>
						<?php else: ?>
							<span class="posted-date d-block"><?php the_time(); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 65 ); ?>
				<div class="author-info">
					<span class="ms-1">الكاتب -</span>
					<?php the_author_posts_link(); ?>
					<?php if ( get_the_modified_time( 'Y-m-d H:m' ) > get_the_time( 'Y-m-d H:m' ) ) :?>
						<span class="last-update  d-block">أخر تحديث <?php echo get_the_modified_time('j F Y'); ?></span>
					<?php else: ?>
						<span class="posted-date  d-block"><?php the_time(); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

		<!-- Meta sponsored -->
		<?php else : ?>
			<div>
				<div class="d-flex align-items-end">
					<span class="author-sponsored"><?php esc_html_e( 'برعاية', 'understrap' ); ?> </span>
					<img src="<?php the_field('sponsored_image');?>" alt="برعاية" class="d-inline-block me-1 sponsored-logo" />
				</div>
				<?php if ( get_the_modified_time( 'Y-m-d H:m' ) > get_the_time( 'Y-m-d H:m' ) ) :?>
					<span class="last-update d-block mt-1">أخر تحديث <?php echo get_the_modified_time('j F Y'); ?></span>
				<?php else: ?>
					<span class="posted-date d-block mt-1"><?php the_time(); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>

	<?php if ( !$medicine_category ) : ?>
		<div class="article-img">
			<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
			<div class="d-flex flex-wrap justify-content-between align-items-center">
				<?php $src_image = get_field('source_of_image'); ?>
				<span class="text-secondary"><?php the_post_thumbnail_caption();  ?></span>
				<?php if ( $src_image ) : ?>
					<span><?php echo $src_image; ?></span>
				<?php endif; ?>

			</div>
		</div>
	<?php endif; ?>

	<div class="article-content">

		<?php
		the_content();
		?>

	</div>

</article>

<?php if ( !empty($activation_booking) ) : ?>

<script>

(function($) {
	$.ajax({
		url: "https://app.jubnaadserve.com/api/ipinfo",
		success: function(data){ 
			const doctor_country = '<?php echo get_field('country_name', 'user_'. $doctor_user->ID); ?>';
			// console.log(doctor_country)
			if ( data.country_name.toLowerCase() === doctor_country.toLowerCase() )  {
				<?php 
					$number_review = get_field('number_review', 'user_'. $doctor_user->ID);
					$stars_number  = get_field('stars_number', 'user_'. $doctor_user->ID);
					$hospital      = get_field('hospital', 'user_'. $doctor_user->ID); 
					$doctor_city   = get_field('doctor_city', 'user_'. $doctor_user->ID); 
					$video_booking = get_field('video_booking', 'user_'. $doctor_user->ID); 
					$feature_one   = get_field('feature_one', 'user_'. $doctor_user->ID); 
					$feature_two   = get_field('feature_two', 'user_'. $doctor_user->ID); 
					$feature_three = get_field('feature_three', 'user_'. $doctor_user->ID); 
				?>

				const srcLinkHeader = $(".source-links");

				const output = `
					<div class="book-doctor my-4 p-0 p-sm-3">
						<div class="d-sm-flex d-none justify-content-between align-items-center border-bottom w-100 pb-2">
							<div class="fw-bold fs-5">إحجز إستشارة مع الطبيب</div>
							<a href="<?php echo esc_url( home_url( '/حجز-إستشارة' ) ); ?>/?doctor-id=<?php echo esc_html( $doctor_user->ID ); ?>&doctor-name=<?php echo esc_html( $doctor_user->display_name ); ?>&source=<?php the_title();?>" class="btn btn-info text-white me-auto py-1">
								حجز إستشارة
							</a>
							<?php if ($video_booking) :?>
								<a href="<?php echo esc_url( home_url( '/حجز-إستشارة' ) ); ?>/?doctor-name=<?php echo esc_html( $doctor_user->display_name ); ?>&source=<?php the_title();?>" class="btn btn-outline-info py-1 me-2">
									استشارة فيديو
								</a>
							<?php endif; ?>
						</div>
						<div class="row gx-0 align-items-center bg-white mt-0 mt-sm-3 p-2 w-100 info">
							<div class="col-md-7 col-sm-7 d-flex">
								<img src="<?php echo esc_url( get_avatar_url( $doctor_user->ID ) ); ?>"  alt="<?php echo $doctor_user->display_name; ?>" />
								<div class="me-3 py-1">
									<span class="text-info doc-name"><?php echo $doctor_user->display_name; ?></span>
									<span class="user-badge me-1"><?php echo get_field('doctor_qualifications', 'user_'. $doctor_user->ID);  ?></span>
									<span class="text-secondary d-block"><?php echo get_field('doctor_specialty', 'user_'. $doctor_user->ID); ?></span>
									<span class="text-secondary d-block"><i class="fa fa-map-marker ms-1" aria-hidden="true"></i><?php echo $hospital;?> - <?php echo $doctor_city; ?></span>
									<?php if ( $number_review ) :?>
										<span class="text-secondary fs-small">(<?php echo $number_review; ?>)</span>
									<?php endif; ?>
									<?php if ( $stars_number ) :?>
										<i class="fa fa-star fs-small stars" style="--rating: <?php echo $stars_number; ?>;" aria-label="Rating is <?php echo $stars_number; ?> out of 5."></i>
										<span class="text-secondary fs-small"><?php echo $stars_number; ?> <i class="fa fa-google" aria-hidden="true"></i></span>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-md-5 col-sm-5">
								<?php if ( $feature_one ) :?>
									<div class="doctor-features me-0 me-sm-3">
										<?php if ( $feature_one ) :?>
											<div class="d-flex align-items-start mb-1">
												<i class="icon-check-circle ms-1 small" aria-hidden="true"></i>
												<span class="text-secondary"><?php echo $feature_one; ?></span>
											</div>
										<?php endif; ?>
										<?php if ( $feature_two ) :?>
											<div class="d-flex align-items-start mb-1">
												<i class="icon-check-circle ms-1 small" aria-hidden="true"></i>
												<span class="text-secondary"><?php echo $feature_two; ?></span>
											</div>
										<?php endif; ?>
										<?php if ( $feature_three ) :?>
											<div class="d-flex align-items-start mb-1">
												<i class="icon-check-circle ms-1 small" aria-hidden="true"></i>
												<span class="text-secondary"><?php echo $feature_three; ?></span>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="d-flex justify-content-between d-sm-none py-3 px-2 w-100 border-top down-btn">
							<a href="<?php echo esc_url( home_url( '/حجز-إستشارة' ) ); ?>/?doctor-id=<?php echo esc_html( $doctor_user->ID ); ?>&doctor-name=<?php echo esc_html( $doctor_user->display_name ); ?>&source=<?php the_title();?>" class="btn btn-info text-white w-100 py-1">
								حجز إستشارة
							</a>
							<?php if ($video_booking) :?>
								<a href="<?php echo esc_url( home_url( '/حجز-إستشارة' ) ); ?>/?doctor-name=<?php echo esc_html( $doctor_user->display_name ); ?>&source=<?php the_title();?>" class="btn btn-outline-info w-100 py-1 me-2">
									استشارة فيديو
								</a>
							<?php endif; ?>
						</div>
					</div>
				`;

				const newDiv = document.createElement("div");
				newDiv.innerHTML = output;
				srcLinkHeader.before(newDiv);

			} else {
				console.log('Different');
			}
		},
		error: function(){
			console.log("There was an error.");
		}
	});

})(jQuery);

</script>

<?php endif;?>

<div id="Sureview64"> 
	<script type="text/javascript" data-cfasyn="false" async="true" src="https://app.sureview.tv/api/get-ads/64"></script>
</div>
