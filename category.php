<?php
/**
 * The template for displaying category pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

$category = get_queried_object();
$item_not_to_show = [];
$show_section = false;
?>

<div class="page-wrapper category-custom_page" id="category-wrapper">

	<div class="container" id="content" tabindex="-1">
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
                                    <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                                </a>
                                <div class="article-body pt-3">
                                    <?php
                                        the_title(
                                            sprintf( '<h1><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
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
                                                <?php echo get_the_post_thumbnail( $post->ID, 'tabeeb-large' ); ?>
                                            </a>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body d-flex flex-column justify-content-evenly h-100 py-1 px-3">
                                                <?php
                                                    the_title(
                                                        sprintf( '<h3 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
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
                    $loop_disease = 0;
            ?>

                <section class="wrapper section-b">
                    <div class="container box_container_white">
                        <div class="d-flex justify-content-between align-items-center box-title-with-link">
                            <h2 class="text-info section-header mb-0">
                            انواع امراض <?php echo $category->name; ?>
                            </h2>
                            <form action="<?php echo esc_url( home_url( '/condition' ) ); ?>" method="get">
                                <input type="hidden" name="case" value="<?php echo $category->term_id; ?>">
                                <input type="hidden" name="disease" value="disease">
                                <button class="btn btn-transparent d-block text-secondary ps-0">
                                    كافة الأنواع<i class="fa fa-chevron-left me-1 me-md-2" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                        <div class="row">
                            <?php while ( $tabeeb_disease_posts->have_posts() ) : $tabeeb_disease_posts->the_post();?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0 <?php echo ++$loop_disease == 4 ? 'd-block d-md-none d-lg-block' : '' ; ?>  card-box">
                                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                        <div class="card border-0 h-100">
                                            <a href="<?php the_permalink();?>" class="card-img-top">
                                                <?php echo get_the_post_thumbnail( $post->ID, 'tabeeb-large' ); ?>
                                            </a>
                                            <div class="card-body px-0 pb-0">
                                                <?php
                                                    the_title(
                                                        sprintf( '<h3 class="card-title"><a href="%s" rel="bookmark" class="article-title">', esc_url( get_permalink() ) ),
                                                        '</a></h3>'
                                                    );
                                                ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php array_push($item_not_to_show, get_the_ID()); endwhile; ?>
                        </div>
                    </div>
                </section>

            <?php endif; wp_reset_postdata(); ?>

            <?php 
                $args3 = [
                    'post_type'      => 'post', 
                    'posts_per_page'    => '8',
                    'cat' => $category->term_id,
                    'post__not_in' => $item_not_to_show,
                ];

                $tabeeb_latest_post = new WP_Query( $args3 );

                if ( $tabeeb_latest_post->have_posts() ) :
            ?>

                <section class="wrapper section-c">
                    <div class="container box_container_white">
                        <div class="d-flex justify-content-between align-items-center box-title-with-link">
                            <h2 class="text-info section-header mb-0">أﺧﺮ اﻟﻤﻘﺎﻟﺎت المتعلقة</h2>
                            <form action="<?php echo esc_url( home_url( '/condition' ) ); ?>" method="get">
                                <input type="hidden" name="case" value="<?php echo $category->term_id; ?>">
                                <button class="btn btn-transparent d-block text-secondary ps-0">
                                    كافة اﻟﻤﻘﺎﻟﺎت<i class="fa fa-chevron-left me-1 me-md-2" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                        <div class="row">
                            <?php while ( $tabeeb_latest_post->have_posts() ) : $tabeeb_latest_post->the_post();?>
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                        <div class="card border-0 card-list">
                                            <div class="row g-0">
                                                <div class="col-md-4 col-sm-5 col-12">
                                                    <a href="<?php the_permalink();?>" class="d-block img-fluid rounded-start">
                                                        <?php echo get_the_post_thumbnail( $post->ID, 'tabeeb-large' ); ?>
                                                    </a>
                                                </div>
                                                <div class="col-md-8 col-sm-7 col-12">
                                                    <div class="card-body h-100 py-3 py-sm-1 px-1 px-sm-3">
                                                        <?php
                                                            the_title(
                                                                sprintf( '<h3 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                                                                '</a></h3>'
                                                            );
                                                        ?>
                                                        <div class="card-text text-secondary">        
                                                            <?php the_excerpt(  ) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>

            <?php endif; wp_reset_postdata(); ?>

            <?php if( $show_section ) :?>
                <section class="wrapper text-center text-md-end section-d banner-with-left-img">
                    <div class="bg-light-blue py-5 py-lg-0">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md pe-4 pe-md-5 ps-4 ps-md-0">
                                <h2 class="banner-title">ﻫﻞ ترغب في الحصول على أستشارة طبية من الطبيب</h2>
                                <a href="#" class="btn btn-info text-white ms-3 mt-3 rounded"><?php echo esc_html_e( 'ﺗﺤﺪث ﻣﻊ ﻃﺒﻴﺐ', 'understrap' ); ?></a>
                            </div>
                            <div class="col-md d-none d-md-block">
                                <img src="<?php echo get_theme_file_uri( 'images/doctors.png' ); ?>" class="img-fluid d-block me-auto" alt="doctor">
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php if( !empty($item_not_to_show) ) :?>
                <section class="wrapper section-e">
                    <div class="d-flex flex-column justify-content-center align-items-center py-3 py-md-5"  style="background-image: url('<?php echo get_theme_file_uri( 'images/newsletter-bg.jpg' ); ?>')">
                        <h2 class="d-none d-md-block">اشترك بالقائمة البريدية</h2>
                        <div class="newsletter">
                            <h3 class="text-center text-md-end">تلقي اخر المقالات والتحديثات لهذا القسم</h3>
                            <form action="<?php echo esc_url( home_url( '/?na=s' ) ); ?>" method="post" class="search-form">
                                <div class="input-group input-group-lg">
                                    <input 
                                        type="email" 
                                        name="ne" 
                                        placeholder="ادخل بريدك الإلكتروني" 
                                        aria-label="ادخل بريدك الإلكتروني" 
                                        class="form-control rounded-right"
                                        oninvalid="this.setCustomValidity('من فضلك ادخل بريدك')"
        	                            oninput="setCustomValidity('')"  
                                        required
                                    >
                                    <input type="hidden" value="[YourAccount]" name="uri">
                                    <input type="hidden" name="loc" value="en_US">
                                    <input type="hidden" name="section-intereset" value="<?php the_title(); ?>">
                                    <span class="input-group-append input-group-lg">
                                        <button class="btn btn-info text-white rounded-left">اشترك الآن</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php if( empty($item_not_to_show) ) :?>
                <?php get_template_part( 'loop-templates/content', 'none' );  ?>
            <?php endif; ?> 
        </main>
	</div>

</div>

<?php
get_footer();
