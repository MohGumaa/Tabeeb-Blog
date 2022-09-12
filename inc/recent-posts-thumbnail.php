<?php
/**
 * Add Thumbnail image for recent post
 * 
 * Extend Recent Posts Widget 
 * 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$tabeeb_recent_posts = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
            'post__not_in'        => array(get_the_ID()),
            'category__not_in' => array(92),

            // required by PVC
            'suppress_filters' => false,
            'orderby' => 'post_views',
            'fields' => ''
		) ) );

		if ($tabeeb_recent_posts->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<div class="tabeeb-recent-posts">

            <?php while ( $tabeeb_recent_posts->have_posts() ) : $tabeeb_recent_posts->the_post(); ?>
            
                <div class="mb-4 card-box card-br">
                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <div class="card h-100">
                            <a href="<?php the_permalink();?>" class="card-img-top">
                                <?php echo get_the_post_thumbnail( get_the_ID(), 'tabeeb-large' ); ?>
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

            <?php endwhile; ?>

        </div>
		
        <?php echo $args['after_widget']; ?>
		
        <?php
	
		wp_reset_postdata();

		endif;
	}
}
function my_recent_widget_registration() {
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');