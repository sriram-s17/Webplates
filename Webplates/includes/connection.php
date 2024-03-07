<?php
	$connect = mysqli_connect("localhost","root","","webplates");
	if(mysqli_connect_errno()){
		echo "<p style='color:red'>Failed to connect to Database:</p>";
		exit();
	}
?>