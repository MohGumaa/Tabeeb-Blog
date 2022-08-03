<?php
/**
 * Sponsored Article
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function custom_post_event() {

    // Videos Article
    $labels1 = array( 
		'name'					=> 	__( 'مقالات فيديو' ),
		'singular_name' 		=>	__( 'مقالة فيديو' ),
		'add_new' 				=>	__( 'مقالة جديده' ),
		'add_new_item' 			=> 	__( 'اضف مقالة جديده' ),
		'edit_item' 			=> 	__( 'تعديل المقالة' ),
		'new_item' 				=> 	__( 'مقالة جديده' ),
		'view_item' 			=> 	__( 'عرض المقالة' ),
		'search_items' 			=> 	__( 'بحث عن مقالة' ),
		'not_found' 			=>  __( 'لم يتم العثور علي المقالة' ),
		'not_found_in_trash' 	=> 	__( 'لم يتم العثور علي المقالة في سلة المهملات' ),
	);
    $args1 = array(
        'labels'             => $labels1,
        'hierarchical'       => false,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'revisions', 'author', 'custom-fields', 'page-attributes'),
        'publicly_queryable' => true,
        'menu_icon'          => 'dashicons-format-video',
        'menu_position'      => 5,
    );

    register_post_type('videos', $args1);
}

add_action('init', 'custom_post_event');

function custom_post_taxonomy() {

    // Videos Categories
    $args_cat_1 = array(
        'labels'            => array(
            'name'          => __( 'تصنيف الفيديوهات', 'understrap' ),
            'singular_name' => __( 'تصنيف الفيديو', 'understrap' ),
        ),
        'public'            => true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );

    register_taxonomy('videos_group', array('videos') , $args_cat_1);

}

add_action('init', 'custom_post_taxonomy');

function related_post_videos() {

    $videotterms = get_the_terms( get_the_ID(), 'videos_group'  );

    if( $videotterms ) {
        
        $videotermnames[] = 0;

        foreach( $videotterms as $videoterm ) {	
            $videotermnames[] = $videoterm->name;
        }
        
        $args = array (
            'post_type' => 'videos',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => 'videos_group',
                    'field'    => 'slug',
                    'terms'    => $videotermnames,
                ),
            ),
            'post__not_in' => array (get_the_ID()), 
        );
        
        $tabeeb_videos_post = new WP_Query( $args );	

        if( $tabeeb_videos_post->have_posts() ) : ?>
            
            <div class="related-article py-4">

                <div class="section-header">
                    <h2 class="text-info mb-0 section-title"><?php echo esc_html_e( 'فيديوهات ذات صلة', 'understrap' ); ?></h2>
                </div>

                <div class="row">

                    <?php while ($tabeeb_videos_post->have_posts()) : $tabeeb_videos_post->the_post(); ?>

                        <div class="col-md-4 col-sm-6 col-12 mb-3 mb-md-0 card-box card-br">
                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                <div class="card h-100 video-card">
                                    <a href="<?php the_permalink();?>" class="card-img-top position-relative">
                                        <?php echo get_the_post_thumbnail( $post->ID, 'tabeeb-featured' ); ?>
                                        <span class="d-flex justify-content-center align-items-center play-button">
                                            <i class="fa fa-play fs-2 text-white" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <div class="card-body px-0 pt-2 pb-0">
                                        <?php
                                            the_title(
                                                sprintf( '<h3 class="card-title"><a href="%s" rel="bookmark" class="article-title">', esc_url( get_permalink() ) ),
                                                '</a></h3>'
                                            );
                                        ?>
                                    </div>
                                </div>
                                <?php echo htmlspecialchars(get_primary_category());?>
                            </article>
                        </div>

                    <?php endwhile; ?>

                </div>

            </div>
           
        <?php endif;
        wp_reset_postdata();
    }

}





