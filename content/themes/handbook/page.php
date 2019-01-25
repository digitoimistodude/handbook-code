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

    <div class="container">
      <?php while ( have_posts() ) {
      	the_post();

				$git_commit_info = handbook_get_git_commit_info( get_the_id() );
				$git_commit_history = handbook_get_git_commit_history( get_the_id() ); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				  <header class="entry-header">
				    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				  </header><!-- .entry-header -->

				  <div class="entry-content">
				    <?php the_content();

				      wp_link_pages( array(
				        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'handbook' ),
				        'after'  => '</div>',
				      ) );
				    ?>
				  </div><!-- .entry-content -->

				  <p><?php edit_post_link(); ?></p>

				  <?php if ( ! empty( $git_commit_info ) ) : ?>
				  	<p class="modified">Viimeksi muokattu käyttäjän <?php echo $git_commit_info->commit->committer->name ?> toimesta viestillä "<?php echo $git_commit_info->commit->message ?>", <a href="<?php echo $git_commit_info->html_url ?>">katso muutos <?php echo str_split( $git_commit_info->sha, 7 )[0] ?> GitHubissa</a>.</p>
				  <?php endif;

				  if ( ! empty( $git_commit_history ) ) : ?>
				  	<div class="git-commit-history">
				  		<h2>Versiohistoria</h2>

				  		<div class="commits">
				  			<?php foreach ( $git_commit_history as $git_commit ) : ?>
				  				<p class="commit"><span class="date"><?php echo date_i18n( 'j.n.Y H:i:s', strtotime( $git_commit['committer']->date ) ); ?></span> Muokattu käyttäjän <?php echo $git_commit['committer']->name ?> toimesta viestillä "<?php echo $git_commit['message'] ?>", <a href="<?php echo $git_commit['html_url'] ?>">katso muutos <?php echo str_split( $git_commit['sha'], 7 )[0] ?> GitHubissa</a>.</p>
				  			<?php endforeach; ?>
				  		</div>
				  	</div>
				  <?php endif; ?>

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
