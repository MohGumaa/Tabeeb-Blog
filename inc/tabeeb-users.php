<?php 
/**
 * Get Users
 *
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function tabeeb_users( $tabeeb_user_role = array(), $tabeeb_user_exclude = array() ) {
    $number = 16;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $offset = ($paged - 1) * $number;

    $args = [
		'role__in' => $tabeeb_user_role,
		'orderby'  => 'post_count',
		'order'    => 'DESC',
        'exclude'  => $tabeeb_user_exclude,
	];

    $tabeeb_user_query = get_users($args);
    $tabeeb_user_query_total = count($tabeeb_user_query);
    $args['number'] = $number;
	$args['offset'] = $offset;
    $tabeeb_user_result = get_users($args);
	$tabeeb_user_result_total  = count($tabeeb_user_result);
    $total_pages = intval($tabeeb_user_query_total / $number ) + 1;

    return [$tabeeb_user_result, $tabeeb_user_query_total, $tabeeb_user_result_total, $total_pages];

}