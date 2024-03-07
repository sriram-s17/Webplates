<?php
	session_start();
	if(isset($_SESSION["wpusrid"])){
		$id = $_SESSION["wpusrid"];
		
		include("connection.php");
		$upd_query = "UPDATE users SET photo='assets/images/user.jpg' WHERE id='$id' ";
		$upd_result = mysqli_query($connect,$upd_query);
		if($upd_result){
			echo "success $upd_query";
		}
		else{
			echo "failure";
		}
	}
?>