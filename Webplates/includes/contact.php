<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	if(isset($_POST["sendmail"])){
		$name	= $_POST["name"];
		$email	= $_POST["email"];
		$phoneno= $_POST["phoneno"];
		$place	= $_POST["place"];
		$msg	= $_POST["message"];
		
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
			$mail->setFrom($email, 'WebPlates - report');
			$mail->addAddress('sriramsu192012@gmail.com');
			$mail->Subject = 'WebPlates - report from '.$name;
			$mail->Body    = "Name : $name<br>Phone Number: $phoneno<br>place: $place<br>Message:<br>$msg";
			
			if($mail->send()){
				$sts =  "Successfully email sent";
			}
			else{
				$sts = "Sorry.. unable to send your message";
			}
		} catch (phpmailerException $e){
			$sts = $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			$sts = $e->getMessage(); //Boring error messages from anything else!
		}
	}
	
?>