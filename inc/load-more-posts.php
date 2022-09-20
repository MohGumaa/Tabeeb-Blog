<?php 
/**
 * Load More Post
 *
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'wp_footer', 'my_action_javascript' );

function my_action_javascript() { ?>
	<script type="text/javascript" >
		jQuery(document).ready(function($) {

			const ajaxurl  = '<?php echo admin_url('admin-ajax.php'); ?>';

			const showMore = jQuery('#show_more');
			const spinnerPost = jQuery('#spinner-post');

			let tabeebUser = showMore.data('tabeebuser');
			let prePage    = showMore.data('perpage');
			let page       = showMore.data('page') + 1;

			showMore.click(function(e) {
				showMore.attr("disabled",true);
				spinnerPost.removeClass("d-none");

				let data = {
					'action'     : 'my_action',
					'page'       : page,
					'prePage'    : prePage,
					'post_type'  : 'post',
					'post_status':  'publish',
					'tabeebUser': tabeebUser
				};

				jQuery.post(ajaxurl, data, function(response) {
					
					if ( response ) {
						jQuery('.posts').append(response);
						page = page + 1;

						showMore.attr("disabled",false);
						spinnerPost.addClass("d-none");

					} else {
						showMore.hide().attr("disabled",true).text("لا توجد مقالات أخرى").fadeIn(1000);
					}

				});
			});

		});
	</script> <?php
}

add_action( 'wp_ajax_my_action', 'my_action' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action' );

function my_action() {

	$pre_page = ( isset($_POST['prePage']) ) ? $_POST['prePage'] : 3;
    $page = ( isset($_POST['page']) ) ? $_POST['page'] : 3;
    $tabeeb_user = ( isset($_POST['tabeebUser']) ) ? $_POST['tabeebUser'] : 1;

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page'=> $pre_page,
        'paged' => $page,   
        'author' => $tabeeb_user,
    );

    $the_query = new WP_Query($args);

    if ( $the_query->have_posts(  ) ) {
        
        while ( $the_query->have_posts() ) {

            $the_query->the_post();
            get_template_part( 'loop-templates/content','author' );

        }

    }

    wp_reset_postdata();

	wp_die();
}

?>