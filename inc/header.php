<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo APP_NAME . " - " . $language[$locale]["TITLE_SHIPPING_FEE_CALCULATOR"] ; ?></title>
	<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
	

	
	<!-- Loading Gif -->
	<style>
	#content-wrapper {
		display:none;
	}

	.preload { 
		
		display: block;
		margin-left: auto;
		margin-right: auto;
		width:100%;
		height: 100%;
		position: fixed;
		z-index: 9999;
		background: url('img/loading.gif') 50% 50% no-repeat rgba(0,0,0,.5);

	}
	</style>
	<script>
	$(function() {
    $(".preload").fadeOut(1000, function() {
			$("#content-wrapper").fadeIn(1000);        
		});
	});
	</script>
	
</head>