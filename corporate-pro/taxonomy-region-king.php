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
	$terms = get_terms( array(
		'taxonomy'   => 'region',
		'hide_empty' => false,
	    'parent' => 0,
	    'include' => [ 46, 47, 48 ],
	) );

	echo '<h1 style="margin: 0 auto 1em;">Choose your Location</h1>';
	echo '<div class="walaw-practice-grid walaw-practice-grid-3">';
	foreach ( $terms as $term ) {
			echo '<div class="walaw-practice-grid__item">';
			echo '<h3 class="walaw-practice-grid__heading"><a href="' . get_category_link( $term->term_id ) . '" class="walaw-practice-grid__link">' . $term->name . '</a></h3>';
			echo '</div>';
	}
	echo '</div>';
}

//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'iwd_tax_region' );

genesis();
