<?php
/**
 *Template Name: Thanks Layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

if ( isset( $_COOKIE['doctor_name'] ) ) {
    $doc_name = htmlspecialchars($_COOKIE["doctor_name"]);
    setcookie("doctor_name", "", time()-3600);
    
} else {
    header('Location: /');
    die();
}

?>

<div class="page-wrapper thanks-page" id="static-page">
    <div class="container">
        <main class="d-flex flex-column justify-content-center site-main mt-4 mt-md-5 p-3 p-md-4 rounded" style="background: url('<?php echo get_theme_file_uri( 'images/thanks-bg.jpg' ); ?>') no-repeat center center/cover" id="main">
            <h1 class="text-info">شكراً لك</h1>
            <p class="text-primary fs-4 mb-1">تم حجز الموعد بنجاح</p>
            <p class="text-primary fs-5"><?php echo $doc_name; ?></p>
		</main>
    </div>
</div>

<?php
get_footer();
