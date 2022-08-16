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
	<?php the_title( '<h1 class="text-primary article-title">', '</h1>' ); ?>

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
						<?php echo get_avatar($coauthor->ID, 65); ?>
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
									<span class="doctor-qualifications me-1"><?php echo $doctor_qualifications; ?></span>
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
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 65 ); ?>
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
