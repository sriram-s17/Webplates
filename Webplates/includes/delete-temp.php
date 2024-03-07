<?php
	if(isset($_POST["id"])){
		$id = $_POST["id"];
		
		include("connection.php");
		$dlt_query = "DELETE FROM templates WHERE id='$id' ";
		$dlt_result = mysqli_query($connect,$dlt_query);
		
		if($dlt_result){
			echo "Your template is deleted Successfully";
		}
		else{
			echo "failed to delete your template. Try again Later or inform us";
		}
	}
	else{
		echo "unable to proceed delete process. Try again Later or inform us";
	}
?>