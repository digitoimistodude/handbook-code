/**
 * handbook theme JavaScript.
 */

(function ($) {
  $(function () {
    // Fitvids
    $(
      ".entry-content, .entry-content p, .entry-content iframe, .slide-single-article, .slide-single-article .post"
    ).fitVids();
  });

  // Document ready
  $(document).ready(function () {
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
