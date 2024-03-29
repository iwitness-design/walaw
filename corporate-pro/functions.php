<?php
/**
 * Corporate Pro
 *
 * This file sets up the Corporate Pro Theme.
 *
 * @package   SEOThemes\CorporatePro
 * @link      https://seothemes.com/themes/corporate-pro
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

$child_theme = wp_get_theme();

// Define theme constants (do not remove).
define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

// Load Genesis Framework (do not remove).
require_once get_template_directory() . '/lib/init.php';

// Set Localization (do not remove).
load_child_theme_textdomain( CHILD_TEXT_DOMAIN, apply_filters( 'child_theme_textdomain', CHILD_THEME_DIR . '/languages', CHILD_TEXT_DOMAIN ) );

// Enable support for page excerpts.
add_post_type_support( 'page', 'excerpt' );

// Enable support for Gutenberg wide images.
add_theme_support( 'align-wide' );

// Enable support for WooCommerce.
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Add portfolio image size.
add_image_size( 'portfolio', 620, 380, true );

// Add slider image size (incase SEO slider not active).
add_image_size( 'slider', 1280, 720, true );

// Enable support for structural wraps.
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'menu-primary',
	'menu-secondary',
	'footer-widgets',
) );

// Enable Accessibility support.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
) );

// Enable custom navigation menus.
add_theme_support( 'genesis-menus', array(
	'primary'   => __( 'Header Menu', 'corporate-pro' ),
	'secondary' => __( 'After Header Menu', 'corporate-pro' ),
) );

// Enable viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Enable footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Enable support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Enable HTML5 markup structure.
add_theme_support( 'html5', array(
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form',
) );

// Enable support for post formats.
add_theme_support( 'post-formats', array(
	'aside',
	'audio',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video',
) );

// Enable support for post thumbnails.
add_theme_support( 'post-thumbnails' );

// Enable automatic output of WordPress title tags.
add_theme_support( 'title-tag' );

// Enable selective refresh and Customizer edit icons.
add_theme_support( 'customize-selective-refresh-widgets' );

// Enable theme support for custom background image.
add_theme_support( 'custom-background', array(
	'default-color' => '#fdfeff',
) );

// Enable logo option in Customizer > Site Identity.
add_theme_support( 'custom-logo', array(
	'height'      => 60,
	'width'       => 240,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( '.site-title', '.site-description' ),
) );

// Display custom logo in site title area.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Enable support for custom header image or video.
add_theme_support( 'custom-header', array(
	'header-selector'    => '.hero-section',
	'default-image'      => CHILD_THEME_URI . '/assets/images/hero.jpg',
	'header-text'        => true,
	'default-text-color' => '#2a3139',
	'width'              => 1280,
	'height'             => 720,
	'flex-height'        => true,
	'flex-width'         => true,
	'uploads'            => true,
	'video'              => true,
	'wp-head-callback'   => 'corporate_custom_header',
) );

// Register default header (just in case).
register_default_headers( array(
	'child' => array(
		'url'           => '%2$s/assets/images/hero.jpg',
		'thumbnail_url' => '%2$s/assets/images/hero.jpg',
		'description'   => __( 'Hero Image', 'corporate-pro' ),
	),
) );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove unused site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Change order of main stylesheet to override plugin styles.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_title_area', 'genesis_do_nav' );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after_header_wrap', 'genesis_do_subnav' );

// Reposition the breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'corporate_hero_section', 'genesis_do_breadcrumbs', 30 );

// Reposition featured image.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_post_content', 'genesis_do_post_image' );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

// Reposition footer widgets inside site footer.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas', 14 );

// Remove footer credits.
remove_action( 'genesis_footer', 'genesis_do_footer' );

// Remove Genesis Portfolio Pro default styles.
add_filter( 'genesis_portfolio_load_default_styles', '__return_false' );

// Remove one click demo branding.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

// Enable shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'wp_enqueue_scripts', 'corporate_scripts_styles', 90 );
/**
 * Enqueue theme scripts and styles.
 *
 * @since  1.0.0
 *
 * @return void
 */
function corporate_scripts_styles() {

	// Remove Simple Social Icons CSS (included with theme).
	wp_dequeue_style( 'simple-social-icons-font' );

	// Enqueue custom Google fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Nunito+Sans:400,600,700', array(), CHILD_THEME_VERSION );

	// Conditionally load WooCommerce styles.
	if ( corporate_is_woocommerce_page() ) {

		wp_enqueue_style( CHILD_TEXT_DOMAIN . '-woocommerce', CHILD_THEME_URI . '/woocommerce.css', array(), CHILD_THEME_VERSION );

	}

	// Conditionally load slider scripts.
	if ( ! class_exists( 'SEO_Slider_Widget' ) ) {

		wp_enqueue_script( CHILD_TEXT_DOMAIN . '-modernizr', CHILD_THEME_URI . '/assets/scripts/min/modernizr.min.js', array( 'jquery' ), '3.5.0', true );

		wp_enqueue_script( CHILD_TEXT_DOMAIN . '-slick', CHILD_THEME_URI . '/assets/scripts/min/slick.min.js', array( 'jquery' ), '1.8.1', true );

	}

	// Enqueue custom theme scripts.
	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-pro', CHILD_THEME_URI . '/assets/scripts/min/theme.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue responsive menu script.
	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-menus', CHILD_THEME_URI . '/assets/scripts/min/menus.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Disable superfish args.
	wp_deregister_script( 'superfish-args' );

	// Localize responsive menus script.
	wp_localize_script( CHILD_TEXT_DOMAIN . '-menus', 'genesis_responsive_menu', array(
		'mainMenu'         => '',
		'subMenu'          => '',
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
				'.nav-secondary',
			),
		),
	) );
}

// Load helper functions.
require_once CHILD_THEME_DIR . '/includes/helpers.php';

// Load general functions.
require_once CHILD_THEME_DIR . '/includes/general.php';

// Load widget areas.
require_once CHILD_THEME_DIR . '/includes/widgets.php';

// Load hero section.
require_once CHILD_THEME_DIR . '/includes/hero.php';

// Load Customizer settings.
require_once CHILD_THEME_DIR . '/includes/customize.php';

// Load default settings.
require_once CHILD_THEME_DIR . '/includes/defaults.php';

// Load recommended plugins.
require_once CHILD_THEME_DIR . '/includes/plugins.php';


// CUSTOM
function iwd_practice_shortcode( $args = [] ) {

	$args = wp_parse_args( $args, array(
		'echo' => false,
		'taxonomy' => 'practice',
		'hide_empty' => false,
		'location' => false,
	) );

	$tax_list = get_categories( $args );

	$html = '';

	$html .= '<div class="walaw-practice-grid">';
	foreach ( $tax_list as $item ) {
		$html .= '<div class="walaw-practice-grid__item">';
		if ( $args['location'] ) {
			$html .= '<h3 class="walaw-practice-grid__heading"><a href="/locations/' . esc_html( $args['location'] ) . '/' . $item->slug . '" class="walaw-practice-grid__link">' . $item->name . '</a></h3>';
		} else {
			$html .= '<h3 class="walaw-practice-grid__heading"><a href="' . get_category_link( $item->term_id ) . '" class="walaw-practice-grid__link">' . $item->name . '</a></h3>';
		}
		$html .= '</div>';
	}

	 $html .= '</div>';

	return $html;
}
add_shortcode( 'practice_list', 'iwd_practice_shortcode' );

function iwd_populate_referral_url( $form ){
	// Grab URL from HTTP Server Var and put it into a variable
	$refurl = $_SERVER['REQUEST_URI'];

	// Return that value to the form
	return esc_url_raw($refurl);
}
add_filter( 'gform_field_value_refurl', 'iwd_populate_referral_url');

function iwd_tax_rewrite() {
	add_rewrite_rule( '^locations/([^/]*)/([^/]*)/?$', 'index.php?location=$matches[1]&practice=$matches[2]', 'top' );

	//add_rewrite_rule( '^c/(.+?)/(.+?)/?', 'index.php?region=$matches[1]&practice=$matches[2]', 'top' );
}
add_action( 'init', 'iwd_tax_rewrite' );
