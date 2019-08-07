/**
 * handbook theme JavaScript.
 */

 ( function( $ ) {
  $(function() {

    // Fitvids
    $('.entry-content, .entry-content p, .entry-content iframe, .slide-single-article, .slide-single-article .post').fitVids();

  });

  // Toggle onclick git commit history
  $(document).ready(function() {
    $(".git-commit-history-toggle").click(function() {
      $(".commits").slideToggle("slow");
    });
  });

} )( jQuery );
