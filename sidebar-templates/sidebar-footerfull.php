<?php
/**
 * Sidebar setup for footer full
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php if ( is_active_sidebar( 'about' ) ) : ?>

	<div class="bg-light py-5 footer-full" id="wrapper-footer-full">
		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-13 offset-lg-1 offset-md-6 mb-4 offset-sm-0 mb-lg-0">
					<?php dynamic_sidebar( 'about' ); ?>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="row">
						<?php dynamic_sidebar( 'footerfull' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
endif;
