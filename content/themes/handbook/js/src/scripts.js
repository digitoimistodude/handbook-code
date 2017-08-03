/**
 * handbook theme JavaScript.
 */

( function( $ ) {
  $(function() {

    if (window.innerWidth > 600) {
      $('.side-nav').css( { 'height': ($('.content-area').outerHeight() + 'px' ) });
    }

  });
} )( jQuery );
