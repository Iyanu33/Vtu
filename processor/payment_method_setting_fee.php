<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
 

<?php
$rechargeFee = xcape($conn,$_POST["rechargeFee"]);
$rechargeCapped = xcape($conn,$_POST["rechargeCapped"]);
$rechargePercentage = xcape($conn,$_POST["rechargePercentage"]);

$walletFee = xcape($conn,$_POST["walletFee"]);
$walletCapped = xcape($conn,$_POST["walletCapped"]);
$walletPercentage = xcape($conn,$_POST["walletPercentage"]);

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
			recharge_fee = '$rechargeFee',
			recharge_capped =  '$rechargeCapped',
			recharge_percentage = '$rechargePercentage',
			wallet_fee = '$walletFee',
			wallet_percentage = '$walletPercentage',
			wallet_capped = '$walletCapped',
			last_update ='$lastUpdate'
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