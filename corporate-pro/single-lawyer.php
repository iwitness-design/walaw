<?php

remove_action( 'genesis_before_content_sidebar_wrap', 'corporate_hero_section' );

function iwd_change_add_skyscraper() {

	global $post;

	//$thumbnail = get_the_post_thumbnail_url( $post->ID );

	$params = array(
		'limit'   => -1  // Return all rows
	);

	$pods = pods( 'lawyer', $params );

	$skyscraper = $pods->display( 'skyscraper-image' );

	if ( ! empty( $skyscraper ) ) {
		//echo '<img src="' . $pods->display( 'banner-image', true ) . '">';

		echo '<style type="text/css">';
		echo '@media (min-width: 769px) { body { background-image: url( ' . $skyscraper . '); background-position: center; background-repeat: no-repeat; background-size: cover; } }';
		echo '</style>';
	}
}
add_action( 'genesis_header', 'iwd_change_add_skyscraper' );

function iwd_single_lawyer() {

	$params = array(
		'limit'   => -1  // Return all rows
	);

	$pods = pods( 'lawyer', $params );

	?>
		<div class="walaw-single-lawyer">
			<div class="walaw-left">

				<h1><?php the_title(); ?></h1>
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
							<?php
								foreach ( $practice_area['practice-areas'] as $practice ) {
									echo '<a href="' . get_category_link( $practice['term_id'] ) . '">' . $practice['name'] . '</a><br>';
								}
							?>
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
	return '';
}
add_filter( 'genesis_post_meta', 'iwd_remove_post_meta' );


genesis();
