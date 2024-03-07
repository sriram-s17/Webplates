<?php
	session_start();
	include("includes/connection.php");
	include("includes/uploadzip.php");
?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" type="image/png" href="assets/images/logo.png">
	<title>Web Plates - upload template</title>

	<!--including stylesheets and javascripts -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/webplates-style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fontawesome-5.15.4/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/gijgo.min.css">
	
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<script src="assets/js/gijgo.min.js"></script>
	<script src="assets/js/app.js"></script>
  	<!-- custom style -->
  	<style>
		#loading{
			display:none;
			position:relative;
		}
		.font1{
			font-family:cursive;
		}
  	</style>
	<?php
		$headerfile="upload_template.php";
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
						<a class="nav-link active" aria-current="page" href="templates.php?page=1">Templates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact us</a>
					</li>
					<li class="nav-item dropdown">
						<span class="nav-link dropdown-toggle" id="userdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img class="rounded-circle" src="<?php if(isset($_SESSION["wpusrid"])){ echo $_SESSION["wpusrpht"]; } else { echo "assets/images/user.jpg"; } ?>" width="24" alt="Admin"> 
							<?php if(isset($_SESSION["wpusrid"])){ echo $_SESSION["wpusrname"]; }else { echo "User"; } ?>
						</span>
						<?php
							if(!isset($_SESSION["wpusrid"])){
						?>
						<ul class="dropdown-menu" aria-labelledby="userdropdown">
							<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign up</button></li>
							<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button></li>
						</ul>
						<?php
							}
							else{
						?>
						<ul class="dropdown-menu" aria-labelledby="userdropdown">
							<li><a class="dropdown-item" href="profile.php">Profile</a></li>
							<li><a class="dropdown-item" href="logout.php">Logout</a></li>
						</ul>
						<?php
							}
						?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar ends -->
	
	<!-- 1st container -->
	<div class="px-4 pt-5 my-5 text-center">
		<h1 class="display-4 fw-bold">Upload Your Template...</h1>
		<div class="col-lg-6 mx-auto">
			<p class="lead mb-4"><?php echo $instruction; ?></p>
			<?php
				if(!isset($_SESSION["wpusrid"])){
			?>
			<p class="lead mb-4">I think you are not signed in, Login or Signup to Upload your templates.</p>
			<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
				<button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign up</button>
				<button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#loginmodal">Log in</button>
			</div>
			<?php
				}else{
			?>
			<div class='col-12 border p-4'>
				<?php
					if(!empty($uploadmsg)){
						foreach($uploadmsg as $msg){
							echo "<div class='alert alert-warning alert-dismissible fade show'>$msg</div>";
						}
					}
					if(isset($_GET["msg"])&&$_GET["msg"]==1){
						echo "<p class='text-success'>Successfully added Your Template</p>";
					}
				?>
				<div id="uploadzipdiv">
					<?php
						echo $uploadzipdiv;
					?>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<?php
		if(!isset($_SESSION["wpusrid"])){
			showmodal("loginmodal");
			include("includes/signup-login-modal.php");
		}
	?>
	
</body>

</html>