<?php
/**
 * Template Name: Our Doctors Layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$tabeeb_user_role    = ['Contributor',];
$tabeeb_user_exclude = [];

[$tabeeb_user_result, $tabeeb_user_query_total, $tabeeb_user_result_total, $total_pages] = tabeeb_users($tabeeb_user_role, $tabeeb_user_exclude);

get_header();
?>

<div class="page-wrapper tabeeb-users-page">

	<div class="container" id="content">

        <div class="section-box-header bg-white">
            <?php the_title( '<h1 class="text-info mb-0 section-title">', '</h1>' ); ?>
        </div>

        <?php if ( $tabeeb_user_result ) : ?>
            <main class="site-main" id="main" role="main">

                <div class="row gx-3">
                    <?php foreach ( $tabeeb_user_result as $tabeeb_doctor ) : 
                        $tabeeb_doctor_specialty =  get_field('doctor_specialty', 'user_'. $tabeeb_doctor->ID); 
                        $tabeeb_doctor_qualifi   =  get_field('doctor_qualifications', 'user_'. $tabeeb_doctor->ID); 
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                            <div class="card h-100 tabeeb-user">
                                <a href="<?php echo get_author_posts_url($tabeeb_doctor->ID);?>" class="card-img-top">
                                    <?php echo get_avatar( $tabeeb_doctor->ID, 100 ); ?>
                                </a>
                                <div class="card-body px-0 pb-1">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h2 class="card-title mb-0">
                                            <a href="<?php echo get_author_posts_url($tabeeb_doctor->ID);?>">
                                                <?php echo get_the_author_meta('display_name', $tabeeb_doctor->ID);?>
                                            </a>
                                        </h2>
                                        <?php if ( $tabeeb_doctor_qualifi ) : ?>
                                            <span class="author-badge me-2"><?php echo $tabeeb_doctor_qualifi; ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ( $tabeeb_doctor_specialty ) : ?>
                                        <small class="text-info d-block mb-2 specialty"><?php echo $tabeeb_doctor_specialty; ?></small>
                                    <?php endif; ?>
                                    
                                    <p class="card-text text-secondary text-center text-md-end">
                                        <?php echo get_the_author_meta('description', $tabeeb_doctor->ID); ?>
                                    </p>
                                </div>

                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <?php 
                                        $linkedin  = get_the_author_meta('linkedin', $tabeeb_doctor->ID);
                                        $facebook  = get_the_author_meta('facebook', $tabeeb_doctor->ID);
                                        $twitter   = get_the_author_meta('twitter', $tabeeb_doctor->ID);
                                        $instagram = get_the_author_meta('instagram', $tabeeb_doctor->ID);

                                        $contentSocail = '';
                                        
                                        if ($linkedin) {
                                        $contentSocail .= '<li class="nav-item mt-2"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin text-info"></i></a></li>';
                                        }
                                        
                                        if ($twitter) {
                                        $contentSocail .= '<li class="nav-item mt-2"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$twitter.'" target="_blank"><i class="fa fa-twitter text-info"></i></a></li>';
                                        }
                                        
                                        if ($instagram) {
                                        $contentSocail .= '<li class="nav-item mt-2"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$instagram.'" target="_blank"><i class="fa fa-instagram text-info"></i></a></li>';
                                        }
                                    
                                        if ($facebook) {
                                        $contentSocail .= '<li class="nav-item mt-2"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$facebook.'" target="_blank"><i class="fa fa-facebook text-info"></i></a></li>';
                                        }
                                        
                                        if ( $contentSocail ) {
                                            echo '<ul class="nav algin-items-center author-socials">';
                                            echo $contentSocail;
                                            echo '</ul>';
                                        }
                                    
                                    ?>
                           
                                    <span class="text-secondary number-posts mt-2">
                                        <?php esc_html_e( 'المقالات', 'understrap' ); ?> : <?php echo count_user_posts( $tabeeb_doctor->ID ); ?>
                                    </span>
                                </div>
                               
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="d-flex flex-wrap justify-content-between algin-items-center mt-5">
                    <?php 
                    if ( $tabeeb_user_query_total > $tabeeb_user_result_total ) {
                        echo '<nav aria-labelledby="posts-nav-label" class="d-flex justify-content-start pagination-custom">';
                        echo paginate_links(array(
                            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                            'total'        => $total_pages,
                            'current'      => max( 1, get_query_var( 'paged' ) ),
                            'format'       => '?paged=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text'    => sprintf( '<i class="icon-chevron-right d-flex justify-content-center algin-items-center" aria-hidden="true"></i>', __( 'Prev', 'understrap' ) ),
                            'next_text'    => sprintf( '<i class="icon-chevron-left d-flex justify-content-center algin-items-center" aria-hidden="true"></i>', __( 'Next', 'understrap' ) ),
                            'add_args'     => false,
                            'add_fragment' => '',
                            ));
                        echo '</nav>';
                    }
                    ?>
                    <a href="<?php echo esc_url( home_url( '/ﺗﺴﺠﻴﻞ-ﻛﻄﺒﻴﺐ' ) ); ?>" class="btn btn-info btn-sm text-white">انضم الان</a>
                </div>

            </main>
        <?php endif;?>

	</div>

</div>

<?php
get_footer();