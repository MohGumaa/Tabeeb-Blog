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
	<main class="site-main">
		<div class="container">
			<!-- Get the author info -->
			<?php
				if ( get_query_var( 'author_name' ) ) {
					$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
				} else {
					$curauth = get_userdata( intval( $author ) );
				}

				$curauth_roles = $curauth->roles;

				$curauth_description   = get_field('doctor_description', 'user_'. $curauth->ID);
				$doctor_qualifications =  get_field('doctor_qualifications', 'user_'. $curauth->ID);
				$doctor_specialty      =  get_field('doctor_specialty', 'user_'. $curauth->ID); 
				$number_review          = get_field('number_review', 'user_'. $curauth->ID);
				$stars_number           = get_field('stars_number', 'user_'. $curauth->ID);
				$hospital               = get_field('hospital', 'user_'. $curauth->ID); 
				$doctor_city            = get_field('doctor_city', 'user_'. $curauth->ID); 
				$activation_booking     = get_field('activation_booking', 'user_'. $curauth->ID);
				$doctor_phone           = get_field('doctor_phone', 'user_'. $curauth->ID);
				$doctor_treatments      = get_field('doctor_treatments', 'user_'. $curauth->ID);
				$doctor_certificate     = get_field('doctor_certificate', 'user_'. $curauth->ID);
				$doctor_contact         = get_field('doctor_contact', 'user_'. $curauth->ID);
				$doctor_researcher      = get_field('doctor_researcher', 'user_'. $curauth->ID);
				$dcotor_map             = get_field('dcotor_map', 'user_'. $curauth->ID);
				$doctor_albums          = get_field('doctor_albums', 'user_'. $curauth->ID); 
			?>
			<section class="d-flex flex-column flex-sm-row bg-white section-box-header user-info py-3 py-md-4">
				<div class="mb-4 mb-sm-0 <?php echo in_array( 'contributor', $curauth_roles, true ) ? "doctor-profile" : ""; ?>">
					<?php
						if ( ! empty( $curauth->ID ) ) {
							echo get_avatar( get_the_author_meta( 'ID' ), 200 );
						}
						$curauth_roles = $curauth->roles;
					?>
					<?php echo author_social(); ?>
				</div>
				<div class="flex-grow-1 user-meta me-0 me-sm-2 me-md-4">
					<?php if ( in_array( 'contributor', $curauth_roles, true ) ) : ?>
						<div class="d-flex flex-column flex-sm-row">
							<!-- Col-1 -->
							<div class="flex-grow-1 mb-3 mb-sm-0 text-center text-sm-end">
								<h1 class="d-inline-block text-primary author-name mb-0 text-center text-sm-end"><?php echo esc_html( $curauth->display_name ); ?></h1>
								<?php if ( $doctor_qualifications ) :?>
									<span class="author-badge me-5 me-md-3"><?php echo $doctor_qualifications; ?></span>
								<?php endif; ?>
								<?php if ( $doctor_specialty ) :?>
									<span class="d-block text-info my-2 fs-17"><?php echo $doctor_specialty; ?></span>
								<?php endif; ?>
								<?php if ( $number_review ) :?>
									<span class="text-secondary fs-small">(<?php echo $number_review; ?>)</span>
								<?php endif; ?>
								<?php if ( $stars_number ) :?>
									<i class="fa fa-star fs-small stars" style="--rating: <?php echo $stars_number; ?>;" aria-label="Rating is <?php echo $stars_number; ?> out of 5."></i>
									<span class="text-secondary fs-small"><?php echo $stars_number; ?> <i class="fa fa-google" aria-hidden="true"></i></span>
								<?php endif; ?>
								<?php if ( $hospital ) :?>
									<span class="text-secondary fs-small d-block mt-1"><i class="fa fa-map-marker ms-1" aria-hidden="true"></i><?php echo $hospital; ?> - <?php echo $doctor_city; ?></span>
								<?php endif; ?>
								<?php echo author_social(); ?>
								<p class="d-block d-sm-none mt-2 mb-1">
									<?php esc_html_e( 'المقالات', 'understrap' ); ?> : <?php echo count_user_posts( $curauth->ID ); ?>
								</p>
							</div>

							<!-- Col-2 -->
							<div class="d-flex flex-column align-items-end">
								<?php if ( $activation_booking ): ?>
									<a href="<?php echo esc_url( home_url( '/حجز-إستشارة' ) ); ?>/?doctor-id=<?php echo esc_html( $curauth->ID ); ?>&doctor-name=<?php echo esc_html( $curauth->display_name ); ?>&source=<?php echo $_SERVER['REQUEST_URI'];?>" class="btn btn-info text-white w-100 mb-3">
										حجز إستشارة
									</a>
								<?php endif; ?>
								<?php if ( $doctor_phone ) : 
									$text_whats = 'مرحباً! أرغب بحجز استشارة مع '. $curauth->display_name .' - موقع طبيب';
									?>
									<a href="https://wa.me/<?php echo $doctor_phone ?>?text=<?php echo $text_whats ?>" class="btn btn-outline-info d-flex justify-content-center align-items-center text-center px-1 px-md-3 w-100" target="_blank">
										<i class="fa fa-whatsapp text-info ms-1" aria-hidden="true"></i>حجز واتساب
									</a>
								<?php endif; ?>
								<p class="d-none d-sm-block mb-0 mt-auto">
									<?php esc_html_e( 'المقالات', 'understrap' ); ?> : <?php echo count_user_posts( $curauth->ID ); ?>
								</p>
							</div>
						</div>
				
					<?php else : ?>
						<h1 class="text-primary author-name mb-3 text-center text-sm-end"><?php echo esc_html( $curauth->display_name ); ?></h1>
						<?php 
							if ( $curauth_description ) {
								echo $curauth_description; 
							}
						?>
						<p>
							<?php esc_html_e( 'المقالات', 'understrap' ); ?> : <?php echo count_user_posts( $curauth->ID ); ?>
						</p>
					<?php endif; ?>
				</div>
			</section>
		</div>

		<?php if ( in_array( 'contributor', $curauth_roles, true ) ) : ?>
			<div class="user-tabs">
				<div class="container">
					<ul class="nav nav-tabs user-tabs-info" id="myTab" role="tablist">
						<?php if ( $curauth_description ) :?>
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">نبذة</button>
							</li>
						<?php endif; ?>
						<?php if ( $doctor_treatments ) :?>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">العلاجات</button>
							</li>
						<?php endif; ?>
						<?php if ( $doctor_certificate ) :?>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">الشهادات</button>
							</li>
						<?php endif; ?>
						<?php if ( $doctor_contact ) :?>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">التواصل</button>
							</li>
						<?php endif; ?>
						<?php if ( $doctor_researcher ) :?>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="researcher-tab" data-bs-toggle="tab" data-bs-target="#researcher-tab-pane" type="button" role="tab" aria-controls="researcher-tab-pane" aria-selected="false">الأبحاث</button>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( in_array( 'contributor', $curauth_roles, true ) ) : ?>
			<div class="container user-tabs-container">
				<div class="tab-content user-tabs-content text-secondary mb-4" id="myTabContent">
					<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
						<?php 
							if ( ! empty( $curauth_description ) ) {
								echo $curauth_description;
							} 
						?>
					</div>
					<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
						<?php 
							if ( ! empty( $doctor_treatments ) ) {
								echo $doctor_treatments;
							} 
						?>
					</div>
					<div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
						<?php 
							if ( ! empty( $doctor_certificate ) ) {
								echo $doctor_certificate;
							} 
						?>
					</div>
					<div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
						<div class="row">
							<div class="col-md-6 col-12 mb-3 mb-md-0">
								<?php 
									if ( ! empty( $doctor_contact ) ) {
										echo $doctor_contact;
									} 
								?>
							</div>
							<div class="col-md-6 col-12">
								<?php if ( ! empty( $dcotor_map ) )  : ?>
									<iframe src="<?php echo $dcotor_map; ?>" class="w-100 h-100" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								<?php endif; ?>

							</div>
						</div>
					</div>
					<div class="tab-pane fade list-with-br" id="researcher-tab-pane" role="tabpanel" aria-labelledby="researcher-tab" tabindex="0">
						<?php 
							if ( ! empty( $doctor_researcher ) ) {
								echo $doctor_researcher;
							} 
						?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<div class="container">
			<!-- Album -->
			<?php if( in_array( 'contributor', $curauth_roles, true ) ) : ?>
				<?php if ( $doctor_albums ) : ?>
					<div class="section-box-header bg-white">
						<h2 class="text-info mt-1 mb-0 section-title">
							<?php echo esc_html__( 'الألبوم', 'understrap' ); ?>
						</h2>
					</div>
					<div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3 mb-5 popup-gallery">					
						<?php foreach ( $doctor_albums as $album ) :  if ( $album ) : ?>
							<div class="col thumbnails-img">
								<?php if ( isset( $album['type'] ) && $album['type'] == 'image' ) :  ?>
									<a href="<?php echo esc_url( $album['sizes']['large'] ); ?>" class="d-block position-relative">
										<img src="<?php echo esc_url( $album['sizes']['tabeeb-album'] ); ?>" width="175" height="130" class="img-fluid wp-post-image rounded-8" alt="<?php echo esc_url( $album['alt'] ); ?>">
										<span class="icon-image d-flex justify-content-center align-items-center text-white"></span>
									</a>
								<?php else : 
									$src_video = explode("?v=", $album) ;
								?>
									<a href="<?php echo $album; ?>" class="video" title="<?php echo $album ?>">
										<img src="https://img.youtube.com/vi/<?php echo $src_video[1]; ?>/hqdefault.jpg" width="175" height="130" class="img-fluid wp-post-image rounded-8" alt="صور عن الفيديو" />
										<span class="icon-video d-flex justify-content-center align-items-center text-white"></span>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; endforeach; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<!-- Articles Section -->
			<div class="section-box-header bg-white">
				<h2 class="text-info mt-1 mb-0 section-title">
					<?php if ( in_array( 'contributor', $curauth_roles, true ) ) :?>
						<?php echo esc_html__( 'مقالات تمت مراجعتها بواسطة الطبيب', 'understrap' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'مقالات تمت كتابتها بواسطة المؤلف', 'understrap' ); ?>
					<?php endif; ?>
				</h2>
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

				<section class="posts">
					<?php while ( $tabeeb_author_posts->have_posts() ): $tabeeb_author_posts->the_post();
						get_template_part( 'loop-templates/content', 'author' );
						endwhile;
					?>
				</section>

				<button 
					id="show_more" 
					class="btn btn-info btn-lg w-100 text-light mt-3 btn-load" 
					data-tabeebuser="<?php echo $tabeeb_user; ?>" 
					data-perpage="<?php echo $postsPerPage; ?>" 
					data-page="<?php echo $page; ?>" 
				>
					<?php echo esc_html__( 'عرض المزيد', 'understrap' ); ?>
					<span class="spinner-border spinner-border-sm d-none" id="spinner-post" role="status" aria-hidden="true"></span>
				</button>
			<?php else : ?> 
				<p class="pe-1 fs-5 text-secondary"><?php esc_html_e( 'عذراً، لا توجد مقالات منشورة حاليا', 'understrap' ); ?></p>
			<?php 	endif; wp_reset_postdata(); ?>
		</div>
	</main>
</div>

<?php
get_footer();
?>

<?php  if ( in_array( 'contributor', $curauth_roles, true ) ) :  ?>
	<script>
		(function($) {
			$(".popup-gallery").magnificPopup({
				delegate: "a",
				type: "image",
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
				},
				callbacks: {
					elementParse: function (item) {
						console.log(item.el[0].className);
						if (item.el[0].className == "video") {
							(item.type = "iframe"),
								(item.iframe = {
									patterns: {
										youtube: {
											index: "youtube.com/", // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

											id: "v=", // String that splits URL in a two parts, second part should be %id%
											// Or null - full URL will be returned
											// Or a function that should return %id%, for example:
											// id: function(url) { return 'parsed id'; }

											src: "//www.youtube.com/embed/%id%?autoplay=1", // URL that will be set as a source for iframe.
										},
										vimeo: {
											index: "vimeo.com/",
											id: "/",
											src: "//player.vimeo.com/video/%id%?autoplay=1",
										},
										gmaps: {
											index: "//maps.google.",
											src: "%id%&output=embed",
										},
									},
								});
						} else {
							(item.type = "image"),
								(item.tLoading = "Loading image #%curr%..."),
								(item.mainClass = "mfp-img-mobile"),
								(item.image = {
									tError:
										'<a href="%url%">The image #%curr%</a> could not be loaded.',
								});
						}
					},
				},
			});
		})(jQuery);
	</script>
<?php endif; ?>
