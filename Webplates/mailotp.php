<?php
	
	session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	if(isset($_POST["data"])){
		$email	= $_POST["data"];
		$otp	= rand(999999,111111);
		$_SESSION["otp"] = $otp;
		
		require_once 'PHPMailer/PHPMailer.php';
		require_once 'PHPMailer/SMTP.php';
		require_once 'PHPMailer/Exception.php';

		$mail = new PHPMailer(true);
		$mail->SMTPDebug = false;
		$mail->do_debug = 0;
		try {
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'sriramsu192012@gmail.com';
			$mail->Password   = '#$riram17';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port       = 587;
			
			$mail->isHTML(true);
			$mail->setFrom('sriramsu192012@gmail.com', 'ShopWhere');
			$mail->addAddress($email);
			$mail->Subject = 'WebPlates OTP Verification';
			$mail->Body    = $otp.' - It is your OTP number. Always welcome you by WebPlates!! :-)';
			
			if($mail->send()){
				echo "We send a OTP code to your email ID <span style='color:orange'> $email; </span>, Please enter the code.";
			}
			else{
				echo "Sorry.. We are unable to send OTP to your email account <span style='color:orange'>$email</span>, Try again later please";
			}
		} catch (phpmailerException $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}
	}
	else{
		echo "Unable to proceed OTP verification process";
	}
	
?>