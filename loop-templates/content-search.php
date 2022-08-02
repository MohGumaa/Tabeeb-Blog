<?php
/**
 * Search results partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="card border-0 mb-3 mb-md-4 post-grid">
		<div class="row g-0">
			<div class="col-md-4 col-sm-5 col-12">
				<a href="<?php the_permalink();?>" class="img-fluid rounded-start">
					<?php if(has_post_thumbnail()) :?>
						<?php echo get_the_post_thumbnail( $post->ID, 'tabeeb-related-widgetfull' ); ?>
					<?php else: ?>
						<img src="<?php echo get_theme_file_uri( 'images/tabeeb-img.jpg' ); ?>" alt="<?php the_title(); ?>" width="340" height="209" class="wp-post-image">
					<?php endif; ?>

				</a>
			</div>
			<div class="col-md-8 col-sm-7 col-12">
				<div class="card-body px-1 px-sm-3">
					<?php
					the_title(
						sprintf( '<h5 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
						'</a></h5>'
					);
					?>
					<?php the_excerpt(  ) ?>
				</div>
			</div>
		</div>
	</div>
</article>
