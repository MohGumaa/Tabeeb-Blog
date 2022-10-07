<?php 
/**
 * Get Users
 *
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function tabeeb_users( $tabeeb_user_role = array(), $tabeeb_user_exclude = array(), $extra_args = array() ) {
    $number = 20;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $offset = ($paged - 1) * $number;

    $tabeeb_query_all_user = [];

    $args = [
		'role__in' => $tabeeb_user_role,
		'orderby'  => 'post_count',
		'order'    => 'DESC',
        'exclude'  => $tabeeb_user_exclude,
	];

    if (in_array("Contributor", $tabeeb_user_role)) {
        $tabeeb_query_all_user = get_users($args);
    }

    if ( !empty( $extra_args['is_doctor'] ) ) {
        $args['meta_query'][] = $extra_args['is_doctor'];
    }

    if ( !empty( $extra_args['search'] ) ) {
        $args['search'] = '*' . sanitize_text_field( $extra_args['search'] ) . '*';
    }

    if ( !empty( $extra_args['specialty'] ) ) {
        $args['meta_query'][] = $extra_args['specialty'];
    }

    if ( !empty( $extra_args['country'] ) ) {
        $args['meta_query'][] = $extra_args['country'];
    }

    $tabeeb_user_query = get_users($args);
    $tabeeb_user_query_total = count($tabeeb_user_query);

    $args['number'] = $number;
	$args['offset'] = $offset;

    $tabeeb_user_loop = get_users($args);
	$tabeeb_user_loop_total  = count($tabeeb_user_loop);
    $total_pages = intval($tabeeb_user_query_total / $number ) + 1;

    return [$tabeeb_user_query, $tabeeb_user_query_total, $tabeeb_user_loop, $tabeeb_user_loop_total, $total_pages, $tabeeb_query_all_user];

}