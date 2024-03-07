<?php
	session_start();
	$sts="";
	include("includes/contact.php");
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
	
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/gijgo.min.js"></script>
	<script src="assets/js/app.js"></script>
  	
	<?php
		$headerfile="contact.php";	//for reloading that page after login or signup
		include("includes/signup-login.php"); 
	?>
</head>

<body class="bg-light font">

	<!-- Navbar -->
	<nav class="font navbar navbar-fixed fixed-top navbar-expand-md navbar-dark bg-dark mb-auto rounded-1">
		<div class="container">
			<span class="navbar-brand" style="font-size:30px;">web plates</span>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsupportedcontent" aria-controls="navbarsupportedcontent" aria-expanded="false" aria-label="Roggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="navbarsupportedcontent">
				<ul class="navbar-nav mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link" href="<?php if(isset($_SESSION["wpusrid"])){ echo "user_index.php"; } else { echo "index.php"; } ?>">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="templates.php?page=<?php echo $page; ?>">Templates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="contact.php">Contact us</a>
					</li>
					<li class="nav-item dropdown">
						<span class="nav-link dropdown-toggle" id="userdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img class="rounded-circle" src="<?php if(isset($_SESSION["wpusrid"])){ echo $_SESSION["wpusrpht"]; } else { echo "assets/images/user.jpg"; } ?>" width="24" alt="Admin"> 
							<?php if(isset($_SESSION["wpusrid"])){ echo $_SESSION["wpusrname"]; }else { echo "User"; } ?>
						</span>
						<ul class="dropdown-menu" aria-labelledby="userdropdown">
							<?php
								if(!isset($_SESSION["wpusrid"])){
							?>
							<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign up</button></li>
							<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button></li>
							<?php
								}
								else{
							?>
							<li><a class="dropdown-item" href="profile.php">Profile</a></li>
							<li><a class="dropdown-item" href="logout.php">Logout</a></li>
							<?php
								}
							?>
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
		<h3 class="fw-bold">Contact page</h3>
		<div class="col-lg-6 mx-auto border p-5 mt-4" style="max-width:650px">
		<?php
		if(!empty($sts)){
			echo "<div class='alert alert-warning'>$sts</div>";
		}
		?>
			<form method="POST">
				<div class='form-floating mb-4'>
					<input required class="form-control font1" type="email" name="email">
					<label>Your Email <span class="imp">*</span></label>
				</div>
				<div class='form-floating mb-4'>
					<input required class="form-control font1" type="text" name="name">
					<label>Your Name <span class="imp">*</span></label>
				</div>
				<div class='form-floating mb-4'>
					<input required class="form-control font1" type="text" name="phoneno">
					<label>Your Phone Number <span class="imp">*</span></label>
				</div>
				<div class='form-floating mb-4'>
					<input required class="form-control font1" type="text" name="place">
					<label>Your Place <span class="imp">*</span></label>
				</div>
				<div class='text-start mb-4'>
					<label>Message <span class="imp">*</span></label>
					<textarea required class="form-control" rows="5" name="message"></textarea>
				</div>
				<div class="my-4">
					<button class="btn btn-danger btn-lg w-100" type="submit" name="sendmail" value="sendmail"><i class="fas fa-mail"></i> Send Mail</button>
				</div>
			</form>
		</div>
	</div>
	<!-- end of 1st container -->
	
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