<?php

function iwd_change_hero_image() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	$pods = pods( 'region', $term->term_id );

	if ( $pods->field( 'banner-image' ) ) {
		//echo '<img src="' . $pods->display( 'banner-image', true ) . '">';

		echo '<style type="text/css">';
		echo '.hero-section { background-image: url( ' . $pods->display( 'banner-image', true ) . '); }';
		echo '</style>';
	}
}
add_action( 'genesis_header', 'iwd_change_hero_image' );

function iwd_tax_region() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	$args = array(
		'echo' => false,
		'taxonomy' => 'practice',
		'hide_empty' => false,
	);

	$tax_list = get_categories( $args );

	//echo '<pre>' . print_r( $tax_list, true ) . '</pre>';

	//global $post;

	$region = $term->slug;

	echo '<div>';
	echo '<p>Below is a list of legal services we offer. If you are unsure what kind of services you need, please <a href="/contact">contact us</a>.';

	echo '<div class="walaw-practice-grid">';
	foreach ( $tax_list as $item ) {
		echo '<div class="walaw-practice-grid__item">';
		//echo '<h3 class="walaw-practice-grid__heading"><a href="' . get_category_link( $item->term_id ) . '" class="walaw-practice-grid__link">' . $item->name . '</a></h3>';
		echo '<h3 class="walaw-practice-grid__heading"><a href="/locations/' . $region . '/' . $item->slug . '" class="walaw-practice-grid__link">' . $item->name . '</a></h3>';
		echo '</div>';
	}
	echo '</div>';

}

//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'iwd_tax_region' );

genesis();
