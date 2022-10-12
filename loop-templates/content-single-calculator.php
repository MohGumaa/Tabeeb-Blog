<?php
/**
 * Calculator post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php the_title( '<h1 class="text-primary article-title-main mb-4">', '</h1>' ); ?>

    <div class="article-feature-image">
        <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
    </div>

    <div class="article-content">
        <?php
        the_content();
        ?>
    </div>   
</article>


