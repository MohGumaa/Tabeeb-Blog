<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3 card-box card-br">
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
    </article>
</div>
