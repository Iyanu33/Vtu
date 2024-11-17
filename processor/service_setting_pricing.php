<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
  

<?php
$min = xcape($conn,$_POST["min"]);
$max = xcape($conn,$_POST["max"]);
$fee = xcape($conn,$_POST["fee"]);
$feeCapped = xcape($conn,$_POST["feeCapped"]);
$feePercentage = xcape($conn,$_POST["feePercentage"]);
$api = xcape($conn,$_POST["api"]);
$service = xcape($conn,$_POST["service"]);

$unregisteredUser = xcape($conn,$_POST["unregisteredUser"]);
$unregisteredUserPercentage = xcape($conn,$_POST["unregisteredUserPercentage"]);

$registeredUser = xcape($conn,$_POST["registeredUser"]);
$registeredUserPercentage = xcape($conn,$_POST["registeredUserPercentage"]);

$referrerUser  = xcape($conn,$_POST["referrerUser"]);
$referrerUserPercentage  = xcape($conn,$_POST["referrerUserPercentage"]);

$apiUser  = xcape($conn,$_POST["apiUser"]);
$apiUserPercentage  = xcape($conn,$_POST["apiUserPercentage"]);

$lastUpdate = time();
 
	/*   $sql = "SELECT api FROM service WHERE id='$service' ";
		$result = $conn->query($sql);
		
		if (!$result->num_rows > 0) {
			
			
		}
*/
		
			


$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];




 

 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";

if($ready){
	
	$sql = "SELECT id FROM commission_rate WHERE service='$service' ";
		$result = $conn->query($sql);
		  if (!$result->num_rows > 0) {
		      $sql = "INSERT INTO commission_rate (service)
              VALUES ('$service')";
             $conn->query($sql);
		}
	
	
$sql = "UPDATE commission_rate SET
			registered_user = '$registeredUser',
			registered_user_percentage = '$registeredUserPercentage',
			unregistered_user =  '$unregisteredUser',
			unregistered_user_percentage =  '$unregisteredUserPercentage',
			referrer_user =  '$referrerUser',
			referrer_user_percentage =  '$referrerUserPercentage',
			api_user =  '$apiUser',
			api_user_percentage =  '$apiUserPercentage'
			WHERE service ='$service'
		";	
	$conn->query($sql);
	
	
$sql = "UPDATE service SET
			min = '$min',
			max =  '$max',
			fee = '$fee',
			fee_capped = '$feeCapped',
			fee_percentage = '$feePercentage',
			api = '$api',
			last_update ='$lastUpdate'
			WHERE id ='$service'
		";

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
	    $output['message']=$conn->error;
	    $output['title']=$LANG["not_successful"];
		$output['status']="error";
		$output['button']=$LANG["okay"];
		$output['close'] = true;
		$output['icon'] = "error";
}
}
echo json_encode($output);
$conn->close();
?>