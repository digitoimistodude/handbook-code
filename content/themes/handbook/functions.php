<?php
/**
 * The current version of the theme.
 *
 * @package handbook
 */

define( 'AIR_VERSION', '2.7.9' );

/**
 * Requires.
 */
require get_theme_file_path( '/inc/functions.php' );
require get_theme_file_path( '/inc/menus.php' );
require get_theme_file_path( '/inc/nav-walker.php' );

/**
 * Enable theme support for essential features.
 */
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
// add_theme_support( 'woocommerce' );

/**
 * Load textdomain and set a locale.
 */
load_theme_textdomain( 'handbook', get_template_directory() . '/languages' );
setlocale( LC_ALL, 'fi_FI.utf8' );

/**
 * Enqueue scripts and styles.
 */
function handbook_scripts() {
	$handbook_template = 'global';

	// Styles.
	wp_enqueue_style( 'styles', get_theme_file_uri( "css/{$handbook_template}.css" ), array(), filemtime( get_theme_file_path( "css/{$handbook_template}.css" ) ) );

	// Scripts.
	wp_enqueue_script( 'jquery-core' );
	wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.js' ), array(), filemtime( get_theme_file_path( 'js/all.js' ) ), true );
	wp_localize_script( 'scripts', 'screenReaderTexts', array(
		'expandMenu'      => esc_html__( 'Open menu', 'handbook' ),
		'collapseMenu'    => esc_html__( 'Close menu', 'handbook' ),
		'expandSubMenu'   => '<span class="screen-reader-text">' . __( 'Open sub menu', 'handbook' ) . '</span>',
		'collapseSubMenu' => '<span class="screen-reader-text">' . __( 'Close sub menu', 'handbook' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'handbook_scripts' );
