<?php
	session_start();
	include("includes/connection.php");
	if(!isset($_SESSION["wpusrid"])){
		header("location:index.php?error=1");
	}
	if(!isset($_GET["tempid"])){
		header("location:profile.php");
	}
	$userid	= $_SESSION["wpusrid"];
	$tempid = $_GET["tempid"];
	$updatemsg = array();
	if(isset($_POST["updatetemp"])){
		$templtname = mysqli_real_escape_string($connect,$_POST["templtname"]);
		
		$slt_query	= "SELECT name,filelocation,previewimg FROM templates WHERE id = $tempid";
		$slt_result = mysqli_query($connect, $slt_query);
		if($slt_result){
			$row=mysqli_fetch_assoc($slt_result);
			$name = $row["name"];
			$preimg = $row["previewimg"];
			$fileloc = $row["filelocation"];
			
			$filename = $_FILES["photo"]["name"];
			if($filename!="")
			{
				$filetmp_name = $_FILES["photo"]["tmp_name"];
				if($check=getimagesize($filetmp_name))
				{
					$onlyfiletypes = array("jpg", "jpeg", "png", "gif");
					$filetype = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
					if(in_array($filetype, $onlyfiletypes, true))
					{
						$filename	= "$name-preview.$filetype";
						$targetfile = "$fileloc/$filename";
						if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetfile)){
							$preimg	= $targetfile;
						}
						else{ array_push($updatemsg, "Sorry, There was an error occurs during upload your image"); }
					}
					else{ array_push($updatemsg,  "Only jpg, jpeg, png and gif files are allowed"); }
				}
				else{ array_push($updatemsg,  "Media type is ".$check['mime'].". It is not an image"); }
			}
			$homepage = $_POST["homepage"];
			
			$upd_query = "UPDATE templates SET name='$templtname', previewimg='$preimg', homepage='$homepage[0]' WHERE id=$tempid";
			$upd_result = mysqli_query($connect, $upd_query);
			if($upd_result){
				array_push($updatemsg,  "Successfully updated your template details");
			}
			else{
				array_push($updatemsg,  "Sorry, failed to update your details. Try again later or inform us");
			}
		}
		else{ array_push($updatemsg,  "Sorry, failed to updating the details with your correct database"); }
	}
	
	$slt_query	= "SELECT name,previewimg,filelocation,homepage FROM templates WHERE id = $tempid";
	$slt_result = mysqli_query($connect, $slt_query);
	if($slt_result){
		$row=mysqli_fetch_assoc($slt_result);
		$name = $row["name"];
		$preimg = $row["previewimg"];
		$loc = $row["filelocation"];
		$homepage = $row["homepage"];
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
		#loading{
			display:none;
			position:relative;
		}
		.font1{
			font-family:cursive;
		}
  	</style>
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
						<a class="nav-link" href="templates.php?page=1">Templates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact us</a>
					</li>
					<li class="nav-item dropdown">
						<span class="nav-link dropdown-toggle active" id="userdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-current="page">
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
	<div class="px-4 pt-5 my-5">
	<h1 class="display-4 fw-bold my-5 text-center">Customize Your Template...</h1>
		<div class="col-lg-6 mx-auto">
			<a href = "profile.php">Go back to profile page</a>
			<div class='col-12 border p-4'>
				<?php
					if(!empty($updatemsg)){
						foreach($updatemsg as $msg){
							echo "<div class='alert alert-warning alert-dismissible fade show'>$msg</div>";
						}
					}
				?>
				<div id="uploadzipdiv">
					<form enctype='multipart/form-data' method='POST'>
						<div class='mb-5'>
							<label class='mb-1'>Template name</label>
							<input required class='form-control mb-3 font1' type='text' name='templtname' value="<?php echo $name; ?>">
						</div>
						<div class="mb-5">
							<label class='mb-1'>Preview image for your template</label>
							<div class="profile-img-wrap">
								<img class="img-thumbnail" src='<?php echo $preimg; ?>' alt="user" id="image" width="100%">
								<div class="fileupload btn">
									<span class="btn-text">edit</span>
									<input class="upload" type="file" accept="image/png, image/jpeg, image/jpg" name="preimg" onchange="loadfile(event)" >
								</div>
							</div>
						</div>
						<div class='mb-5' id='homepageselect'>
							<?php
								echo "<table class='table rounded rounded-5'>
										<thead>
											<th>#</th>
											<th>filename</th>
										</thead>
										<tbody>";
								$nooffile = 1;
								foreach(scandir($loc) as $files){
									if($files!="."&&$files!="..")
									{
										if(is_dir("$loc/$files")){
											echo "<tr>
													<td><i class='far fa-folder'></i></td>
													<td><span role='button' class='text-start w-100' type='button' onclick=\"listajaxcall('$loc"."$files/','$loc');\" style='cursor:pointer'>$files</span></td>
												</tr>";
										}
										else{
											echo "<tr>
													<td><input type='radio' name='homepage[]' value='$loc"."$files' id='file$nooffile'></td>
													<td><label for='file$nooffile'>$files<label></td>
												</tr>";
										}
										$nooffile++;
									}
								}
								echo "	</tbody>
									</table>";
							?>
						</div>
						<button class='btn btn-outline-secondary btn-lg me-2' type='reset'>Reset</button>
						<button class='btn btn-primary btn-lg me-2' type='submit' name='updatetemp' value='updatetemp'>Save</button>
						<a href = "profile.php">Go back to profile page</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		function listajaxcall(path,loc){
			$.ajax({
				type:"POST",
				url:"listfiles.php",
				data:{
					"path":path,
					"loc":loc
				},
				success:function(response){
					$("#homepageselect").html(response);
				},
				error:function(xhr, status, error){
					alert("unable to proceed listing sub file and folders. Try again Later or inform us");
				},
			});
		}
	</script>
</body>
</html>