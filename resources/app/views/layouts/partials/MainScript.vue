<!-- eslint-disable no-undef -->
<script>
export default {
  main() {
    $(function () {
      "use strict";

      var scrollButton = $("#scroll-top");
      // sticky menu
      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 60) {
          $(".main-navbar").addClass("fixed-top").animate(
            {
              top: 0,
            },
            4000
          );
        } else {
          $(".main-navbar").removeClass("fixed-top").animate(
            {
              top: 0,
            },
            4000
          );
        }
        // scroll top
        if ($(this).scrollTop() >= 700) {
          scrollButton.fadeIn(1000);
        } else {
          scrollButton.fadeOut(1000);
        }
      });
      scrollButton.on("click", function () {
        $("html,body").animate(
          {
            scrollTop: 0,
          },
          600
        );
      });

      // slide up any dropdown on document click
      $(document).on("click touchstart", function (e) {
        e.stopPropagation();
        var dropTarg = $(e.target).closest(".main-header .dropdown").length;
        if (!dropTarg) {
          $(".main-header .dropdown").removeClass("show");
        }
        if (window.matchMedia("(min-width: 992px)").matches) {
          if (!$(".main-navbar").hasClass("side-menu")) {
            var navTarg = $(e.target).closest(".main-navbar .nav-item").length;
            if (!navTarg) {
              $(".main-navbar .show").removeClass("show");
            }
          }

          var menuTarg = $(e.target).closest(
            ".main-header-menu .nav-item"
          ).length;
          if (!menuTarg) {
            $(".main-header-menu .show").removeClass("show");
          }
          if ($(e.target).hasClass("main-menu-sub-mega")) {
            $(".main-header-menu .show").removeClass("show");
          }
        }
        var sidebarTarg = $(e.target).closest(".sidebar").length;
        if (
          $(e.target).is(
            ".main-header .header-settings a , .main-header .header-settings svg, .sidebar"
          ) === false &&
          !sidebarTarg
        ) {
          if ($(".sidebar").hasClass("sidebar-open")) {
            console.log(e.target);
            $(".sidebar.sidebar-open").removeClass("sidebar-open");
          }
        }
        let sideSetting = $(".sideSetting");
        if (
          !sideSetting.is(e.target) &&
          sideSetting.has(e.target).length === 0
        ) {
          sideSetting.removeClass("sidebar-open");
        }
      });

      if (window.matchMedia("(min-width: 992px)").matches) {
        $(".main-navbar .active").removeClass("show");
        $(".main-header-menu .active").removeClass("show");
      }

      // toggle header dropdown

      $(".main-header .dropdown > a").on("click", function (e) {
        e.preventDefault();
        $(this).parent().toggleClass("show");
        $(this).parent().siblings().removeClass("show");
      });

      // Full screen
      $(document).on(
        "click",
        ".fullscreen-button",
        function toggleFullScreen() {
          $("html").addClass("fullscreenie");
          if (
            (document.fullScreenElement !== undefined &&
              document.fullScreenElement === null) ||
            (document.msFullscreenElement !== undefined &&
              document.msFullscreenElement === null) ||
            (document.mozFullScreen !== undefined && !document.mozFullScreen) ||
            (document.webkitIsFullScreen !== undefined &&
              !document.webkitIsFullScreen)
          ) {
            if (document.documentElement.requestFullScreen) {
              document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
              document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
              document.documentElement.webkitRequestFullScreen(
                Element.ALLOW_KEYBOARD_INPUT
              );
            } else if (document.documentElement.msRequestFullscreen) {
              document.documentElement.msRequestFullscreen();
            }
          } else {
            $("html").removeClass("fullscreenie");
            if (document.cancelFullScreen) {
              document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
              document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
              document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
              document.msExitFullscreen();
            }
          }
        }
      );

      // submenu
      $(".main-navbar .subMenu").on("click", function (e) {
        e.preventDefault();
        $(this).parent().toggleClass("show");
        $(this).parent().siblings().removeClass("show");
      });

      //toggle side menu navbar
      $("#mainNavShow").on("click", function (e) {
        e.preventDefault();
        if ($(this).closest(".with-side-menu").length == 1) {
          if ($(window).innerWidth() <= "991.98") {
            $("body").addClass("main-navbar-show");
          } else if ($("body").hasClass("main-sidebar-hide")) {
            $("body").removeClass("main-sidebar-hide");
            $("body").addClass("opened-sidebar-form-hide");
            $(
              ".opened-sidebar-form-hide .main-sidebar-body .nav-item.show>.nav-sub"
            ).show();
          } else {
            $("body").addClass("main-sidebar-hide");
            $("body").removeClass("opened-sidebar-form-hide");
            $(
              ".main-sidebar-hide .main-sidebar-body .nav-item.show>.nav-sub"
            ).hide();
          }
        } else $("body").addClass("main-navbar-show");
      });
      $("#azNavbarShow").on("click", function (e) {
        e.preventDefault();
        $("body").addClass("main-navbar-show");
      });
      $("body").append('<div class="main-navbar-backdrop"></div>');
      $(".main-navbar-backdrop").on("click touchstart", function () {
        $("body").removeClass("main-navbar-show");
      });
      //side-menu

      // sidebar
      $(".main-header .header-settings a , .sidebar-icon").on(
        "click",
        function (e) {
          e.preventDefault();
          $(".sidebar").toggleClass("sidebar-open");
          e.stopPropagation();
        }
      );

      // side settings
      $(".sideSetting .cog-icon").on("click", function () {
        $(".sideSetting").toggleClass("sidebar-open");
      });

      // switch between menu style
      $(".menu-mode a").click(function () {
        if ($(this).hasClass("hor-menu")) {
          $(".main-body").removeClass("main-sidebar-hide");
          $(".main-header").removeClass("with-side-menu");
          $(".main-navbar").removeClass("side-menu main-sidebar-sticky");
          $(".main-content").removeClass("side-content");
        } else if ($(this).hasClass("vertical-menu")) {
          $(".main-header").addClass("with-side-menu");
          $(".main-navbar").addClass("side-menu main-sidebar-sticky");
          $(".main-content").addClass("side-content");
          $(".side-menu").unbind("hover");
        }
      });
      // switch between theme color mode

      const toggleDark = document.querySelector(".toggle-dark");
      const togglelight = document.querySelector(".toggle-light");

      function switchTheme(e) {
        if (
          e.target.checked &&
          e.target.className == "form-check-input toggle-dark"
        ) {
          localStorage.setItem("themeMode", "dark");
          document.documentElement.setAttribute("data-theme", "dark");
        } else {
          localStorage.setItem("themeMode", "light");
          document.documentElement.setAttribute("data-theme", "light");
        }
      }

      if (toggleDark) {
        toggleDark.addEventListener("change", switchTheme);
        togglelight.addEventListener("change", switchTheme);
      }

      // colored header
      $("#coloredHeader").on("click", function () {
        if ($(this).is(":checked")) {
          localStorage.setItem("headerMenuStyle", "coloredHeader");
          $("body").addClass("color-header");
          $("body").removeClass("gradient-header");
          $(".main-header").removeClass("bg-gradient-primary");
          $("body").removeClass("color-horizontal");
          $("body").removeClass("dark-horizontal");
          $("body").removeClass("gradient-horizontal");
          $(".main-navbar").removeClass("bg-gradient-primary");
        }
      });

      // gradient header
      $("#gradientHeader").on("click", function () {
        if ($(this).is(":checked")) {
          localStorage.setItem("headerMenuStyle", "gradientHeader");
          $("body").addClass("gradient-header");
          $(".main-header").addClass("bg-gradient-primary");
          $("body").removeClass("color-header");
          $("body").removeClass("color-horizontal");
          $("body").removeClass("dark-horizontal");
          $("body").removeClass("gradient-horizontal");
          $(".main-navbar").removeClass("bg-gradient-primary");
        }
      });

      // colored menu
      $("#coloredMenu").on("click", function () {
        localStorage.setItem("headerMenuStyle", "coloredMenu");
        if ($(this).is(":checked")) {
          $("body").addClass("color-horizontal");
          $("body").removeClass("color-header");
          $("body").removeClass("gradient-header");
          $(".main-header").removeClass("bg-gradient-primary");
          $("body").removeClass("dark-horizontal");
          $("body").removeClass("gradient-horizontal");
          $(".main-navbar").removeClass("bg-gradient-primary");
        }
      });

      // dark menu
      $("#darkMenu").on("click", function () {
        if ($(this).is(":checked")) {
          localStorage.setItem("headerMenuStyle", "darkMenu");
          $("body").addClass("dark-horizontal");
          $("body").removeClass("color-header");
          $("body").removeClass("gradient-header");
          $(".main-header").removeClass("bg-gradient-primary");
          $("body").removeClass("color-horizontal");
          $("body").removeClass("gradient-horizontal");
          $(".main-navbar").removeClass("bg-gradient-primary");
        }
      });

      // gradient menu
      $("#gradientMenu").on("click", function () {
        if ($(this).is(":checked")) {
          localStorage.setItem("headerMenuStyle", "gradientMenu");
          $("body").addClass("gradient-horizontal");
          $(".main-navbar").addClass("bg-gradient-primary");
          $("body").removeClass("color-header");
          $("body").removeClass("gradient-header");
          $(".main-header").removeClass("bg-gradient-primary");
          $("body").removeClass("color-horizontal");
          $("body").removeClass("dark-horizontal");
        }
      });

      // reset header
      $("#resetAll").on("click", function () {
        if ($(this).is(":checked")) {
          localStorage.setItem("headerMenuStyle", "resetAll");
          $("body").removeClass("color-header");
          $("body").removeClass("gradient-header");
          $(".main-header").removeClass("bg-gradient-primary");
          $("body").removeClass("color-horizontal");
          $("body").removeClass("dark-horizontal");
          $("body").removeClass("gradient-horizontal");
          $(".main-navbar").removeClass("bg-gradient-primary");
        }
      });

      //tooltip
      // $('[data-bs-toggle="tooltip"]').tooltip({
      //   trigger: "hover",
      // });
      $('[data-bs-toggle="tooltip"]').on("click", function () {
        $(this).tooltip("hide");
      });
    });
  },
};
</script>
