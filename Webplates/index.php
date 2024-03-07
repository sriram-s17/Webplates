<?php
	session_start();
	include("includes/connection.php");
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
	<link rel="stylesheet" type="text/css" href="assets/css/webplates-style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/gijgo.min.css">
	
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<script src="assets/js/gijgo.min.js"></script>
	<script src="assets/js/app.js"></script>
  	
	<?php
		$headerfile="user_index.php";	//for reloading that page after login or signup
		include("includes/signup-login.php"); 
		
		if(isset($_GET["error"])&&$_GET["error"]==1){ showmodal("loginmodal"); }
	?>
</head>

<body class="bg-light font">

	<!-- Navbar -->
	<nav class="navbar navbar-fixed fixed-top navbar-expand-md navbar-dark bg-dark mb-auto rounded-1">
		<div class="container">
			<span class="navbar-brand" style="font-size:30px;">web plates</span>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenavbar" aria-controls="collapsenavbar" aria-expanded="false" aria-label="Roggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="collapsenavbar">
				<ul class="navbar-nav mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="templates.php?page=1">Templates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact us</a>
					</li>
					<li class="nav-item dropdown">
						<span class="nav-link dropdown-toggle" id="userdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img class="rounded-circle" src="assets/images/user.jpg" width="24" alt="Admin">
						</span>
						<ul class="dropdown-menu" aria-labelledby="userdropdown">
							<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign up</button></li>
							<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar ends -->

	<!-- 1st container -->
	<div class="px-4 pt-5 my-5 text-center border-bottom">
		<img class="d-block mx-auto mb-4" src="assets/images/logo.png" alt="">
		<h1 class="display-4 fw-bold">Welcome to my page</h1>
		<div class="col-lg-6 mx-auto">
			<p class="lead mb-4">I am a platform for website Templates. so my name is web plates. I provide these templates with free cost.</p>
			<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
				<a class="btn btn-outline-secondary btn-lg px-4" href="templates.php">Explore templates here ! !</a>
			</div>
		</div>
		<div class="overflow-hidden" style="max-height:30vh;">
			<div class="container px-5">
				<img src="assets/images/webplates-templates.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="templates site" width="700" height="500" loading="lazy">
			</div>
		</div>
	</div>
	<!-- end of 1st container -->

	<!-- 2nd container -->
    <div class="container my-5">
		<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
			<div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
				<h1 class="display-4 fw-bold lh-1">Sign up and Add Your Template</h1>
				<li class="lead">Sign up with me</li>
				<li class="lead">upload your template as zip file</li>
				<p class="lead">Publish it to the world</p>
				<div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
					<button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign up</button>
					<button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#loginmodal">Log in</button>
				</div>
			</div>
			<div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
				<img class="rounded-lg-3" src="assets/images/add-template.png" alt="template editor" width="720">
			</div>
		</div>
	</div>
	<?php include("includes/signup-login-modal.php"); ?>
	
	<!-- Footer Section Begin -->
	<div class="bg-dark text-white">
        <div class="container border-top p-5">
            <div class="row">
                <div class="col-6">
					<a href="./index.html"><img src="assets/images/logo-white.png" alt="" width="120"></a>
					<p class="mt-3">“Imagination is the beginning of creation. You imagine what you desire, you will what you imagine, and at last, you create what you will.”  — <span class="text-success">George Bernard Shaw</span></p>
                </div>
                <div class="col-6 text-end">
					<ul class='list-unstyled'>
						<li>
							<span>Call Us:</span>
							<a class='text-decoration-none d-block font1' href='callto:+919894905162'>(+91) 989490 5162</a>
						</li>
						<li>
							<span>Email:</span>
							<a class='text-decoration-none d-block font1' href='mailto:sriramsu192012@gmail.com'>sriramsu192012@gmail.com</a>
						</li>
					</ul>
                </div>
            </div>
            <div class="row">
				<div class="col-12 text-end">
					<a class='text-decoration-none' href="contact.php">Mail Us</a>
                </div>
            </div>
        </div>
	</div>
    <!-- Footer Section End -->
	
</body>
</html>