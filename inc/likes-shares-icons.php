<?php
/**
 * Share icon function for articles
 * 
 * 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function post_social_sharing_buttons($content) {
	global $post;
	if(is_single()){
	
		// Get current page URL 
		$postURL = urlencode(get_permalink());
 
		// Get current page title
		$postTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
		$postTitle = str_replace( ' ', '%20', get_the_title());
		
		// Construct sharing URL without using any script
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$postURL;
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$postTitle.'&amp;url='.$postURL.'&amp;via=tabeeb.com';
		$whatsappURL = 'https://api.whatsapp.com/send?text='.urldecode($postURL);
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$postURL.'&amp;title='.$postTitle;

		$content .= '<div class="d-flex justify-content-between justify-content-md-start align-items-center mt-4 share-social section-box-header">';
		$content .= get_simple_likes_button( get_the_ID() );
		$content .= '<a class="share-link share-whatsapp me-0 me-md-auto" href="'.$whatsappURL.'" target="_blank" title="share on whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>';
        $content .= '<a class="share-link share-linkedin" href="'.$linkedInURL.'" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
        $content .= '<a class="share-link share-twitter" href="'. $twitterURL .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
        $content .= '<a class="share-link share-facebook" href="'.$facebookURL.'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
		$content .=  '</div>';
		
		return $content;
	}else{
		return $content;
	}
};
add_filter( 'the_content', 'post_social_sharing_buttons');

// This will create a wordpress shortcode [social].
add_shortcode('social','post_social_sharing_buttons');
