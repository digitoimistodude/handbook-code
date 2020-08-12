/**
 * handbook theme JavaScript.
 */

// Initiate Swup transitions
const swup = new Swup({
  linkSelector:
    'a[href^="' +
    window.location.origin +
    '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup])',
  animationSelector: '[class*="swup-transition-"]',
  plugins: [
    new SwupScriptsPlugin({
      head: true,
      body: true,
      optin: true,
    }),
    new SwupBodyClassPlugin(),
  ],
});

// Swup starts
swup.on("contentReplaced", function () {
  // Always move scroll position to up when clicking a link
  var moveToSwup = new MoveTo({
    tolerance: 0,
    duration: 0,
    easing: "easeOutQuart",
    container: window,
  });

  var target = document.getElementById("swup");
  moveToSwup.move(target);

  // jQuery start
  (function ($) {
    // Document ready start
    $(function () {
      // Fitvids
      $(
        ".entry-content, .entry-content p, .entry-content iframe, .slide-single-article, .slide-single-article .post"
      ).fitVids();

      // Toggle onclick git commit history
      $(".git-commit-history-toggle").click(function () {
        $(".commits").slideToggle("slow");
      });

      // Init nav opened status
      navOpened = false;

      // Minimal navigation
      $(".nav-toggle").click(function () {
        // Toggle boolean
        navOpened ^= true;

        $(".side-nav-main").toggleClass("is-active");
        $("body").toggleClass("js-nav-active");

        // Change text to closed and vice versa
        var toggletext = $(this).find(".toggle-text").text();
        if (toggletext == "Avaa valikko") {
          $(this).find(".toggle-text").text("Sulje valikko");
        } else {
          $(this).find(".toggle-text").text("Avaa valikko");
        }
      });

      firstFocusableElement = document.getElementById("nav-toggle");
      lastFocusableElement = document
        .getElementsByClassName("page-item-292")[0]
        .getElementsByTagName("a")[0];

      // Redirect last Tab to first focusable element.
      lastFocusableElement.addEventListener("keydown", function (e) {
        if (e.keyCode === 9 && !e.shiftKey) {
          if (navOpened === 1) {
            e.preventDefault();

            firstFocusableElement.focus(); // Set focus on first element - that's actually close menu button.
          }
        }
      });

      // Redirect first Shift+Tab to toggle button element.
      firstFocusableElement.addEventListener("keydown", function (e) {
        if (e.keyCode === 9 && e.shiftKey) {
          if (navOpened === 1) {
            e.preventDefault();
            lastFocusableElement.focus(); // Set focus on last element.
          }
        }
      });

      // Close menu using Esc key.
      document.addEventListener("keyup", function (event) {
        if (event.keyCode == 27) {
          navOpened = 0;

          var toggletext = $(this).find(".toggle-text").text();
          if (toggletext == "Avaa valikko") {
            $(this).find(".toggle-text").text("Sulje valikko");
          } else {
            $(this).find(".toggle-text").text("Avaa valikko");
          }

          $(".side-nav-main").removeClass("is-active");
          $("body").removeClass("js-nav-active");
        }
      });
    });
  })(jQuery);
});
// Swup ends

// jQuery start
(function ($) {
  // Document ready start
  $(function () {
    // Fitvids
    $(
      ".entry-content, .entry-content p, .entry-content iframe, .slide-single-article, .slide-single-article .post"
    ).fitVids();

    // Toggle onclick git commit history
    $(".git-commit-history-toggle").on("click", function () {
      $(".commits").slideToggle("slow");
    });

    // Init nav opened status
    navOpened = false;

    // Minimal navigation
    $(".nav-toggle").on("click", function () {
      // Toggle boolean
      //navOpened ^= true;

      $(".side-nav-main").toggleClass("is-active");
      $("body").toggleClass("js-nav-active");

      // Change text to closed and vice versa
      var toggletext = $(this).find(".toggle-text").text();
      if (toggletext == "Avaa valikko") {
        $(this).find(".toggle-text").text("Sulje valikko");
      } else {
        $(this).find(".toggle-text").text("Avaa valikko");
      }
    });

    firstFocusableElement = document.getElementById("nav-toggle");
    lastFocusableElement = document
      .getElementsByClassName("page-item-292")[0]
      .getElementsByTagName("a")[0];

    // Redirect last Tab to first focusable element.
    lastFocusableElement.addEventListener("keydown", function (e) {
      if (e.keyCode === 9 && !e.shiftKey) {
        if (navOpened === 1) {
          e.preventDefault();

          firstFocusableElement.focus(); // Set focus on first element - that's actually close menu button.
        }
      }
    });

    // Redirect first Shift+Tab to toggle button element.
    firstFocusableElement.addEventListener("keydown", function (e) {
      if (e.keyCode === 9 && e.shiftKey) {
        if (navOpened === 1) {
          e.preventDefault();
          lastFocusableElement.focus(); // Set focus on last element.
        }
      }
    });

    // Close menu using Esc key.
    document.addEventListener("keyup", function (event) {
      if (event.keyCode == 27) {
        navOpened = 0;

        var toggletext = $(this).find(".toggle-text").text();
        if (toggletext == "Avaa valikko") {
          $(this).find(".toggle-text").text("Sulje valikko");
        } else {
          $(this).find(".toggle-text").text("Avaa valikko");
        }

        $(".side-nav-main").removeClass("is-active");
        $("body").removeClass("js-nav-active");
      }
    });
  });
})(jQuery);
