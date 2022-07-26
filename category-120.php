<?php
/**
 * The template for parent category
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<div class="page-wrapper parent-category" id="parent-category-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">
            <div class="page-breadcrumb">
                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
                    }
                ?>
            </div>

            <?php if ( have_posts() ) :?>
                
                <div class="row gx-2 gx-md-3">

                    <?php 
                        $term = get_queried_object();
                        $children = get_terms( $term->taxonomy, array(
                            'parent'    => $term->term_id,
                            'hide_empty' => false
                        ) );
                        if ( $children ) :
                        foreach( $children as $subcat ) :
                    ?>

                        <div class="col-md-3 col-sm-6 col-6 mb-3 card-box card-br">
                            <article>
                                <div class="card h-100 bg-light p-1 p-md-2 border-green">
                                    <a href="<?php echo esc_url(get_term_link($subcat, $subcat->taxonomy)); ?>" class="card-img-top">
                                        <?php  
                                            $image = get_field('cat_picture', $subcat); 
                                            if ( $image ) : 
                                        ?>
                                            <img width="348" height="214" src="<?php echo $image['sizes']['tabeeb-large'];?>" class="wp-post-image" alt="<?php echo $subcat->name ?>">
                                        <?php else : ?>
                                            <img width="348" height="214" src="<?php echo get_theme_file_uri( 'images/Empty-image.jpg' ); ?>" class="wp-post-image" alt="tabeeb-image">
                                        <?php endif; ?>
                                    </a>
                                    <div class="card-body px-1 pb-0">
                                        <h3 class="card-title text-center mb-1 mb-md-2">
                                            <a href="<?php echo esc_url(get_term_link($subcat, $subcat->taxonomy)); ?>" class="article-title"><?php echo $subcat->name ?></a>
                                        </h3>
                                    </div>
                                </div>
                            </article>
                        </div>

                    <?php endforeach; endif; ?>

            <?php else :?>
                <?php get_template_part( 'loop-templates/content', 'none' ); ?>
            <?php endif; ?>

		</main>

	</div>

</div>

<?php
get_footer();
