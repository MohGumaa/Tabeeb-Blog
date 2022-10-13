<?php
/**
 *Template Name: Booking Layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

$doctor_name = '';

if( isset($_GET['doctor-name']) )
{
    if(!empty($_GET['doctor-name']))
    {
        $doctor_name = $_GET['doctor-name'];
        setcookie("doctor_name", $doctor_name, time() + (86400 * 30), "/");
    }
}

if( isset($_GET['doctor-id']) )
{
    if(!empty($_GET['doctor-id']))
    {
        $doctor_ID = $_GET['doctor-id'];
        $author_obj = get_user_by('id', $doctor_ID);
    }
}

?>

<div class="page-wrapper page-static-wrapper booking-page" id="static-page">
    <div class="container">
        <div class="page-breadcrumb">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
                }
            ?>
        </div>
        <main class="site-main" id="main" role="main">
                <h1 class="lg-header text-center my-3">
                    <?php the_title(); ?> مع <span class=""><?php echo $doctor_name; ?>
                </h1>
            <?php   
                the_content();
            ?>
        </main>
    </div>
</div>

<script>
    (function($){
        $('.email-booking input').attr('value', '<?php echo isset($author_obj) ?  $author_obj->user_email : 's'; ?>');
        bookingDate.attr('id', 'pickadate'); 
    })(jQuery);
</script>

<?php
get_footer();
