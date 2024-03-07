<?php
	
	$error="";
	$signuperror="";
	//Sign up authentication start
	if(isset($_POST["signup"])){
		
		$email	= mysqli_real_escape_string($connect,$_POST["email"]);
		$name	= mysqli_real_escape_string($connect,$_POST["name"]);
		$gender	= mysqli_real_escape_string($connect,$_POST["gender"]);
		$dob	= mysqli_real_escape_string($connect,$_POST["dob"]);
		$pwd	= md5(mysqli_real_escape_string($connect,$_POST["pwd"]));
		
		$slt_query	= "SELECT id FROM users WHERE email = '$email'";
		$slt_result	= mysqli_query($connect,$slt_query);
		if($slt_result){
			if(mysqli_num_rows($slt_result)<1){
				
				$inst_query	= "INSERT INTO users VALUES(0,'$email','$name',DEFAULT,'$gender','$dob','$pwd','no')";
				$inst_result= mysqli_query($connect,$inst_query);
				
				if($inst_result){
					$_SESSION["verifyfor"]	= "email";
					sendotp($email);
				}
				else{
					$signuperror = "Sorry.. we are unable to create your account. Please try again later";
					showmodal("signupmodal");
				}
			}
			else{
				$signuperror = "Your email account($email) is already registered.";
				showmodal("signupmodal");
			}
		}
	}
	// end of sign up authentication
	
	// Login authentication
	if(isset($_POST["login"])){
		
		$email					= mysqli_real_escape_string($connect,$_POST["email"]);
		$pwd					= md5(mysqli_real_escape_string($connect,$_POST["pwd"]));
		
		$slt_query	= "SELECT id,name,photo,pwd,verified FROM users WHERE email = '$email'";
		$slt_result	= mysqli_query($connect,$slt_query);
		
		if($slt_result){
			if(mysqli_num_rows($slt_result)>0){
				$row	= mysqli_fetch_assoc($slt_result);
				
				if($row["verified"]=="yes"){
					$vpwd = $row["pwd"];
					if($pwd == $vpwd){
						$_SESSION["wpusrid"]	= $row["id"];
						$_SESSION["wpusrname"]	= $row["name"];
						$_SESSION["wpusrpht"]	= $row["photo"];
						header("location:$headerfile");
					}
					else{
						$error= "Incorrect Password";
						showmodal("loginmodal");
					}
				}
				else{
					$_SESSION["verifyfor"]	="email";
					sendotp($email);
				}
			}
			else{
				$error = "No User in this email. Please sign up";
				showmodal("loginmodal");
			}
		}
		else{
			$error = "Something went wrong with our login system. Try again $email";
			showmodal("loginmodal");
		}
	}
	//login authentication end
	
	//resend OTP
	if(isset($_POST["sendotp"])){
		$email				= $_POST["email"];
		$slt_query	= "SELECT id FROM users WHERE email = '$email'";
		$slt_result	= mysqli_query($connect,$slt_query);
		
		if($slt_result){
			if(mysqli_num_rows($slt_result)>0){
				$_SESSION["verifyfor"]	= "rpwd";
				sendotp($email);
			}
			else{
				$sendotperror = "No user in this email";
				showmodal("sendotp");
			}
		}else{
			$sendotperror = "sorry something went wrong from us.  Please try again later";
			showmodal("sendotp");
		}
	}
	//end of resend otp
	
	//change email
	if(isset($_POST["changeemail"])){
		$email	= $_POST["email"];
						
		if($email != $_SESSION["wpemail"]){
			$slt_query	= "SELECT id FROM users WHERE email = '$email'"; //to check, others have this email already
			$slt_result	= mysqli_query($connect,$slt_query);
			
			$errorfromus	= "Sorry We are unable to change your Email ID. Try again later or if the previously entered email is correct continue Verify OTP";
			
			if($slt_result){
				if(mysqli_num_rows($slt_result)<1){
					$upd_query	= "UPDATE users SET email = '$email' WHERE email = '".$_SESSION["wpemail"]."'";
					$upd_result	= mysqli_query($connect, $upd_query);
					if($upd_result){
						sendotp($email);
					}
					else{
						$changeemailerror = $errorfromus;
						showmodal("changeemailmodal");
					}
				}
				else{
					$changeemailerror = "This E-mail ID is Already Registered";
					showmodal("changeemailmodal");
				}
			}
			else{
				$changeemailerror = $errorfromus;
				showmodal("changeemailmodal");
			}
		}
		else{
			$changeemailerror = "You are entered Same email";
			showmodal("changeemailmodal");
		}
	}
	//end of change email
	
	//verify otp
	if(isset($_POST["verify"])){
		$otp	= $_SESSION["otp"];
		if($_POST["otp"] == $otp){
			unset($_SESSION["otp"]);
			
			if($_SESSION["verifyfor"]=="rpwd"){
				unset($_SESSION["verifyfor"]);
				showmodal("resetpwd");
			}
			else{
				unset($_SESSION["verifyfor"]);
				$email	= $_SESSION["wpemail"];
				$upd_query	= "UPDATE users SET verified='yes' WHERE email='$email'";
				$upd_result	= mysqli_query($connect,$upd_query);
				
				if($upd_result){
					$error="Your email is verified . Now login please..";
					showmodal("loginmodal");
				}
				else{
					$error="sorry we are failed to verify your email . Try again later";
					showmodal("loginmodal");
				}
			}
		}
		else{
			showmodal("otpmodal");
			echo "<script>
					$(document).ready(function(){
					$('#otpalert').show();
					$('#otpalert').html('Incorrect OTP');
					});
				</script>";
		}
	}
	// end of verify otp
	
	//Reset Password
	if(isset($_POST["resetpwd"])){
		$pwd	= md5(mysqli_real_escape_string($connect,$_POST["pwd"]));
		$email	= $_SESSION["wpemail"];
		$upd_query	= "UPDATE users SET pwd='$pwd' WHERE email='$email'";
		$upd_result	= mysqli_query($connect,$upd_query);
		
		if($upd_result){
			$error="Password Updated Successfully";
			showmodal("loginmodal");
		}
	}
	//Reset password ends
	
	//sendotp function
	function sendotp($email){
		$_SESSION["wpemail"] = $email;
		echo "<script>
				$(document).ready(function(){
					sendotp('mailotp.php','$email');
				});
			</script>";
			
	}
	
	//show login modal function
	function showmodal($modal){
		echo "<script>
				$(document).ready(function(){
					$('#$modal').modal('show');
				});
		</script>";
	}
	
?>