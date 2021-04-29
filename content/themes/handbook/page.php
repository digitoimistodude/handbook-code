<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package handbook
 */

get_header();

get_template_part( 'template-parts/hero', get_post_type() ); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

    <div class="container swup-transition-fade">
      <?php while ( have_posts() ) {
      	the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <?php the_title( '<h1 class="entry-title" id="content">', '</h1>' ); ?>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <?php the_content();

            wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'handbook' ),
              'after'  => '</div>',
            ) );
            ?>
          </div><!-- .entry-content -->

          <?php if ( get_edit_post_link() ) {
            edit_post_link( sprintf( wp_kses( __( 'Muokkaa <span class="screen-reader-text">%s</span>', 'handbook' ), [ 'span' => [ 'class' => [] ] ] ), get_the_title() ), '<p class="edit-link">', '</p>' );
          } ?>

    </article><!-- #post-## -->

				<?php // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				get_footer();
      } ?>
    </div><!-- .container -->

  </main><!-- #main -->
</div><!-- #primary -->

<?php wp_footer(); ?>

</body>
</html>
