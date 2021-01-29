<?php
/**
 * The current version of the theme.
 *
 * @package handbook
 */

define( 'AIR_VERSION', '2.7.9' );

/**
 * Disable admin bar.
 */
show_admin_bar( false );

/**
 * Fix broken umlauts caused by wp-github-sync.
 *
 * @link https://gist.github.com/Zodiac1978/05361a79c0bb3085be3e
 */
function tl_umlaut_repair( $content ) {
/*
 * Why?
 * For everyone getting this warning from W3C: "Text run is not in Unicode Normalization Form C."
 * http://www.w3.org/International/docs/charmod-norm/#choice-of-normalization-form
 */

/*
 * See: http://www.fileformat.info/info/unicode/char/0308/index.htm
 */
$content = str_replace( "a\xCC\x88", 'ä', $content );
$content = str_replace( "o\xCC\x88", 'ö', $content );
$content = str_replace( "u\xCC\x88", 'ü', $content );
$content = str_replace( "A\xCC\x88", 'Ä', $content );
$content = str_replace( "O\xCC\x88", 'Ö', $content );
$content = str_replace( "U\xCC\x88", 'Ü', $content );

return $content;
}

add_filter( 'the_content', 'tl_umlaut_repair', 10, 1 );

add_filter( 'the_title', 'wpse_title' );
function wpse_title( $title ) {
  $title = str_replace( "a\xCC\x88", 'ä', $title );
  $title = str_replace( "o\xCC\x88", 'ö', $title );
  $title = str_replace( "u\xCC\x88", 'ü', $title );
  $title = str_replace( "A\xCC\x88", 'Ä', $title );
  $title = str_replace( "O\xCC\x88", 'Ö', $title );
  $title = str_replace( "U\xCC\x88", 'Ü', $title );

  return $title;
}

/**
 * Define SendGrid credentials
 */
define( 'SENDGRID_API_KEY', getenv( 'SENDGRID_API_KEY' ) );
define( 'SENDGRID_CATEGORIES', 'handbook' );

/**
 * Requires.
 */
require get_theme_file_path( '/inc/functions.php' );

/**
 * Walker for sitemap
 */
class handbook_walker extends Walker_Page {
    /**
     * @see Walker::start_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     * @param array $args
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat( "\t", $depth );
      $output .= "\n$indent<ol class='sub-menu children'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    	$output .= '</ol>';
    }
  }

/**
 * Disable stuff.
 */
function remove_posts_menu() {
  remove_menu_page( 'edit.php' );
}
add_action( 'admin_init', 'remove_posts_menu' );

/**
 * Auto sync nav.
 */
add_filter( 'amfp_auto_sync_menu', '__return_true' );

/**
 * Enable theme support for essential features.
 */
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

/**
 * Load textdomain and set a locale.
 */
load_theme_textdomain( 'handbook', get_template_directory() . '/languages' );
setlocale( LC_ALL, 'fi_FI.utf8' );

/**
 * Enqueue scripts and styles.
 */
function handbook_scripts() {
	$handbook_template = 'global.min';

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
