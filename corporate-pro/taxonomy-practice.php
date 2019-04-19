<?php

function iwd_change_hero_image_practice() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	$pods = pods( 'practice', $term->term_id );

	if ( $pods->field( 'banner-image' ) ) {
		//echo '<img src="' . $pods->display( 'banner-image', true ) . '">';

		echo '<style type="text/css">';
		echo '.hero-section { background-image: url( ' . $pods->display( 'banner-image', true ) . '); }';
		echo '</style>';
	}
}
add_action( 'genesis_header', 'iwd_change_hero_image_practice' );

function iwd_tax_practice() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	echo '<div class="walaw-practice-description">';
	echo $term->description;
	echo '</div>';

	$pods = pods( 'practice', $term->term_id );

	if ( ! empty( $pods->display( 'button-label' ) ) ) {
		echo '<div class="wp-block-button">';
		echo '<a href="' . esc_url( $pods->display( 'button-link' ) ) . '" class="wp-block-button__link">' . $pods->display( 'button-label' ) . '</a>';
		echo '</div>';
	}

//	echo '<div class="walaw-client-request">';
//	echo do_shortcode( '[gravityform id="2"]' );
//	echo '</div>';

	echo '<div><br />';

	$justin = get_post( 53 );

	if ( $justin && in_array( $term->slug, [ 'real-estate', 'construction', 'business', 'contracts' ] ) ) {
		echo '<h3>Lawyers</h3>';
		echo '<div class="walaw-lawyer-thumb">';
		echo '<p><a href="' . get_permalink( $justin->ID ) . '"><img src="' . get_the_post_thumbnail_url( $justin->ID ) . '"></a></p>';
		echo '<p class="lawyer-name"><a href="' . get_permalink( $justin->ID ) . '">' . $justin->post_title . '</a></p>';
		echo '</div>';
	}
	echo '</div>';
}

//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'iwd_tax_practice' );

//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

genesis();

