<?php
/**
 * Template Name: Our Doctors Layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

$tabeeb_user_role    = ['Contributor',];
$tabeeb_user_exclude = [];
$extra_args = [];

$extra_args['is_doctor'] = array(
    'key' => 'is_it_a_doctor',
    'value' => '1'
);

// Check if the query given in the url
if ( isset( $_GET['اسم'] ) ) {
    if ( ! empty( $_GET['اسم'] ) ) {
        $extra_args['search'] = sanitize_text_field( $_GET['اسم'] );
    }
}

if ( isset( $_GET['اﻟﺘﺨﺼﺺ'] ) ) {
    if ( ! empty( $_GET['اﻟﺘﺨﺼﺺ'] ) ) {
        $extra_args['specialty'] = array(
            'key' => 'doctor_specialty',
            'value' => sanitize_text_field( $_GET['اﻟﺘﺨﺼﺺ']),
            'compare' => 'LIKE'
        );
    }
}

if ( isset( $_GET['الدولة'] ) ) {
    if ( ! empty( $_GET['الدولة'] ) ) {
        $extra_args['country'] = array(
            'key' => 'country_name',
            'value' => sanitize_text_field( $_GET['الدولة']),
            'compare' => 'LIKE'
        );
    }
}

[$tabeeb_user_query, $tabeeb_user_query_total, $tabeeb_user_loop, $tabeeb_user_loop_total, $total_pages, $tabeeb_query_all_user] = tabeeb_users($tabeeb_user_role, $tabeeb_user_exclude, $extra_args);

// Order Doctors based on posts
$doctors_posts = array();

foreach ($tabeeb_user_loop as $user) {
    $articles_tabeeb = count_user_posts($user->ID, $post_type = "post");
    $doctors_posts[] = array(
        'total' => $articles_tabeeb,
        'tabeeb' => $user
    );
}

usort($doctors_posts, function($a, $b) {
    if($a['total']==$b['total']) return 0;
    return $a['total'] < $b['total']?1:-1;
}); 

// Get All Specialties of Doctors
$tabeeb_specialties_list = array();
$tabeeb_countries = array();

foreach ($tabeeb_query_all_user as $doctor ) {
	array_push($tabeeb_specialties_list, get_field('doctor_specialty', 'user_'. $doctor->ID));
	array_push($tabeeb_countries, get_field('country_name', 'user_'. $doctor->ID));
}

$tabeeb_specialties_list = array_unique($tabeeb_specialties_list);

?>

<div class="page-wrapper tabeeb-users-page">

	<div class="container" id="content">

        <div class="page-breadcrumb">
			<span id="breadcrumbs">
				<span>
					<span>
						<a href="<?php echo get_home_url(); ?>">الرئيسية</a>
						<span class="breadcrumb_last" aria-current="page">دليل أهم الأطباء</span>
					</span>
				</span>
			</span>
		</div>

        <form action="<?php echo esc_url( home_url( '/طاقم-أطباء-طبيب' ) ); ?>" class="row gx-3 align-items-center mb-4 bg-white shadow py-3 px-2 filter-form">
            <div class="col-lg-3 col-md-6 col-12 mb-3 mb-lg-0">
                <input 
                    type="text" 
                    class="form-control" 
                    name="اسم" 
                    placeholder="بحث عن الدكتور"
                    value="<?php echo isset($_GET['اسم']) ? $_GET['اسم'] : ''; ?>"
                />
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3 mb-lg-0">
                <select class="form-select" name="اﻟﺘﺨﺼﺺ" >
                    <option value=""><?php echo esc_attr_x( 'اﺧﺘﺮ اﻟﺘﺨﺼﺺ', 'placeholder', 'understrap' ); ?></option>
                    <?php foreach ( $tabeeb_specialties_list as $special ) : ?>
                        <option 
                            <?php if ( isset( $_GET['اﻟﺘﺨﺼﺺ'] ) && $_GET['اﻟﺘﺨﺼﺺ'] == $special  ) : ?>
                                selected
                            <?php endif; ?>
                            value="<?php echo $special; ?>"
                        >
                            <?php echo $special; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3 mb-lg-0">
                <select class="form-select" name="الدولة" >
                    <option value=""><?php echo esc_attr_x( 'اﺧﺘﺮ الدولة', 'placeholder', 'understrap' ); ?></option>
                    <option value="saudi_arabia" 
                        <?php if ( isset( $_GET['الدولة'] ) && $_GET['الدولة'] == "saudi_arabia"  ) : ?>
                            selected
                        <?php endif; ?>
                    >المملكة العربية السعودية</option>
                    <option value="united_arab_emirates"
                        <?php if ( isset( $_GET['الدولة'] ) && $_GET['الدولة'] == "united_arab_emirates"  ) : ?>
                            selected
                        <?php endif; ?>
                    >الإمارات العربية المتحدة</option>
                </select>
            </div>
            <div class="col-lg-auto col-md-6 col-6 mb-3 mb-lg-0 d-none">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="تقييم" 
                        id="rating"
                        value="rating"				
                    >
                    <label class="form-check-label" for="rating">
                    الأكثر تقييماً 
                    </label>
                </div>
            </div>

            <div class="col-lg-auto col-md-12 col-12 me-auto">
                <button class="btn btn-info btn-sm text-white px-3 w-100"><?php echo esc_attr_x( 'عرض النتائج', 'submit button', 'understrap' ); ?></button>
            </div>
        </form>

        <?php if ( $tabeeb_user_loop ) : ?>
            <main class="site-main" id="main" role="main">

                <div class="row gx-3">
                    <?php foreach ( $doctors_posts as $tabeeb_doctor ) : 
                        $tabeeb_doctor_specialty =  get_field('doctor_specialty', 'user_'. $tabeeb_doctor['tabeeb']->ID); 
                        $tabeeb_doctor_qualifi   =  get_field('doctor_qualifications', 'user_'. $tabeeb_doctor['tabeeb']->ID); 
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                            <div class="card h-100 tabeeb-user">
                                <a href="<?php echo get_author_posts_url($tabeeb_doctor['tabeeb']->ID);?>" class="card-img-top">
                                    <?php echo get_avatar( $tabeeb_doctor['tabeeb']->ID, 100 ); ?>
                                </a>
                                <div class="card-body px-0 pb-1">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h2 class="card-title mb-0">
                                            <a href="<?php echo get_author_posts_url($tabeeb_doctor['tabeeb']->ID);?>">
                                                <?php echo get_the_author_meta('display_name', $tabeeb_doctor['tabeeb']->ID);?>
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
                                        <?php echo get_the_author_meta('description', $tabeeb_doctor['tabeeb']->ID); ?>
                                    </p>
                                </div>

                                <div class="d-flex flex-wrap align-items-center">
                                    <?php 
                                        $linkedin  = get_the_author_meta('linkedin', $tabeeb_doctor['tabeeb']->ID);
                                        $facebook  = get_the_author_meta('facebook', $tabeeb_doctor['tabeeb']->ID);
                                        $twitter   = get_the_author_meta('twitter', $tabeeb_doctor['tabeeb']->ID);
                                        $instagram = get_the_author_meta('instagram', $tabeeb_doctor['tabeeb']->ID);

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
                                        <?php esc_html_e( 'المقالات', 'understrap' ); ?> : <?php echo count_user_posts( $tabeeb_doctor['tabeeb']->ID ); ?>
                                    </span>
                                </div>
                               
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="d-flex flex-wrap justify-content-between algin-items-center mt-4">
                    <?php 
                    if ( $tabeeb_user_query_total > $tabeeb_user_loop_total ) {
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
        <?php else : ?>

            <main class="site-main">
                <h2 class="entry-title mt-5 mt-md-3">
                    <?php echo esc_html_e( 'عذرا ، لم يتم العثور على نتائج', 'understrap' ); ?>
                </h2>
                <p class="text-secondary">
                    <?php echo esc_html_e( 'عذراً، لم يتم العثور على أطباء، من فضلك أدخل مدخلات اخري وحاول من جديدة.', 'understrap' ); ?>
                </p>
            </main>

        <?php endif;?>

	</div>

</div>

<?php
get_footer();