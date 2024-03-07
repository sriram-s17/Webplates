<?php
	session_start();
	if(isset($_SESSION["wpusrid"])){
		
		$userid = $_SESSION["wpusrid"];
		include("includes/connection.php");
		$slt_query = "SELECT * FROM users WHERE id = $userid";
		$slt_result = mysqli_query($connect,$slt_query);
		if($slt_result){
			$row = mysqli_fetch_assoc($slt_result);
			$email	= $row["email"];
			$name	= $row["name"];
			$photo	= $row["photo"];
			$gender	= $row["gender"];
			$dob	= $row["dob"];
		}
		
		$error	= array();
		$msg="";
		if(isset($_POST["saveprofile"])){
			
			$email	= mysqli_real_escape_string($connect,$_POST["email"]);
			$name	= mysqli_real_escape_string($connect,$_POST["name"]);
			
			$photo = $photo;
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
						$filename	= "userprofile-$userid[0]".".$filetype";
						$targetfile = "assets/images/users/$filename";
						if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetfile)){
							$photo	= $targetfile;
						}
						else{ array_push($error, "Sorry, There was an error occurs during upload your image"); }
					}
					else{ array_push($error,  "Only jpg, jpeg, png and gif files are allowed"); }
				}
				else{ array_push($error,  "Media type is ".$check['mime'].". It is not an image"); }
			}
			
			$gender	= mysqli_real_escape_string($connect,$_POST["gender"]);
			$dob	= mysqli_real_escape_string($connect,$_POST["dob"]);
			$pwd	= "";
			
			if(isset($_POST["pwd"])){
				$pwd	= md5($_POST["pwd"]);
			}
			
			$upd_query	= "UPDATE users SET email = '$email', name = '$name', photo = '$photo', gender = '$gender', dob = '$dob'".($pwd !=""?", pwd = '$pwd'": "")." WHERE id = '$userid'";
			$upd_result = mysqli_query($connect, $upd_query);
			
			if($upd_result){
				$msg = "Changes Saved";
				$_SESSION["wpusrpht"] = $photo;
			}
			else{
				array_push($error, "Failed to Save Changes");
			}
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" type="image/png" href="assets/images/logo.png">
	<title>Web Plates - Profile</title>

	<!--including stylesheets and javascripts -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/gijgo.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fontawesome-5.15.4/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/webplates-style.css">
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<script src="assets/js/gijgo.min.js"></script>
	<script src="assets/js/app.js"></script>
	<style>
		.font1{
			font-family:cursive;
		}
		.table .dropdown-toggle::after {
			display: none !important;
		}
		.delete:hover{
			color:red;
		}
		.update:hover{
			color:green;
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
						<a class="nav-link" href="user_index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="templates.php?page=1">Templates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact us</a>
					</li>
					<li class="nav-item dropdown">
						<span class="nav-link dropdown-toggle active" id="userdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-current="page">
							<img class="rounded-circle" src="<?php echo $_SESSION["wpusrpht"]; ?>" width="24" alt="Admin"> <?php echo $_SESSION["wpusrname"];  ?>
						</span>
						<ul class="dropdown-menu" aria-labelledby="userdropdown">
							<li><a class="dropdown-item" href="profile.php">Profile</a></li>
							<li><a class="dropdown-item" href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar ends -->

	<!-- 1st container -->
	<div class="container px-4 pt-5 my-5 text-center border-bottom">
		<?php
			if(!empty($msg)){
				echo "<div class='alert alert-warning alert-dismissible fade show'>$msg</div>";
			}
			if(!empty($error)){
				foreach($error as $e){
					echo "<div class='alert alert-warning alert-dismissible fade show'>$e</div>";
				}
			}
		?>
		<form class="mb-5" method="POST" enctype="multipart/form-data">
			<div class="mb-4">
				<div class="profile-img-wrap">
					<img class="img-thumbnail rounded-circle" src='<?php echo $photo; ?>' alt="user" id="image" width="150" height="150">
				</div>
				<div class="fileupload btn mt-2">
					<span class="btn-text">change</span><br>
					<input class="upload font1" id="profile" type="file" accept="image/png, image/jpeg, image/jpg" name="photo" onchange="loadfile(event)">
				</div>
				<div class="fileupload btn mt-2">
					<span class="btn-text" onclick="removedp();">Remove</span><br>
				</div>
				</div>
			<div class='form-floating mb-4'>
				<input required class="form-control font1" type="text" name="name" value="<?php echo $name; ?>">
				<label>Your Name <span class="imp">*</span></label>
			</div>
			<div class='form-floating mb-4'>
				<select required class='form-control form-control-lg mb-3 font1' name='gender'>
					<option <?php if($gender=="Male"){ echo "selected"; } ?>>Male</option>
					<option <?php if($gender=="Female"){ echo "selected"; } ?>>Female</option>
					<option <?php if($gender=="Transgender"){ echo "selected"; } ?>>Transgender</option>
				</select>
				<label>Gender <span class="imp">*</span></label>
			</div>
			<div class='mb-4 text-start'>
				<label>Your Date Of Birth <span class="imp">*</span></label>
				<input required class="form-control datepicker ps-2 font1" type="text" name="dob" value="<?php echo $dob; ?>">
			</div>
			<div class='form-floating mb-4'>
				<input required class="form-control font1" type="text" name="email" value="<?php echo $email; ?>">
				<label>Your E-Mail <span class="imp">*</span></label>
			</div>
			<div class='form-floating mb-4'>
				<input disabled required class="form-control form-control-lg font1" type="password" name="pwd" minlength='8' id='pwd'>
				<label>Reset Password <span class="imp">*</span></label>
			</div>
			<p class='text-start text-primary' id='disablebtn' onclick="disablepwd();" style='cursor:pointer;display:none'>Don't Reset Password</p>
			<p class='text-start text-primary' id='enablebtn' onclick="enablepwd();" style='cursor:pointer'>Reset Password</p>
			<div class="my-4">
				<button class="btn btn-primary btn-lg w-100" type="submit" name="saveprofile" value="saveprofile">Save Profile</button>
			</div>
		</form>
	</div>
	<!-- end of 1st container -->

	<!-- 2nd container -->
    <div class="container my-5">
		<h5 class="fw-bold">Your Templates</h5>
			<table class="table font1">
				<thead>
					<th>#</th>
					<th>Template Name</th>
					<th class='text-end'>Action</th>
				</thead>
				<tbody>
				<?php
					$slt_query	= "SELECT id,name FROM templates WHERE user_id = $userid";
					$slt_result = mysqli_query($connect, $slt_query);
					if($slt_result){
						if(mysqli_num_rows($slt_result)>0){
							$i=1;
							while($row=mysqli_fetch_assoc($slt_result)){
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row["name"]; ?></td>
						<td class="dropdown text-end pe-3">
							<span class="dropdown-toggle p-3" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer"><i class="fas fa-ellipsis-v"></i></span>
							<div class="dropdown-menu dropdown-menu-right">
								<span class="dropdown-item delete" role="button" onclick="deletetemp('<?php echo $row["id"]; ?>');"><i class="fas fa-trash"></i> Delete</span>
								<a class="text-decoration-none dropdown-item update" href="update-template.php?tempid=<?php echo $row["id"]; ?>"><i class="fas fa-tasks"></i> update</a>
							</div>
						</td>
					</tr>
				<?php
								$i++;
							}
						}
					}
				?>
				</tbody>
			</table>
		<div>
		</div>
	</div>
	<script>
		$(".datepicker").datepicker({
			modal:true, header: true, footer:true, format: 'dd-mm-yyyy'
		});
		function deletetemp(id){
			$.ajax({
				type:"POST",
				url:"includes/delete-temp.php",
				data:{
					"id":id
				},
				success:function(response){
					alert(response);
					window.location.reload();
				},
				error:function(xhr, status, error){
					alert("unable to proceed delete process. Try again Later or inform us");
				},
			});
		}
		function removedp(){
			$.ajax({
				type:"POST",
				url:"includes/delete-userdp.php",
				data:{},
				success:function(response){
					document.getElementById('profile').value= null;
					document.getElementById('image').src="assets/images/user.jpg";
				},
				error:function(xhr, status, error){
					alert("unable to proceed delete process. Try again Later or inform us");
				},
			});
		}
	</script>
</body>

</html>

<?php
	}
	else{
		header("location:index.php?error=1");
	}
?>