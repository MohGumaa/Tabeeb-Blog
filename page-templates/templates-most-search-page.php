<?php
/**
 * Template Name: Most Search Layout
 *
 * Template for displaying a page most search
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="page-wrapper most-search">

	<div class="container" id="content">
        <?php the_title( '<h1 class="page-title pb-3 mt-3 mb-4 text-center">', '</h1>' ); ?>

        <?php 
            $children = get_terms( 'category', array(
                'parent'    => '82',
                'orderby' => 'id',
                'order' => 'ASC',
                'include'   => array('87', '204', '246', '250', '321', '323', '317', '352', '353'),
                'hide_empty' => false
            ) );

            if ( $children ) : 
        ?>

            <div class="row gx-md-3 gx-lg-5">

                <?php foreach( $children as $subcat ) : ?>

                    <div class="col-md-4 col-sm-6 col-12 mb-4 card-box card-br">
                        <article>
                            <div class="card h-100 large-box">
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

                                <div class="card-body px-1 d-flex flex-column justify-content-between">
                                    <div class="box-body">
                                        <h2 class="card-title">
                                            <a href="<?php echo esc_url(get_term_link($subcat, $subcat->taxonomy)); ?>" rel="bookmark" class="text-info"><?php echo $subcat->name ?></a>
                                        </h2>
                                        <p class="text-secondary card-text">
                                            <?php echo $subcat->description ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0 px-1">
                                    <a href="<?php echo esc_url(get_term_link($subcat, $subcat->taxonomy)); ?>" class="text-muted small">انتقل إلى الحالة<span class="icon-chevron-left me-1 fs-6"></span></a>
                                </div>
                                
                            </div>
                        </article>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>
	</div>

</main>

<?php
get_footer();