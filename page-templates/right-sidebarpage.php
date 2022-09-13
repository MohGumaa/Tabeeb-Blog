<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-wrapper page-static-wrapper bg-white">

	<div class="container" id="content">

        <div class="page-breadcrumb">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
				}
			?>
		</div>

		<div class="row">
            <?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
		    
            <main class="site-main" id="main" role="main">
                
                <?php
                while ( have_posts() ) {
                    the_post();
                    get_template_part( 'loop-templates/content', 'page' );
                }
                ?>

			</main>

			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div>

	</div>

</div>

<?php
get_footer();