<?php
/**
 * The template for displaying all related posts
 *
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

  $orig_post = $post;
  global $post;
  $tags = wp_get_post_tags($post->ID);
  if ( $tags ) :
  $tag_ids = array();
  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
  $args=array(
    'tag__in'        => $tag_ids,
    'post__not_in'        => array($post->ID),
    'posts_per_page'      => 3,
    'category__not_in' => array(92), 
    'ignore_sticky_posts' => 1
  );

  $tabeeb_related_post = new wp_query( $args );
  if( $tabeeb_related_post->have_posts() ) :
 ?>

 <div class="tabeeb-related-posts py-4">
    <div class="section-box-header">
        <h2 class="text-info mb-0 section-title"><?php echo esc_html_e( 'مواضيع ذات صلة', 'understrap' ); ?></h2>
    </div>
    <div class="row gx-3">
        <?php while ($tabeeb_related_post->have_posts()) : $tabeeb_related_post->the_post(); ?>
            <div class="col-md-4 col-sm-6 col-12 mb-3 card-box card-br">
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
                </article> 
            </div>
        <?php endwhile; ?>
    </div>
 </div>

<?php 
    endif;
    endif;
    $post = $orig_post;
    wp_reset_postdata(); 
?>