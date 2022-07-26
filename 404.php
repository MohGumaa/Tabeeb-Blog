<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="page-wrapper" id="error-404-wrapper">

	<div class="container" id="content" tabindex="-1">
		<div class="page-breadcrumb">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
				}
			?>
		</div>

		<div class="row">
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title mb-3 mb-md-4"><?php esc_html_e( 'هذا الأمر مربك بعض الشيء، أليس كذلك؟', 'understrap' ); ?></h1>
					</header>
					<div class="page-content">
						<p class="text-secondary mb-3"><?php esc_html_e( 'يبدو أنه لا يمكننا إيجاد ما تبحث عنه. جرب أن تبحث من جديد', 'understrap' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</section>
			</main>

			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
		</div>

	</div>

</div>

<?php
get_footer();
