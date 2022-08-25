<?php
/**
 * The template for front page
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

?>

<div class="page-wrapper frontpage" id="frontpage-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'loop-templates/content', 'frontpage' );
			}
			?>
		</main>
	</div>

</div>

<?php
get_footer();
