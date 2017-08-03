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

	<footer id="colophon" class="site-footer">
    <p><a href="https://www.dude.fi"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/neckbeard.svg' ) ) ); ?></a> Tämä Handbook kertoo kuinka me teemme asioita Dudella. Handbook on ensisijaisesti tarkoitettu dudekselle, mutta siitä voi ottaa totta kai koppia myös omaan toimintaan. Emme takaa että kaikki meidän jutut toimivat muilla samalla tavalla. Ole mitä olet!</p>
	</footer>

</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
