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
 * Define SendGrid credentials
 */
define( 'SENDGRID_API_KEY', getenv( 'SENDGRID_API_KEY' ) );
define( 'SENDGRID_CATEGORIES', 'handbook' );

/**
 * Hide WP updates nag.
 * Turn off by using `remove_action( 'admin_menu', 'air_helper_wphidenag' )`
 *
 * @since  0.1.0
 */
function air_helper_wphidenag() {
  remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action( 'admin_menu', 'air_helper_wphidenag' );

/**
 *  Force to address in wp_mail.
 *  Change address from admin_email by using `add_filter( 'air_helper_helper_mail_to', 'myprefix_override_air_helper_helper_mail_to' )`
 *
 *  @since  0.1.0
 *  @param  array $args Default wp_mail agruments.
 *  @return array         New wp_mail agruments with forced to address
 */
function air_helper_helper_force_mail_to( $args ) {
    $args['to'] = apply_filters( 'air_helper_helper_mail_to', get_option( 'admin_email' ) );
    return $args;
}

/**
 * Remove archive title prefix.
 * Turn off by using `remove_filter( 'get_the_archive_title', 'air_helper_helper_remove_archive_title_prefix' )`
 *
 * @since  0.1.0
 * @param  string $title Default title.
 * @return string Title without prefix
 */
function air_helper_helper_remove_archive_title_prefix( $title ) {
    return preg_replace( '/^\w+: /', '', $title );
}
add_filter( 'get_the_archive_title', 'air_helper_helper_remove_archive_title_prefix' );

/**
 * Disable emojicons introduced with WP 4.2.
 * Turn off by using `remove_action( 'init', 'air_helper_helper_disable_wp_emojicons' )`
 *
 * @since  0.1.0
 * @link http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
 */
function air_helper_helper_disable_wp_emojicons() {
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    add_filter( 'emoji_svg_url', '__return_false' );
    // Disable classic smilies.
    add_filter( 'option_use_smilies', '__return_false' );
    add_filter( 'tiny_mce_plugins', 'air_helper_helper_disable_emojicons_tinymce' );
}
add_action( 'init', 'air_helper_helper_disable_wp_emojicons' );
/**
 * Disable emojicons introduced with WP 4.2.
 *
 * @since 0.1.0
 * @param array $plugins Plugins.
 */
function air_helper_helper_disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

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
