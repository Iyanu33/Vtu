<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>


<?php
$smsAlert = xcape($conn,$_POST["smsAlert"]);
$smsAlertMe = xcape($conn,$_POST["smsAlertMe"]);
$emailAlert = xcape($conn,$_POST["emailAlert"]);
$emailFailed = xcape($conn,$_POST["emailFailed"]);
$emailAlertMe = xcape($conn,$_POST["emailAlertMe"]);
$emailName = xcape($conn,$_POST["emailName"]);
$phoneName = xcape($conn,$_POST["phoneName"]);
$service = xcape($conn,$_POST["service"]);


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
	
$sql = "UPDATE service SET
			sms_alert = '$smsAlert',
			sms_alert_me =  '$smsAlertMe',
			email_alert_me = '$emailAlertMe',
			email_alert = '$emailAlert',
			email_failed = '$emailFailed',
			email_name = '$emailName',
			phone_name = '$phoneName',
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