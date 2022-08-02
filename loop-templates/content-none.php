<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found">

	<?php if (!is_author()) : ?>
		<div class="page-breadcrumb">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
				}
			?>
		</div>
	<?php endif; ?>

	<h1 class="page-title mb-3 mb-md-4 pe-1"><?php esc_html_e( 'لم يتم العثور على شيء', 'understrap' ); ?></h1>

	<div class="page-content mb-5 mb-md-3 pe-1">
		<?php if ( is_search() ) : ?>
			<?php 
				printf(
					'<p class="text-secondary mb-3 mb-md-4">%s<p>',
					esc_html__( 'آسف, ولكن لا شيء يطابق مصطلحات البحث الخاصة بك. يرجى المحاولة مرة أخرى مع بعض الكلمات الرئيسية المختلفة.', 'understrap' )
				);	
			?>
		<?php else :?>
			<?php 
			printf(
				'<p class="text-secondary mb-3 mb-md-4">%s<p>',
				esc_html__('عذراً، لم يتم العثور على نتائج بخصوص الأرشيف المطلوب، ربما يساعدك البحث في العثور على نتائج مناسبة.', 'understrap' )
			);
			?>
		<?php endif; ?>

		<?php get_search_form(); ?>
	</div>

</section>
