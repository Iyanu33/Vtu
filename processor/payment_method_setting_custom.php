<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
  

<?php
$custom1 = xcape($conn,$_POST["custom_1"]);
$custom2 = xcape($conn,$_POST["custom_2"]);
$custom3 = xcape($conn,$_POST["custom_3"]);
$custom4 = xcape($conn,$_POST["custom_4"]);
$id = xcape($conn,$_POST["id"]);
$lastUpdate = time();


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
	
$sql = "UPDATE payment_method SET
			custom_1 = '$custom1',
			custom_2 = '$custom2',
			custom_3 =  '$custom3',
			custom_4 =  '$custom4',
			last_update =  '$lastUpdate'
			WHERE id ='$id'
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