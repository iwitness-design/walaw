<?php

function iwd_change_hero_image() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	echo $term->description . '<br>';

	$pods = pods( 'region', $term->term_id );

	if ( $pods->field( 'banner-image' ) ) {
		//echo '<img src="' . $pods->display( 'banner-image', true ) . '">';

		echo '<style type="text/css">';
		echo '.hero-section { background-image: url( ' . $pods->display( 'banner-image', true ) . '); }';
		echo '</style>';
	}
}
add_action( 'genesis_header', 'iwd_change_hero_image' );

/*function iwd_tax_region() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	echo $term->description . '<br>';

	$params = array(
		'limit'   => -1  // Return all rows
	);

	$pods = pods( 'region', $params );

	if ( $pods->field( 'banner-image' ) ) {
		echo '<img src="' . $pods->display( 'banner-image', true ) . '">';
	}
}

//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'iwd_tax_region' );*/

genesis();
