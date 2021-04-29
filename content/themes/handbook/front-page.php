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

    <div class="container">
    <article class="page type-page status-publish hentry">
    <?php if ( have_posts() ) {
     while ( have_posts() ) {
       the_post();
       the_content();
     }
   } else {
     get_template_part( 'template-parts/content', 'none' );
   } ?>

    <?php if ( get_edit_post_link() ) {
      edit_post_link( sprintf( wp_kses( __( 'Muokkaa <span class="screen-reader-text">%s</span>', 'handbook' ), [ 'span' => [ 'class' => [] ] ] ), get_the_title() ), '<p class="edit-link">', '</p>' );
    } ?>

   </article>
   </div>

 </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
