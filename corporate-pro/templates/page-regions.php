<?php
/**
 * Template Name: Region Page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function iwd_region_page() {
	$terms = get_terms( array(
		'taxonomy'   => 'region',
		'hide_empty' => false,
	) );

	echo '<div class="walaw-practice-grid walaw-practice-grid-3">';
	foreach ( $terms as $term ) {
			echo '<div class="walaw-practice-grid__item">';
			echo '<h3 class="walaw-practice-grid__heading"><a href="' . get_category_link( $term->term_id ) . '" class="walaw-practice-grid__link">' . $term->name . '</a></h3>';
			echo '</div>';
	}
	echo '</div>';
}
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'iwd_region_page' );



// Run the Genesis loop.
genesis();
