<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
?>

<div class="page-wrapper" id="search-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php if ( have_posts() ) : ?>

				<div class="page-breadcrumb">
					<?php
						if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
						}
					?>
				</div>

				<header class="page-header">
					<h1 class="page-title mb-3 pb-1">
						<?php
						printf(
							esc_html__( 'نتائج البحث عن : %s', 'understrap' ),
							'<span class="text-info">' . get_search_query() . '</span>'
						);
						?>
					</h1>
				</header>

				<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'loop-templates/content', 'search' );
					endwhile;
				?>

			<?php else : ?>
				<?php get_template_part( 'loop-templates/content', 'none' ); ?>
			<?php endif; ?>

		</main>

		<?php understrap_pagination(); ?>

	</div>

</div>

<?php
get_footer();
