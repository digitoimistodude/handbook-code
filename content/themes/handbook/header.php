<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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

   <header class="site-header">

    <div class="site-branding">
      <?php 
      $description = get_bloginfo( 'description', 'display' ); 
      if ( is_front_page() && is_home() ) : ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/logo.svg' ) ) ); ?></a></h1>
      <?php else : ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/logo.svg' ) ) ); ?></a></p>
      <?php endif; ?>
    <h3 class="handbook-title"><?php echo $description; /* WPCS: xss ok. */ ?></h3>
  </div><!-- .site-branding -->

  <?php echo get_search_form(); ?>

</header>

<div id="content" class="site-content">

  <aside class="side-nav">
    <nav id="nav" class="nav-collapse">

      <?php wp_nav_menu( array(
        'theme_location'    => 'primary',
        'container'         => false,
        'depth'             => 4,
        'menu_class'        => 'menu-items',
        'menu_id'           => 'menu',
        'echo'              => true,
        'fallback_cb'       => 'wp_page_menu',
        'items_wrap'        => '<ul class="%2$s" id="%1$s">%3$s</ul>',
        'walker'            => new handbook_Walker(),
        ) ); ?>

    </nav><!-- #site-navigation -->
  </aside>
