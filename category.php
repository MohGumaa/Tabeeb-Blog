<?php
/**
 * The template for displaying category pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$category = get_queried_object();
$item_not_to_show = [];
?>

<div class="page-wrapper category-custom_page" id="category-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
        <main class="site-main" id="main">

            <?php 
                $args1 = [
                    'post_type'      => 'post', 
                    'posts_per_page'    => '4',
                    'cat' => $category->term_id,
                    'order'       => 'DESC',

                    // required by PVC
                    'suppress_filters' => false,
                    'orderby' => 'post_views',
                    'fields' => ''
                ];

                $tabeeb_most_views = new WP_Query( $args1 );
                if ( $tabeeb_most_views->have_posts() ) :
                    $loop_post_view = 0;
            ?>
                <div class="page-breadcrumb">
                    <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
                        }
                    ?>
                </div>
                <section class="wrapper pt-0 section-a">
                    <div class="container box_container_white posts">
                        <?php while ( $tabeeb_most_views->have_posts() ) : $tabeeb_most_views->the_post(); if ($loop_post_view == 0) :?>
                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                <a href="<?php the_permalink();?>" class="d-block img-fluid">
                                    <img src="<?php the_post_thumbnail_url('large');?>" class="w-100 h-100 rounded" alt="<?php the_title();?>">
                                </a>
                                <div class="article-body py-3">
                                    <?php
                                        the_title(
                                            sprintf( '<h1><a href="%s" rel="bookmark" class="text-primary">', esc_url( get_permalink() ) ),
                                            '</a></h1>'
                                        );
                                    ?>
                                    <?php the_excerpt(); ?>
                                </div>
                            </article>
                        <?php else : ?>
                            
                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                                <div class="card border-0 h-100">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <a href="<?php the_permalink();?>" class="d-block img-fluid">
                                                <img src="<?php the_post_thumbnail_url('tabeeb-featured');?>" alt="<?php the_title(); ?>" class="w-100 h-100 rounded">
                                            </a>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body d-flex flex-column justify-content-evenly h-100 py-3 py-md-1 px-1 px-md-3">
                                                <?php
                                                    the_title(
                                                        sprintf( '<h3 class="card-title"><a href="%s" rel="bookmark" class="text-primary">', esc_url( get_permalink() ) ),
                                                        '</a></h3>'
                                                    );
                                                ?>
                                                <div class="card-text text-secondary"><?php the_excerpt(); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </article>
                        <?php endif; $loop_post_view++; array_push($item_not_to_show, get_the_ID()); endwhile; ?>
                    </div>
                </section>
            <?php endif; wp_reset_postdata(); ?>

            <?php 
                $args2 = [
                    'post_type'      => 'post', 
                    'posts_per_page'    => '4',
                    'cat' => $category->term_id,
                    'post__not_in' => $item_not_to_show,
                    'meta_query' => [
                        [
                            'key'        => 'disease',
                            'value'     => '1',
                        ]
                        ],
                ];

                $tabeeb_disease_posts = new WP_Query( $args2 );
                if ( $tabeeb_disease_posts->have_posts() ) :
            ?>

                <section class="wrapper section-b">
                    
                </section>

            <?php endif; wp_reset_postdata(); ?>

        </main>
	</div>

</div>

<?php
get_footer();
