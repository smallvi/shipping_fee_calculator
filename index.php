<?php
session_start();
define("ABSPATH", __DIR__);
include_once(ABSPATH . "/class/language.php");
include_once(ABSPATH . "/config.php");
include_once(ABSPATH . "/class/function.php");
include_once(ABSPATH . "/inc/header.php");
?>

<body id="page-top">
  <div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <div class="container-fluid">
          <a href="<?= $site["url"]; ?>"><img src="<?= $site["logo"]; ?>" class="img-responsive" style="width: 150px;" alt="logo"></a>
          <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            ⚠️<strong><?=$language[$locale]["ALERT_SHIPPING_FEE_CALCULATOR_ESTIMATE_PURPOSE"] ;?></strong>
            <br><small><?=$language[$locale]["ALERT_SHIPPING_FEE_CALCULATOR_FINAL_DATA_BASED_ON_OUR_HUBCN"];?></small>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <?php include_once("module/calculator/index.php"); ?>
        </div>
      </div>
      <?php include_once("inc/footer_copyright.php"); ?>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</body>
<script>
  (function($) {
    "use strict";

    // Scroll to top button appear
    $(document).on('scroll', function() {
      var scrollDistance = $(this).scrollTop();
      if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
      var $anchor = $(this);
      $('html, body').stop().animate({
        scrollTop: ($($anchor.attr('href')).offset().top)
      }, 1000, 'easeInOutExpo');
      e.preventDefault();
    });

  })(jQuery); // End of use strict
</script>

</html>