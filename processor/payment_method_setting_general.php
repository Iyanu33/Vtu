<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>


<?php
$name = xcape($conn,$_POST["name"]);
$gateway = xcape($conn,$_POST["gateway"]); 
$active = xcape($conn,$_POST["active"]); 
$currency = xcape($conn,$_POST["currency"]);
$useWallet= xcape($conn,$_POST["useWallet"]);
$testMode= xcape($conn,$_POST["testMode"]);
$useRecharge = xcape($conn,$_POST["useRecharge"]);
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
			name = '$name',
			use_wallet =  '$useWallet',
			use_recharge = '$useRecharge',
			gateway = '$gateway',
			active = '$active',
			currency = '$currency',  
			test_mode = '$testMode',  
			last_update	= '$lastUpdate'
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