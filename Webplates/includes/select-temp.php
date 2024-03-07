<?php
	if(isset($_POST["keyword"])){
	$keyword = $_POST["keyword"];
	include("connection.php");
	$slt_query =  "SELECT * FROM templates WHERE homepage!='' AND name LIKE '%$keyword%' LIMIT 15";
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
					<a class="dropdown-item px-4 edit" href="<?php echo"edit-template.php?tempid=".$row["id"]; ?>" ><i class='far fa-edit'></i> Edit</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
			}
		}
	}
	}
?>