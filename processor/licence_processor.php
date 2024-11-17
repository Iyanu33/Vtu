<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>

<?php 
//print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$name =  $_POST['name'];
	$value =  $_POST['value'];
	$admin = $loginAdmin;
	$lastUpate= time();
	
	$arrlength = count($name);
		for($x = 0; $x < $arrlength; $x++) {
		$subName = $name[$x];
		$subValue = xcape($conn, $value[$x]);
		$sql = "UPDATE web_config SET  
		value = '$subValue',
		admin = '$admin',
		last_update = '$lastUpate'
		WHERE array_key = '$subName'" ;  
			if ($conn->query($sql) === TRUE) {
				$output['message'] = $LANG['changes_saved_successfully'];
				$output['id'] = $id;
				$output['status']=$LANG["success"];
				$output['title']=$LANG["success"];
				$output['icon'] = "success";
				$output['close'] = true;
				$output['button']=$LANG["okay"];
				$output['reset']=false;
				$output['scroll']=true;
					
				
			} else {
				//echo "Error updating record: " . $conn->error;
			$output['message']=$conn->error;
			$output['title']=$LANG["not_successful"];
			$output['status']="error";
			$output['button']=$LANG["okay"];
			$output['close'] = true;
			$output['icon'] = "error";
					
					
			}
		}
	}
echo json_encode($output);
$conn->close();
?>  
