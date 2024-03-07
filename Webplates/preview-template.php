<?php
	session_start();
	include("includes/connection.php");
	if(!isset($_GET["tempid"])){
		header("location:templates.php");
	}
	$slt_query = "SELECT homepage FROM templates WHERE id = ".$_GET["tempid"];
	$slt_result = mysqli_query($connect,$slt_query);
	if($slt_result){
		$row = mysqli_fetch_assoc($slt_result);
		$homepage = $row["homepage"];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" type="image/png" href="assets/images/logo.png">
	<title>Web Plates - Home</title>

	<!--including stylesheets and javascripts -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fontawesome-5.15.4/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/webplates-style.css">
	
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<script src="assets/js/app.js"></script>
	
	<style>
		.nav-link{
			cursor:pointer;
		}
		iframe {
		  height: 700px;
		  width: 1024px;
		}
		@media only screen and (max-width:992px){
			#desktop{
				display:none;
			}
			iframe {
			  height: 1024px;
			  width: 768px;
			}
		}
		@media only screen and (max-width:768px) {
			#desktop{
				display:none;
			}
			#largetablet{
				display:none;
			}
			iframe {
			  height: 962px;
			  width: 601px;
			}
		}
		@media only screen and (max-width:576px) {
			#desktop{
				display:none;
			}
			#largetablet{
				display:none;
			}
			#tablet{
				display:none;
			}
			iframe {
				height:640px;
				width:360px;
			}
		}
	</style>
	
</head>

<body class="bg-light">

	<!-- Navbar -->
	<nav class="font navbar navbar-expand-md navbar-dark bg-dark mb-auto rounded-1">
		<div class="container">
			<span class="navbar-brand" style="font-size:30px;">web plates</span>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenavbar" aria-controls="collapsenavbar" aria-expanded="false" aria-label="Roggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="collapsenavbar">
				<ul class="navbar-nav mb-2 mb-md-0 lead">
					<li class="nav-item me-5" id="desktop">
						<span class="fas fa-desktop nav-link" onclick="changeres('desktop');"> <span class="font">Desktop</span></span>
					</li>
					<li class="nav-item me-5" id="largetablet">
						<span class="fas fa-tablet-alt nav-link" onclick="changeres('largetablet');"> <span class="font">Large Tablet</span></span>
					</li>
					<li class="nav-item me-5" id="tablet">
						<span class="fas fa-tablet nav-link" onclick="changeres('tablet');"> <span class="font">Tablet</span></span>
					</li>
					<li class="nav-item me-5" id="mobile">
						<span class="fas fa-mobile-alt nav-link" onclick="changeres('mobile');"> <span class="font">Mobile</span></span>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar ends -->

	<!-- 1st container -->
    <div class="col-12 my-md-4">
		<iframe src="<?php echo $homepage; ?>" class="d-block mx-auto border border-5"></iframe>
	</div>
	
	<script>
		screen_resize();
		function screen_resize() {
			var w = parseInt(window.innerWidth);
			
			if(w > 992 ) {
				$("#desktop .nav-link").addClass("active");
			} else if(w >768) {
				$("#largetablet .nav-link").addClass("active");
			} else if(w >576){
				$("#tablet .nav-link").addClass("active");
			} else if(w <=576){
				$("#mobile .nav-link").addClass("active");
			}

		}
		function changeres(screen){
			var iframe = $("iframe");
			switch(screen){
				case "desktop":
				iframe.width(1024);
				iframe.height(700);break;
				case "largetablet":
				iframe.width(768);
				iframe.height(1024);break;
				case "tablet":
				iframe.width(601);
				iframe.height(962);break;
				case "mobile":
				iframe.width(360);
				iframe.height(640);break;
			}
			$(".navbar-nav").find(".nav-link").removeClass("active");
			$("#"+screen+" .nav-link").addClass("active");
		}
	</script>
	
</body>

</html>