<?php
	session_start();
	if(isset($_POST["path"])&&isset($_POST["loc"])){
		$loc = $_POST["loc"];
		$path = realpath($_POST["path"]);
		$path = str_replace('\\','/',$path);
		$path = substr($path,strpos($path,"templates/preview/"));
		echo "<table class='table rounded rounded-5 text-start'>
				<thead>
					<th>#</th>
					<th>filename</th>
				</thead>
				<tbody>";
		$nooffile = 1;
		foreach(scandir($path) as $files){
			if($files!=".")
			{
				if(is_dir("$path/$files/")){
					if(!($loc=="$path/"&&$files=="..")){
						echo "<tr>
								<td><i class='far fa-folder'></i></td>
								<td><span role='button' class='text-start w-100' type='button' onclick=\"listajaxcall('$path/$files/','$loc');\" style='cursor:pointer'>$files</span></td>
							</tr>";
					}
				}
				else{
					echo "<tr>
							<td><input type='radio' name='homepage[]' value='$path/$files' id='file$nooffile'></td>
							<td><label for='file$nooffile'>$files<label></td>
						</tr>";
				}
				$nooffile++;
			}
		}
		echo "	</tbody>
			</table>";
		}
	else{
		echo "unable to list subfiles and folders";
	}
?>
		