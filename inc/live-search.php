<?php 
/**
 * Live Search Form
 *
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $the_query = new WP_Query( array( 'posts_per_page' => 5, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'post', 'post_status' => 'publish' ) );
    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post(); ?>
            <a href="<?php the_permalink();?>" class="text-primary my-3 px-1 px-lg-3 d-block small"><?php the_title();?></a>
        <?php endwhile; ?>
	<?php else:  ?>
        <p class="text-primary my-3 px-1 px-lg-3 small"><?php echo __( 'لا يوجد نتائج', 'understrap' ); ?></p>
    <?php endif;
    wp_reset_postdata(); 
    die();
}
// add the ajax fetch js
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">
function fetchResults(){
	var keyword = jQuery('#searchInput').val();
	if(keyword == ""){
		jQuery('#data-fetch').html("");
	} else {
		jQuery.ajax({
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'post',
			data: { action: 'data_fetch', keyword: keyword  },
			success: function(data) {
				jQuery('.live-search-result').html( data );
			}
		});
	}
    

}
</script>

<?php
}