<?php
/**
 * The template for displaying front page
 *
 * Contains the closing of the #content div and all content after.
 * Initial styles for front page template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package handbook
 */
get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

    <div class="slide slide-front-content">

      <div class="container">

        <?php if ( have_posts() ) {
        	while ( have_posts() ) {
	      		the_post();
	      		the_content();
					}
        } else {
        	get_template_part( 'template-parts/content', 'none' );
        }  ?>

      </div><!-- .container -->

    </div><!-- .slide.slide-front-content -->

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
