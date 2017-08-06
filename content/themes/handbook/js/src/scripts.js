/**
 * handbook theme JavaScript.
 */

( function( $ ) {
  $(function() {

    // Fitvids
    $('.entry-content, .entry-content p, .entry-content iframe, .slide-single-article, .slide-single-article .post').fitVids();

    if (window.innerWidth > 600) {
      $('.side-nav').css( { 'height': ($('.content-area').outerHeight() + 'px' ) });
    }

  });
} )( jQuery );
