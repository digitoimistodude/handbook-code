<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package handbook
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'handbook' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'handbook' ), 'WordPress' ); ?></a>
			<span class="theme-info"><?php printf( esc_html__( 'Lightweight like %1$s itself. You are using version %2$s', 'handbook' ), '<i>handbook</i>', esc_attr( AIR_VERSION ) ); ?> &mdash; <a href="https://github.com/digitoimistodude/air"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/github.svg' ) ) ); ?> GitHub</a></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<a href="#page" class="js-trigger top" data-mt-duration="300"><span class="screen-reader-text"><?php echo esc_html_e('Back to top', 'handbook'); ?></span><?php echo file_get_contents( get_theme_file_path( '/svg/chevron-up.svg' ) ); ?></a>

</body>
</html>
