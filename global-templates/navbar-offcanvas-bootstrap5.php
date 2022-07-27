<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark bg-info py-0" aria-labelledby="main-nav-label">

	<div class="<?php echo esc_attr( $container ); ?> position-relative">

		<button type="button" class="btn slide-menu__control navbar-toggler menu__toggler d-block d-lg-none" data-target="primary-menu" data-action="toggle">
			<span></span>
        </button>
		
		<?php if ( ! has_custom_logo() ) : ?>
			<a class="navbar-brand text-white mx-0 mb-0" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url">
				<img width="105" src="<?php echo get_theme_file_uri( 'images/tabeeb-logo.svg' ); ?>" class="img-fluid" alt="Tabeeb Logo">
			</a>
		<?php else : ?>
			<?php the_custom_logo(); ?>
		<?php endif; ?>

		<div class="slide-menu d-block d-lg-none" id="primary-menu">

			<?php 
				wp_nav_menu(
					array(
					'theme_location' => 'mobile',
					'container' => '',
					'menu_class'      => 'menu',
					'menu_id'         => 'mobile-menu',
					)
				);
			?>
		</div>

		<div class="flex-grow-1 mx-0 mx-lg-5 d-none d-lg-block">
			<?php wp_nav_menu( array( 'theme_location' => 'desktop' ) ); ?>
		</div>
		
		<i id="search-btn" class="d-none d-lg-block fs-4 icon-search icon"></i>
		<button type="button" id="btn-mobile-menu" class="btn slide-menu__control d-block d-lg-none fs-3 p-0 text-white" data-target="primary-menu" data-action="toggle">
			<i class="d-flex justify-content-center align-items-center fs-4 icon-search icon"></i>
		</button>

		<form action="<?php echo esc_url(home_url( '/' ));?>" id="search-from" class="search-form-desktop" autocomplete="off">
			<label class="sr-only" for="searchInput">أكتب شيء</label>
			<div class="input-group">
				<input 
					type="search" 
					class="field form-control border-0 rounded" 
					title="أكتب شيء" id="searchInput" 
					name="s" type="text" 
					placeholder="أكتب شيء" 
					value="<?php the_search_query(); ?>" 
					onkeyup="fetchResults()"
					oninvalid="this.setCustomValidity('من فضلك ادخل كلمة البحث')"
        			oninput="setCustomValidity('')" 
					required
				>
				<span class="input-group-append d-none">
					<button class="btn btn-primary rounded d-flex align-items-center h-100"><i class="icon-search fs-6"></i></button>
				</span>
			</div>
		</form>

		<div class="d-none d-lg-block live-search-result"></div>

	</div>

</nav>
