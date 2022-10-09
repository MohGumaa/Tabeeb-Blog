<?php 
/**
 * Show Author Socail Icon
 *
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function author_social () {

  // Get socail URL
  $linkedin  = get_the_author_meta('linkedin');
  $facebook  = get_the_author_meta('facebook');
  $twitter   = get_the_author_meta('twitter');
  $instagram = get_the_author_meta('instagram');

  $contentSocail = '<ul class="nav d-none d-sm-flex algin-items-center author-socials mt-4">';

  if ($linkedin) {
    $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
  }

  
  if ($twitter) {
    $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$twitter.'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
  }
  
  if ($instagram) {
    $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$instagram.'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
  }

  if ($facebook) {
    $contentSocail .= '<li class="nav-item"><a class="nav-link d-flex justify-content-center align-items-center" href="'.$facebook.'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
  }
  
  $contentSocail .= '</ul>';
  
  return $contentSocail;

}
