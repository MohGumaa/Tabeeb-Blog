<?php
/**
 * The template for displaying all pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="page-wrapper page-static-wrapper" id="static-page">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">
				<div class="page-breadcrumb">
                    <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
                        }
                    ?>
                </div>
				<main class="site-main" id="main">
					<?php 
						while ( have_posts() ) {
							the_post();
							get_template_part( 'loop-templates/content', 'page' );
						}
					?>
				</main>

			</div>

		</div>

	</div>

</div>

<?php
get_footer();
