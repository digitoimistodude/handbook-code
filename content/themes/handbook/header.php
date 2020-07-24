<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package handbook
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicons/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicons/manifest.json">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="site">
   <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'handbook' ); ?></a>

   <div id="content" class="site-content">

    <aside class="side-nav">
      <nav id="nav" class="nav-collapse">

        <header class="site-header">
          <div class="site-branding">
            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/logo.svg' ) ) ); ?> <span class="handbook"><?php echo esc_html_e( 'Handbook', 'handbook' ); ?></span></a></h1>
          <?php else : ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/logo.svg' ) ) ); ?> <span class="handbook"><?php echo esc_html_e( 'Handbook', 'handbook' ); ?></span></a></p>
          <?php endif; ?>
          <h3 class="handbook-title"><?php echo $description; /* WPCS: xss ok. */ ?></h3>
        </div><!-- .site-branding -->

        <?php echo get_search_form(); ?>
      </header>

      <button id="nav-toggle" class="nav-toggle hamburger firstfocusableitem">
        <span class="hamburger-box" aria-hidden="true"><span class="hamburger-inner" aria-hidden="true"></span></span>
        <span id="nav-toggle-label" class="toggle-text"><?php esc_attr_e( 'Avaa valikko', 'handbook' ); ?></span>
      </button>

      <h3 class="side-nav-title"><?php echo esc_html_e( 'Sisällysluettelo', 'handbook' ); ?></h3>

      <ol class="side-nav-main">
      <?php
      wp_list_pages( array(
        'title_li'    => '',
        'depth'       => 2,
        'sort_column' => 'menu_order',
        'walker'      => new handbook_walker(),
        ) ); ?>
      </ol>
      </nav><!-- #site-navigation -->
    </aside>
