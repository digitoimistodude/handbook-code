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

    <p class="edit-link"><?php edit_post_link(); ?></p>

    <?php if ( ! empty( $git_commit_info ) ) : ?><p class="modified">Viimeksi muokattu käyttäjän <?php echo $git_commit_info->commit->committer->name ?> toimesta viestillä "<?php echo $git_commit_info->commit->message ?>", <a class="no-text-link" href="<?php echo $git_commit_info->html_url ?>">katso muutos <?php echo str_split( $git_commit_info->sha, 7 )[0] ?> GitHubissa</a>.</p><?php endif; ?>

   <?php wp_footer(); get_footer(); ?>
   </article>
   </div>

 </main><!-- #main -->
</div><!-- #primary -->

<?php wp_footer(); ?>

</body>
</html>
