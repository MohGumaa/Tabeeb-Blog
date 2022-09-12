<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
	<div class="col-md-3 widget-area sidebar-area" id="right-sidebar">
<?php else : ?>
	<div class="col-md-4 widget-area sidebar-area" id="right-sidebar">
<?php endif; ?>
	<div class="sidebar-container">
		<?php dynamic_sidebar( 'right-sidebar' ); ?>
	</div>
</div>
