<?php
/**
 * The template for displaying front page
 *
 * Contains the closing of the #content div and all content after.
 * Initial styles for front page template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package handbook2019
 */

// Featured image.
$featured_image = '';
if ( has_post_thumbnail() ) :
	$featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
else :
	$featured_image = get_theme_file_uri( 'images/default.jpg' );
endif;

get_header();
?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">

    <section class="block block-front-hero">
      <div class="container">
        <h1>Dude Handbook</h1>
        <h2>Virallinen operointimanuaali</h2>
      </div>
    </section>

    <div class="block">
      <div class="container">

        <?php if ( have_posts() ) {
        	while ( have_posts() ) {
	      		the_post();
	      		the_content();
					}
        } else {
        	get_template_part( 'template-parts/content', 'none' );
        }  ?>

      </div>
    </div>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();