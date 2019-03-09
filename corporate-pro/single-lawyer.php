<?php

function iwd_single_lawyer() {
	the_content();

	$params = array(
		'limit'   => -1  // Return all rows
	);

	$pods = pods( 'lawyer', $params );

	if ( $pods->field( 'education' ) ) {
		echo '<strong>Education</strong>';
		echo $pods->display( 'education', true );
	}

	if ( $pods->field( 'professional-activities' ) ) {
		echo '<strong>Professional Activities</strong>';
		echo $pods->display( 'professional-activities', true );
	}

	if ( $pods->field( 'speaking-engagements' ) ) {
		echo '<strong>Speaking Engagements</strong>';
		echo $pods->display( 'speaking-engagements', true );
	}

	if ( $pods->field( 'publications' ) ) {
		echo '<strong>Publications</strong>';
		echo $pods->display( 'publications', true );
	}

}
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_content', 'iwd_single_lawyer' );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );


function iwd_remove_post_meta($post_meta) {
	/*if ( !is_page() ) {
		$post_meta = '[post_categories before="Filed Under: "] [post_tags before="Tagged: "]';
		return $post_meta;
	}*/

	return '';
}
add_filter( 'genesis_post_meta', 'iwd_remove_post_meta' );


genesis();
