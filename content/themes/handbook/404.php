<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package handbook
 */

get_header();

get_template_part( 'template-parts/hero', get_post_type() ); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'handbook' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'handbook' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

			<?php wp_footer(); get_footer(); ?>

		</div><!-- .container -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php wp_footer(); ?>

</body>
</html>
