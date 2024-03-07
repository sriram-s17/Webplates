<?php
	session_start();
	include("includes/connection.php");
	if (!isset ($_GET['page']) ) {  
		$page = 1;  
	} else {  
		$page = $_GET['page'];  
	}
?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" type="image/png" href="assets/images/logo.png">
	<title>Web Plates - templates</title>

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
		.tempdropd .dropdown-toggle::after {
			display: none !important;
		}
		.font1{
			font-family:cursive;
		}
  	</style>
	<?php
		$headerfile="templates.php?page=$page";
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
						<a class="nav-link active" aria-current="page" href="templates.php?page=<?php echo $page; ?>">Templates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact us</a>
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
		<h1 class="display-4 fw-bold">Templates</h1>
		<div class="col-lg-6 mx-auto">
			<p class="lead mb-4">Hi !!.. thanks for coming here...<br />Here you can download, Preview, or Edit the templates.</p>
			<?php
				if(!isset($_SESSION["wpusrid"])){
			?>
			<p class="lead mb-4">I think you are not signed in, Login or Signup to edit the websites you want.</p>
			<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
				<button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign up</button>
				<button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#loginmodal">Log in</button>
			</div>
			<?php
				}
			?>
			<div class="col-12 py-4 px-3">
				<p class="lead mb-2">Add Your template also</p>
				<a class="btn btn-primary btn-lg w-100" href="upload_template.php"><i class="fas fa-plus"></i> Add template</a>
			</div>
	    </div>
	</div>
	<!-- end of 1st container -->
	
	<!-- 2nd container -->
	<div class="container my-5">
		<div class="col-12 py-4 px-3 input-group">
			<input class="form-control form-control-lg border-end-0" type="text" id="tempsearch" onkeyup="fetchtemp();" placeholder="Search templates">
			<span class="py-3 px-3 border border-start-0 bg-white"><i class="fas fa-search"></i></span>
		</div>
		<div class="row" id="tempshow">
			<?php
				$pageresult = ($page-1)*9;
				$slt_query =  "SELECT * FROM templates WHERE homepage!='' LIMIT $pageresult, 9";
				$slt_result = mysqli_query($connect,$slt_query);
				if($slt_result){
					if(($wptmpcount = mysqli_num_rows($slt_result))>0){
						while($row = mysqli_fetch_assoc($slt_result)){
			?>
    
			<div class="col-md-6 col-lg-4 mb-5 p-3 font1">
				<div class="img-thumbnail">
					<div class="col">
						<img src="<?php echo $row["previewimg"]; ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" loading="lazy">
					</div>
					<div class="col d-flex flex-row justify-content-between m-3">
						<div>
							<h5 class="fw-bold lh-1"><?php echo $row["name"]; ?></h5>
							<small class="mb-4"><i class="far fa-calendar"></i> Uploaded at <?php echo $row["upd_time"]; ?></small>
						</div>
						<div class="dropdown tempdropd">
							<i class="fas fa-ellipsis-v dropdown-toggle p-2" id="temp" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer"></i>
							<div class="dropdown-menu" aria-labelledby="temp">
								<a class="dropdown-item px-4 download" href="<?php echo $row["zipfile"]; ?>" download ><i class='fas fa-download'></i> Download</a>
								<a class="dropdown-item px-4 preview" href="<?php echo"preview-template.php?tempid=".$row["id"]; ?>" ><i class='fas fa-eye'></i> Preview</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
						}
					}
				}
			?>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-end">
				
					<li class="page-item <?php if($page==1) echo "disabled"; ?>">
						<a class="page-link" href=<?php echo ($page==1?"'javascript:void(0);' tabindex='-1'":"'templates.php?page=".($page-1)."'"); ?> >Previous</a>
					</li>
		<?php 
			$slt_query =  "SELECT id FROM templates WHERE homepage!=''";
			$slt_result = mysqli_query($connect,$slt_query);
			if($slt_result){
				$totaltmpcount = mysqli_num_rows($slt_result);
			}
			for($j=1;$j<=ceil($totaltmpcount/9);$j++){
				echo "<li class='page-item'><a class='page-link' href='templates.php?page=$j'>$j</a></li>";
			}
		?>
					
					<li class="page-item <?php if($page==ceil($totaltmpcount/9)) echo "disabled"; ?>">
						<a class="page-link" href=<?php echo ($page==ceil($totaltmpcount/9)?"'javascript:void(0);' tabindex='-1'":"'templates.php?page=".($page+1)."'"); ?>>Next</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="col-12 py-4 px-3 border">
			<a class="btn btn-primary btn-lg w-100" href="upload_template.php"><i class="fas fa-plus"></i> Add template</a>
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
	
	<script>
		function fetchtemp(){
			var keyword = $("#tempsearch").val();
			$.ajax({
				type:"POST",
				url:"includes/select-temp.php",
				data:{
					"keyword":keyword
				},
				success:function(response){
					$("#tempshow").html(response);
				},
				error:function(xhr, status, error){
					alert("unable to proceed delete process. Try again Later or inform us");
				},
			});
		}
	</script>
	
</body>
</html>