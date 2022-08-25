<?php
/**
 * The Content for front-page
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$selected_sections       = get_field('أقسام_مختارة');
$selected_sections_image = get_field('صور_اقسام_مختارة');
$tabeeb_special_posts    = get_field('مواضيع_مميزة');
$tabeeb_articles_link    = get_field('أﺧﺮاﻟﻤﻘﺎﻟﺎت');
$banner_one              = get_field('banner_one_section');

$image1 = $selected_sections_image['الصور_الاول'];
$image2 = $selected_sections_image['الصور_الثانية'];
$image3 = $selected_sections_image['الصور_الثالثة'];
$image4 = $selected_sections_image['الصور_الرابعة'];

?>

<!-- Change tabeeb-featured -->
<section class="section section-a wrapper">
    <div class="row gx-3">
        <div class="col-md-3 col-sm-6 col-6 mb-3 mb-md-0 card-box card-br">
            <article>
                <div class="card h-100 bg-light pb-0 border-green">
                    <?php if ( $selected_sections['الرابط_الاول'] ) : ?>
                        <a href="<?php echo $selected_sections['الرابط_الاول']; ?>" class="card-img-top">
                            <img width="348" height="214" src="<?php echo $image1['sizes']['large']; ?>" class="wp-post-image" alt="<?php the_title();?>">
                        </a>
                        <div class="card-body px-0 pb-0">
                
                            <h3 class="card-title text-center">
                                <a href="<?php echo $selected_sections['الرابط_الاول']; ?>" rel="bookmark" class="article-title"><?php echo $image1['title']; ?></a>
                            </h3>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mb-3 mb-md-0 card-box card-br">
            <article>
                <div class="card h-100 bg-light pb-0 border-green">
                    <?php if ( $selected_sections['الرابط_الثاني'] ) : ?>
                        <a href="<?php echo $selected_sections['الرابط_الثاني']; ?>" class="card-img-top">
                            <img width="348" height="214" src="<?php echo $image2['sizes']['large']; ?>" class="wp-post-image" alt="<?php the_title();?>">
                        </a>
                        <div class="card-body px-0 pb-0">
                
                            <h3 class="card-title text-center">
                                <a href="<?php echo $selected_sections['الرابط_الثاني']; ?>" rel="bookmark" class="article-title"><?php echo $image2['title']; ?></a>
                            </h3>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mb-3 mb-md-0 card-box card-br">
            <article>
                <div class="card h-100 bg-light pb-0 border-green">
                    <?php if ( $selected_sections['الرابط_الثالث'] ) : ?>
                        <a href="<?php echo $selected_sections['الرابط_الثالث']; ?>" class="card-img-top">
                            <img width="348" height="214" src="<?php echo $image3['sizes']['large']; ?>" class="wp-post-image" alt="<?php the_title();?>">
                        </a>
                        <div class="card-body px-0 pb-0">
                
                            <h3 class="card-title text-center">
                                <a href="<?php echo $selected_sections['الرابط_الثالث']; ?>" rel="bookmark" class="article-title"><?php echo $image3['title']; ?></a>
                            </h3>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mb-3 mb-md-0 card-box card-br">
            <article>
                <div class="card h-100 bg-light pb-1 border-green">
                    <?php if ( $selected_sections['الرابط_الرابع'] ) : ?>
                        <a href="<?php echo $selected_sections['الرابط_الرابع']; ?>" class="card-img-top">
                            <img width="348" height="214" src="<?php echo $image4['sizes']['large']; ?>" class="wp-post-image" alt="<?php the_title();?>">
                        </a>
                        <div class="card-body px-0 pb-0">
                
                            <h3 class="card-title text-center">
                                <a href="<?php echo $selected_sections['الرابط_الرابع']; ?>" rel="bookmark" class="article-title"><?php echo $image4['title']; ?></a>
                            </h3>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    </div>
</section>

<?php 
    $args = array( 
        'posts_per_page' => 8,
        'category_name'  =>  $tabeeb_special_posts['رابط_المواضيع'],
        'post_status' => 'publish',
    ); 

    $special_posts = new WP_Query( $args );

    if ( $special_posts->have_posts() ) :
        $special_loop = 1;
?>

    <section class="section section-b pt-3">
        <div class="section-box-header bg-white">
            <h2 class="text-info mb-0 section-title"><?php echo $tabeeb_special_posts['العنوان']; ?></h2>
        </div>
        <div class="row gx-3">
            <?php while ( $special_posts->have_posts() ) : $special_posts->the_post();?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3 <?php echo ($special_loop == 7 or $special_loop == 8) ? 'd-block d-md-none d-lg-block' : '' ; ?> card-box card-br">
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
                        <?php echo htmlspecialchars(get_primary_category());?>
                    </article>
                </div>

            <?php $special_loop++; endwhile; ?>
        </div>
    </section>

<?php endif; wp_reset_postdata(); ?>

<?php 
    $args = array( 
        'posts_per_page'   => 8,
        'post_status'      => 'publish',
        'category__not_in' => array(92,130, 117),
    ); 

    $tabeeb_latest_articles = new WP_Query( $args );

    if ( $tabeeb_latest_articles->have_posts() ) :
?>

    <section class="section-c wrapper">
        <div class="d-flex justify-content-between align-items-center section-box-header bg-white">
            <h2 class="text-info mb-0 section-title"><?php echo $tabeeb_articles_link['عنوان_القسم']  ; ?></h2>
            <?php if ( $tabeeb_articles_link['رابط_الاسم_اللطيف'] ) : ?>
                <a href="<?php echo $tabeeb_articles_link['رابط_الاسم_اللطيف'] ; ?>" class="text-secondary small">
                    <?php echo $tabeeb_articles_link['نص_الرابط_المقالات']  ; ?><i class="fa fa-chevron-left me-1 chevron-left-fs" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
        <div class="container box_container_white">
            <div class="row pt-3">
                <?php while ( $tabeeb_latest_articles->have_posts() ) : $tabeeb_latest_articles->the_post();?>
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

<?php if ( $banner_one ) :?>
    <section class="section-d my-4 rounded text-center text-md-end banner-section">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg col-md-7 pe-4 pe-md-4 pe-lg-5 ps-4 ps-lg-0 py-5 py-lg-0">
                <h2 class="mb-3"><?php echo $banner_one['banner_one_main_title']; ?></h2>
                <p class="fs-4 text-secondary"><?php echo $banner_one['banner_one_text']; ?> </p>
                <a href="#" class="btn btn-info text-white">
                    <?php echo esc_html_e( 'ﺗﺤﺪث ﻣﻊ ﻃﺒﻴﺐ', 'understrap' ); ?>
                </a>
                <a href="#" class="btn btn-white text-info me-0 me-md-2 mt-3 mt-lg-0">
                    <?php echo esc_html_e( 'اﻧﺘﻘﻞ إﻟﻰ اﻟﺤﺎﺳﺒﺎت اﻟﻄﺒﻴﺔ', 'understrap' ); ?>
                </a>
            </div>
            <div class="col-lg col-md-5 d-none d-md-block">
                <img width="390" height="424" src="<?php echo get_theme_file_uri( 'images/doctors.png' ); ?>" class="img-fluid d-block me-auto" alt="doctor">
            </div>
        </div>
    </section>
<?php endif; ?>