<?php
/**
 * Template Name: Our Writers Layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$tabeeb_user_role    = ['Author',];
$tabeeb_user_exclude = ['36',];

[$tabeeb_user_query, $tabeeb_user_query_total, $tabeeb_user_loop, $tabeeb_user_loop_total, $total_pages, $tabeeb_query_all_user] = tabeeb_users($tabeeb_user_role, $tabeeb_user_exclude);

get_header();

?>

<div class="page-wrapper tabeeb-users-page">

	<div class="container" id="content">

        <div class="section-box-header bg-white">
            <?php the_title( '<h1 class="text-info mb-0 section-title">', '</h1>' ); ?>
        </div>

        <?php if ( $tabeeb_user_loop ) : ?>
            <main class="site-main" id="main" role="main">

                <div class="row gx-3">
                    <?php foreach ( $tabeeb_user_loop as $writer ) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                            <div class="card h-100 tabeeb-user">
                                <a href="<?php echo get_author_posts_url($writer->ID);?>" class="card-img-top">
                                    <?php echo get_avatar( $writer->ID, 100 ); ?>
                                </a>
                                <div class="card-body px-0">
                                    <h2 class="card-title text-center">
                                        <a href="<?php echo get_author_posts_url($writer->ID);?>">
                                            <?php echo get_the_author_meta('display_name', $writer->ID);?>
                                        </a>
                                    </h2>
                                    
                                    <p class="card-text text-secondary text-center text-md-end">
                                        <?php echo get_the_author_meta('description', $writer->ID); ?>
                                    </p>
                                </div>

                                <div class="d-flex flex-wrap align-items-center">
                                    <?php 
                                        $linkedin  = get_the_author_meta('linkedin', $writer->ID);
                                        $facebook  = get_the_author_meta('facebook', $writer->ID);
                                        $twitter   = get_the_author_meta('twitter', $writer->ID);
                                        $instagram = get_the_author_meta('instagram', $writer->ID);

                                        $contentSocail = '';
                                        
                                        if ($linkedin) {
                                        $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin text-info"></i></a></li>';
                                        }
                                        
                                        if ($twitter) {
                                        $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$twitter.'" target="_blank"><i class="fa fa-twitter text-info"></i></a></li>';
                                        }
                                        
                                        if ($instagram) {
                                        $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$instagram.'" target="_blank"><i class="fa fa-instagram text-info"></i></a></li>';
                                        }
                                    
                                        if ($facebook) {
                                        $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$facebook.'" target="_blank"><i class="fa fa-facebook text-info"></i></a></li>';
                                        }

                                        if ( $contentSocail ) {
                                            echo '<ul class="nav algin-items-center author-socials">';
                                            echo $contentSocail;
                                            echo '</ul>';
                                        }
                                        
                                    ?>
                           
                                    <span class="d-block me-auto text-secondary badge-number-posts">
                                        <?php esc_html_e( 'المقالات', 'understrap' ); ?> : <?php echo count_user_posts( $writer->ID ); ?>
                                    </span>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <?php 
                   if ( $tabeeb_user_query_total > $tabeeb_user_loop_total ) {
                    echo '<nav aria-labelledby="posts-nav-label" class="d-flex justify-content-center mt-3 pagination-custom">';
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

            </main>
        <?php endif;?>

	</div>

</div>

<?php
get_footer();