<!-- signup modal -->
<style>
	.font1{
		font-family:cursive;
	}
</style>
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="signupmodal">User Sign up</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php
					if(!empty($signuperror)){
					echo "<div class='alert alert-warning alert-dismissible fade show'>$signuperror
								<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label = 'close'>
								<span aria-hidden='true'>&times</span></button>
							</div>";
					}
				?>
				<form method="POST" onsubmit="return validpwd(1);" autocomplete="off">
					<div class="form-floating mb-3">
						<input required class="form-control font1" type="email" name="email"> <label>Email address</label>
					</div>
					<div class="form-floating mb-3">
						<input required class="form-control font1" type="text" name="name"> <label>Name</label>
					</div>
					<div class="mb-3">
						<label class="mb-1">Gender:</label><br />
						<div class="form-check form-check-inline">
							<input required class="form-check-input" id="male" type="radio" name="gender" value="Male"><label class="form-check-label" for="male">Male</label>
						</div>
						<div class="form-check form-check-inline">
							<input required class="form-check-input" id="female" type="radio" name="gender" value="Female"><label class="form-check-label" for="female">Female</label>
						</div>
						<div class="form-check form-check-inline">
							<input required class="form-check-input" id="transgender"type="radio" name="gender" value="Transgender"><label class="form-check-label" for="transgender">Transgender</label>
						</div>
					</div>
					<div class="mb-3">
						<label>Birth Date</label>
						<input required class="form-control datepicker font1" type="text" name="dob">
					</div>
					<div class="form-floating mb-3">
						<input required class="form-control" type="password" name="pwd" id="pwd1"> <label>Password</label>
					</div>
					<small id="pwderror1" style="color:red"></small>
					<div class="form-floating mb-3">
						<input required class="form-control" type="password" name="cpwd" id="cpwd1"> <label>Confirm Password</label>
					</div>
					<div class="d-flex flex-column">
						<button class="btn btn-primary btn-lg" type="submit" name="signup" value="signup">Sign up</button>
						<p class="m-3">If you have account, click <span class="text-primary text-decoration-underline" data-bs-target="#loginmodal" data-bs-toggle="modal" data-bs-dismiss="modal" style="cursor:pointer;">Login</span></p>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- signup modal ends -->

<!-- Login Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="loginmodal">User login</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php
					if(!empty($error)){
					echo "<div class='alert alert-warning alert-dismissible fade show'>$error
								<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label = 'close'>
								<span aria-hidden='true'>&times</span></button>
							</div>";
					}
				?>
				<form method="POST">
					<div class="form-floating mb-3">
						<input required class="form-control font1" type="email" name="email"> <label>Email address</label>
					</div>
					<div class="form-floating mb-3">
						<input required class="form-control font1" type="password" name="pwd" > <label>password</label>
					</div>
					<span class="text-end d-block text-primary mb-2" data-bs-target="#sendotp" data-bs-toggle="modal" data-bs-dismiss="modal" style="cursor:pointer;">forget password?</span>
					<div class="d-flex flex-column">
						<button class="px-4 btn btn-primary btn-lg" type="submit" name="login" value="login">Log in</button>
						<p class="m-3">If you don't have account, please <span class="text-primary text-decoration-underline" data-bs-target="#signupmodal" data-bs-toggle="modal" data-bs-dismiss="modal" style="cursor:pointer;"> Sign up</span></p>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Login Modal ends -->


<!-- SEND OTP -->
<div class="modal fade" id="sendotp" aria-hidden="true" aria-labelledby="sendotp" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sendotp">Send OTP to your Email</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php
					if(!empty($sendotperror)){
					echo "<div class='alert alert-warning alert-dismissible fade show'>$sendotperror
								<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label = 'close'>
								<span aria-hidden='true'>&times</span></button>
							</div>";
					}
				?>
				<form method="POST">
					<div class="mb-3">
						<input required class="form-control font1" type="email" name="email" placeholder="enter your email">
					</div>
					<button class="btn btn-primary" type="submit" name="sendotp" value="sendotp">Send OTP</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- SEND OTP ends -->

<!-- Change E-email -->
<div class="modal fade" id="changeemailmodal" aria-hidden="true" aria-labelledby="sendotp" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="changeemailmodal">Change Email Address</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php
					if(!empty($changeemailerror)){
					echo "<div class='alert alert-warning alert-dismissible fade show'>$changeemailerror
								<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label = 'close'>
								<span aria-hidden='true'>&times</span></button>
							</div>";
					}
				?>
				<form method="POST">
					<div class="mb-3">
						<input required class="form-control font1" type="email" name="email" placeholder="enter your email">
					</div>
					<p>If you don't want to change your email, continue <span class='text-primary ms-3' data-bs-target='#verifyotpmodal' data-bs-toggle='modal' data-bs-dismiss='modal' style='cursor:pointer'>Verify otp</span></p>
					<button class="btn btn-primary" type="submit" name="changeemail" value="changeemail">Reset Email</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- change email ends -->

<!-- VERIFY OTP MODAL -->
<div class="modal fade" id="verifyotpmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="otpmodal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="verifyotpmodal">Verify Email</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<img src="assets/images/loading.gif" width="50" height="50" alt="loading" class="loading">
				<div id="otpform">
					<div class='alert alert-warning alert-dismissible fade show' id="otpalert" style="display:none"></div>
					<form method="POST">
						<div class="mb-3">
							<input class="form-control font1" type="text" name="otp" placeholder="OTP number">
						</div>
						
						<?php if(isset($_SESSION["wpemail"])){ ?>
						<span class='d-block text-primary mb-2' onclick="sendotp('mailotp.php','<?php echo $_SESSION["wpemail"]; ?>');" style='cursor:pointer'>Resend OTP</span>
						<?php } ?>
						
						<?php if(isset($_SESSION["verifyfor"])&&$_SESSION["verifyfor"]!="rpwd"){ ?>
						<span class='d-block text-primary mb-2' data-bs-target="#changeemailmodal" data-bs-toggle="modal" data-bs-dismiss="modal" style='cursor:pointer'>change email</span>
						<?php } ?>
						
						<button class="btn btn-primary" type="submit" name="verify" value="verify">Verify</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- VERIFY OTP MODAL ends -->

<!-- RESET PASSWORD -->
<div class="modal fade" id="resetpwd" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="resetpwd" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="restpwd">Reset Password</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="POST" onsubmit="return validpwd(2);">
					<div class="mb-3">
						<input required class="form-control" id="pwd2" type="password" name="pwd" placeholder="Password" minlength="8">
					</div>
					<small style="color:red" id="pwderror2"></small>
					<div class="mb-3">
						<input required class="form-control" id="cpwd2" type="password" name="cpwd" placeholder="Confirm Password" minlength="8">
					</div>
					<button class="btn btn-primary" type="submit" name="resetpwd" value="resetpwd">Reset</button>
					<span class="text-primary ms-3" data-bs-target="#loginmodal" data-bs-toggle="modal" data-bs-dismiss="modal" style="cursor:pointer"> or Login</span>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- RESET PASSWORD ends-->

<script>
	$(".datepicker").datepicker({
		modal:true, header: true, footer:true, format: 'dd-mm-yyyy'
	});
	
	function sendotp(url,data){
		$('#verifyotpmodal').modal('show');
		$.ajax({
			type:"POST",
			url:url,
			data:{
				"data":data
			},
			beforeSend: function(){
				$('.loading').show();
				$("#otpform").hide();
			},
			complete: function(){
				$('.loading').hide();
				$("#otpform").show();
			},
			success:function(response){
				$("#otpalert").show();
				$("#otpalert").html(response);
			},
			error:function(xhr, status, error){
				$('#verifyotpmodal').modal('hide');
				alert("Sorry, we are failed to done your request. We will repair it soon.");
			},
		});
	}
</script>