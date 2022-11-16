<?php
	session_start();
	include_once("class/language.php");
	include_once("config.php");
	include_once("class/function.php");
	include_once("inc/header.php");

?>

<body id="page-top">
	
    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
				
                    <!-- Page Heading -->
					
					<h1 class="h3 mb-4 text-gray-800"><a href="https://www.deliboy.com.my"><img src="https://www.deliboy.com.my/wp-content/uploads/2020/03/LOGO-202003-COLOR-Transparent-2048x910.png" class="img-responsive" style="width: 150px;" alt="logo"></a></h1>
                    <?php include_once("module/calculator/index.php"); ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once("inc/footer_copyright.php"); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>
<script>
(function($) {
  "use strict"; // Start of use strict

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
