<?php
	
	$uploadzipdiv = "";
	$instruction = "";
	$uploadmsg=array();
	$addtemplate = "<div class='col-12 py-4 px-3 border'>
								<a class='btn btn-primary btn-lg w-100' href='upload_template.php'><i class='fas fa-plus'></i> Add template</a>
							</div>";
	if(isset($_POST["upload_zip"]))
	{
		if(!isset($_SESSION["templateid"])){
		$userid		= $_SESSION["wpusrid"];
		$templtname	= mysqli_real_escape_string($connect,$_POST["templtname"]);
		
//validating zip file start
		$filename	= $_FILES["zip_file"]["name"];
		$source		= $_FILES["zip_file"]["tmp_name"];
		$type		= $_FILES["zip_file"]["type"];
		
		$accepted_ext = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/s-compressed');
		if(in_array($type,$accepted_ext,true)){ $iszip=true; }
		else{
			if(strtolower(pathinfo($filename,PATHINFO_EXTENSION))== 'zip'){ $iszip=true; } //bcoz some browsers don't register file type
			else{ $iszip=false; array_push($uploadmsg, "Please upload a valid zip file"); }
		}
		if($iszip){
			$filenoext = basename ($filename, '.zip'); 
			$filenoext = basename ($filenoext, '.ZIP');
			
			$prevpath	= 'templates/preview/'.$filenoext.'/';
			$zippath	= 'templates/zipfiles/'.$filename;
		}
//validating zip file ends
		
//validating img file start
		$preimgname	= $_FILES["preimg"]["name"];
		if($check=getimagesize($_FILES["preimg"]["tmp_name"]))
		{
			$accepted_imgext = array("jpg", "jpeg", "png", "gif");
			$preimgtype = strtolower(pathinfo($preimgname,PATHINFO_EXTENSION));
			if(in_array($preimgtype, $accepted_imgext, true))
			{
				$preimgname	= "$templtname-preview.$preimgtype";
				$preimg		= "$prevpath/$preimgname";
				$isimg		= true;
			}
			else{ $isimg=false; array_push($uploadmsg,  "Only jpg, jpeg, png and gif files are allowed"); }
		}
		else{ $isimg=false; array_push($uploadmsg,  "Media type is ".$check['mime'].". It is not an image"); }
//validating img file ends
		
		if($iszip&&$isimg)
		{
			$slt_query	= "SELECT id,user_id,homepage from templates WHERE zipfile = '$zippath'";
			$slt_result	= mysqli_query($connect, $slt_query);
			if($slt_result)
			{
				if(mysqli_num_rows($slt_result)==0)
				{
					if(file_exists($prevpath)||mkdir($prevpath)){
					if($movezip=move_uploaded_file($source,$zippath)&&$moveimg=move_uploaded_file($_FILES["preimg"]["tmp_name"], $preimg))
					{
						$zip = new ZipArchive;
						if($zip->open($zippath))
						{
							$zip->extractTo($prevpath);
							$zip->close();
							
							$ins_query	= "INSERT INTO templates VALUES(0,'$userid','$templtname','$preimg','$zippath','$prevpath',NULL,CURRENT_TIMESTAMP)";
							$ins_result	= mysqli_query($connect,$ins_query);
							
							if($ins_result){
								array_push($uploadmsg, "Your template details are uploaded successfully");
								
								$slt_query	= "SELECT id from templates WHERE filelocation = '$prevpath'";
								$slt_result = mysqli_query($connect,$slt_query);
								if($slt_result){
									array_push($uploadmsg, "Now select your home page file");
									$row = mysqli_fetch_assoc($slt_result);
									$_SESSION["templateid"] = $row["id"];
									$_SESSION["filelocation"] = $prevpath;
									//next step
									$uploadzipdiv = listfilesfolders($prevpath);
								}
								else{ array_push($uploadmsg, "but failed to proceed next of selecting home page, Try again the next step in your profile page later or inform us using contact page"); }
							}
							else{ array_push($uploadmsg, "failed to add templates details to our database, try again later or inform us using contact page $addtemplate"); }
						}
						else{ array_push($uploadmsg,"Failed to unzip your file,.. please try again later or inform us using contact page $addtemplate"); }
					}
					else{
						if(!$movezip){ array_push($uploadmsg,"Failed to move your zip file to our folder,.. please try again later or inform us using contact page "); }
						if(!$moveimg){ array_push($uploadmsg,"Failed to move your img file to our folder,.. please try again later or inform us using contact page "); }
						array_push($uploadmsg, $addtemplate);
					}
					}
					else{ array_push($uploadmsg,"Failed to create folder to upload your template,.. please try again later or inform us using contact page $addtemplate"); }
				}
				else{
					$row = mysqli_fetch_assoc($slt_result);
					if($row["user_id"]== $userid&&$row["homepage"]==""){
						$_SESSION["templateid"] = $row["id"];
						$_SESSION["filelocation"] = $prevpath;
						$uploadzipdiv = listfilesfolders($prevpath);
					}
					else{
						array_push($uploadmsg,"Please rename your file because a template with this name already exists,..$addtemplate"); 
					}
				}
			}
			else{ array_push($uploadmsg,"Failed to upload your file while checking our database,.. please try again later or inform us using contact page $addtemplate"); }
		}
		}
		else{
			$uploadzipdiv = listfilesfolders($_SESSION["filelocation"]);
		}
	}
	else{
		$instruction = "Hi !!.. To upload your template please zip your template folder and then upload it and care that you should upload image and zip file of total size less than 8 MB";
		$uploadzipdiv =  "<form enctype='multipart/form-data' method='POST' action='upload_template.php'>
							<div class='mb-5 text-start'><label class='mb-1'>Template name</label>
							<input required class='form-control mb-3 font1' type='text' name='templtname'></div>
							<div class='mb-5 text-start'><label class='mb-1'>Template zip file</label>
							<input required class='form-control mb-3 font1' type='file' name='zip_file' accept='application/zip, application/x-zip-compressed, multipart/x-zip, application/s-compressed'></div>
							<div class='mb-5 text-start'><label class='mb-1'>Preview image for your template</label>
							<div class='profile-img-wrap'><img class='img-thumbnail' src='' id='image' width='100%'>
							<div class='fileupload btn'><span class='btn-text'>choose file</span>
							<input required class='upload' type='file' accept='image/png, image/jpeg, image/jpg' name='preimg' onchange='loadfile(event)' ></div></div></div>
							<button class='btn btn-outline-secondary btn-lg me-3' type='reset'>Reset</button>
							<button class='btn btn-primary btn-lg' type='submit' name='upload_zip' value='upload_zip'>Upload</button>
						</form>";
	}
	function listfilesfolders($path){
		$div = "<form method='POST'>
					<div id='homepageselect'>
					<table class='table rounded rounded-5 text-start'>
						<thead>
							<th>#</th>
							<th>filename</th>
						</thead>
						<tbody>";
		$nooffile = 1;
		foreach(scandir($path) as $files){
			if($files!="."&&$files!="..")
			{
				if(is_dir("$path"."$files/")){
					$div .= "<tr>
								<td><i class='far fa-folder'></i></td>
								<td><span class='w-100' role='button' onclick=\"listajaxcall('$path"."$files/','$path');\" style='cursor:pointer'>$files</span></td>
							</tr>";
				}
				else{
					$div .= "<tr>
								<td><input type='radio' name='homepage[]' value='$path"."$files' id='file$nooffile'></td>
								<td><label for='file$nooffile'>$files<label></td>
							</tr>";
				}
				$nooffile++;
			}
		}
		$div .= "		</tbody>
					</table>
					</div>
					<button class='btn btn-primary' type='submit' name='homepagebtn' value='homepagebtn'>Confirm this as home page</button>
				</form>";
		return $div;
	}
	if(isset($_POST["homepagebtn"])){
		$homepage = $_POST["homepage"];
		$upd_query = "UPDATE templates SET homepage = '$homepage[0]' WHERE id = ".$_SESSION["templateid"];
		$upd_result = mysqli_query($connect, $upd_query);
		if($upd_result){
			unset($_SESSION["templateid"]);
			unset($_SESSION["filelocation"]);
			header("location:upload_template.php?msg=1");
		}
		else{
			$uploadzipdiv = listfilesfolders($_SESSION["filelocation"]);
			array_push($uploadmsg,"Sorry something became error, We will repair it soon, try again later please");
		}
	}
?>