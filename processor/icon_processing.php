<?php include '../include/ini_set.php';?>  	 
<?php include '../admin/include/checklogin.php';?>  	 
<?php include '../include/filter.php';?>
<?php include '../include/data_config.php';?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php
	   if($_SERVER["REQUEST_METHOD"] == "POST") {
		$imageType = 'gif,jpeg,jpg,png';
		$imageType =   explode(',',$imageType);
	   $id = mt_rand();
	   $imageUrl = xcape($conn, $_POST['url']);
	   $key = xcape($conn, $_POST['arrayKey']);
	   $admin = xcape($conn, $_POST['admin']);
	   $bytes = mt_rand();
	   $regDate = time();
	   $pname = $bytes.$utime;
	   $target_dir = "../uploads/";
	   $readToGo = false;
	   $fileType = xcape($conn, $_POST['filetype']);
	   $imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
		if(!empty($imageUrl)){
			$fileType = 'url';
			
			 $imageFileType = pathinfo($imageUrl)['extension'];
		}
		
		$target_dir = $target_dir.date("Y",time());
		
		if(!file_exists($target_dir)){
			mkdir($target_dir);
		}
		
		$target_dir = $target_dir.date("/n",time());
		if(!file_exists($target_dir)){
			mkdir($target_dir);
		}
		
		$target_dir = $target_dir.date("/j",time());
		if(!file_exists($target_dir)){
			mkdir($target_dir);
		}
		
		$sql = "SELECT value FROM web_config WHERE  array_key='$key'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
			$oldPix = "../uploads/".$row["value"];
			}
		}
		
  
		$uploadOk = 1;
	
		
		$target_file = $target_dir.'/'.$bytes.'.'.$imageFileType;
		$image = date("Y/n/j/",time()).$bytes.'.'.$imageFileType;
		
		
		// Check if image file is a actual image or fake image
		
			clearstatcache();
			if (empty( $_FILES["file"]["name"]) && empty($imageUrl)){
				echo '<div class="alert alert-danger alert-dismissable fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					 Please select a file or use a image link.
				  </div>';
				$uploadOk = 0;
			
			}
			 if(is_executable($_FILES["file"]["tmp_name"])  || is_executable($imageUrl)){
		 echo '<div class="alert alert-danger alert-dismissable fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				 Harmful file detected.
			  </div>';
			 $uploadOk = 0;
		 }
		
			
		  if(!in_array(strtolower($imageFileType),$imageType)){
			 echo '<div class="alert alert-danger alert-dismissable fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					 Only '.implode(', ',$imageType).' are allowed, but file type is '.$imageFileType.'
				  </div>';
				$uploadOk = 0;
		  } 
		 
		
		 // Check if $uploadOk is set to 0 by an error
		 if ($uploadOk == 1) {
						
			 $readToGo = true;
			 
			 if($fileType == 'url'){
				 if(empty($title)){
				//$title = pathinfo($imageUrl)['filename'];
				
				}
				$imageFile = file_get_contents($imageUrl);
				 
				 if(!file_put_contents($target_file,$imageFile)){
					 $readToGo = false;
				 }
			 }
			 
			 if($fileType == 'file'){
				 if(empty($title)){
					//$title = pathinfo(basename($_FILES["file"]["name"]))['filename'];
					}
			if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				$readToGo = false;
			   }
			 }
				if($readToGo){
				 $sql = "UPDATE web_config SET  
				value = '$image',
				admin = '$admin',
				last_update = '$regDate'
				WHERE array_key = '$key'" ;  
				 if ($conn->query($sql) === TRUE) {
				    unlink($oldPix);
					 $output['message'] = $LANG['changes_saved_successfully'];
    	$output['id'] = $id;
		$output['status']="success";
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = true;
		$output['button']=$LANG["okay"];
		$output['reset']=false;
		$output['scroll']=true;
					  
				 } else {
					unlink($target_file);
					//echo "Error updating record: " . mysqli_error($conn);
				}
				
			} else {
				
			}
		 
		}
   }
	
echo json_encode($output);
$conn->close();	
?>
	
  