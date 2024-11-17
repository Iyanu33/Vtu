<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../include/filter.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php"; ?>
<?php 
$apiKey = xcape($conn,$_POST["apiKey"]);
$secreteKey = xcape($conn,$_POST["secreteKey"]);
$contractCode = xcape($conn,$_POST["contractCode"]);
$fee = xcape($conn,$_POST["fee"]);
$feePercentage = xcape($conn,$_POST["feePercentage"]);
$active = xcape($conn,$_POST["active"]);
$noKYC = xcape($conn,$_POST["noKYC"]);


$ready = true;

 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";

if($ready){
$sql = "UPDATE third_party_feature SET
			var1 = '$apiKey', 
			var2 =  '$secreteKey',
			var3 =  '$contractCode',
			var4 =  '$fee',
			var5 =  '$feePercentage',
			var6 =  '$active',
			var7 =  '$noKYC'
			WHERE name ='monnify_reserved_account'
			";

if ($conn->query($sql) === TRUE) {
	    $output['message'] = $LANG['changes_saved_successfully'];
    	$output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = true;
		$output['button']=$LANG["continue"];
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