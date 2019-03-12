<?php
/**
 * Template Name: Region Page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Force full width content layout.
//add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove default hero section.
//remove_action( 'genesis_before_content_sidebar_wrap', 'corporate_hero_section' );

function iwd_region_page() {
	$terms = get_terms( array(
		'taxonomy'   => 'region',
		'hide_empty' => false,
	) );

	//echo '<pre>' . print_r( $terms, true ) . '</pre>';

	echo '<div class="walaw-region-list">';
	foreach ( $terms as $term ) {
		echo '<p><a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></p>';
	}
	echo '</div>';
}
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'iwd_region_page' );



// Run the Genesis loop.
genesis();
