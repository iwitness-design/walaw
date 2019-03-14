<?php

//remove_action( 'corporate_hero_section', 'genesis_do_breadcrumbs', 9999 );
//add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

function iwd_single_lawyer() {

	$params = array(
		'limit'   => -1  // Return all rows
	);

	$pods = pods( 'lawyer', $params );

	?>
		<div class="walaw-single-lawyer">
			<div class="walaw-left">
				<?php the_content(); ?>
			</div>
			<div class="walaw-right">

				<?php if ( $pods->field( 'contact-email' ) || $pods->field( 'contact-phone' ) ) { ?>
					<div>
						<strong>Contact</strong>
						<?php
							if ( $pods->field( 'contact-phone' ) ) {
								echo '<p>Phone: ' . $pods->display( 'contact-phone', true ) . '</p>';
							}

							if ( $pods->field( 'contact-email' ) ) {
								echo '<p>Email: <a href="mailto:' . esc_attr( $pods->display( 'contact-email', true ) ) . '">' . $pods->display( 'contact-email', true ) . '</a></p>';
							}
						?>
					</div>
				<?php } ?>

				<?php if ( $pods->field( 'practice-areas' ) ) { ?>

					<?php

					$practice_area = $pods->fetch( 'practice-areas' );

					if ( ! empty( $practice_area['practice-areas'] ) ) {
					?>
					<div>
						<strong>Practice Areas</strong>
						<p>
							<?php echo '<a href="' . get_category_link( $practice_area['practice-areas']['term_id'] ) .'">' . $practice_area['practice-areas']['name'] . '</a>'; ?>
						</p>

					</div>
				<?php } } ?>

				<?php if ( $pods->field( 'education' ) ) { ?>
					<div>
						<strong>Education</strong>
						<?php echo $pods->display( 'education', true ); ?>
					</div>
				<?php } ?>

				<?php if ( $pods->field( 'professional-involvement' ) ) { ?>
					<div>
						<strong>Professional Involvement</strong>
						<?php echo $pods->display( 'professional-involvement', true ); ?>
					</div>
				<?php } ?>
			</div>
		</div>

	<?php

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
