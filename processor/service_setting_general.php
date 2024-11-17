<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
<?php
$name = xcape($conn,$_POST["name"]);
$service = xcape($conn,$_POST["service"]); 
$category = xcape($conn,$_POST["category"]);
$active = xcape($conn,$_POST["active"]);
$amountName = xcape($conn,$_POST["amountName"]);
$debugMode = xcape($conn,$_POST["debugMode"]);
//$actionLink = xcape($conn,$_POST["actionLink"]);
$api = xcape($conn,$_POST["api"]);
$displayName = xcape($conn,$_POST["displayName"]);
$description = xcape($conn,$_POST["description"]);
$planFieldRequired = xcape($conn,$_POST["planFieldRequired"]);
$PlanFixedPrice = xcape($conn,$_POST["PlanFixedPrice"]);
$planName = xcape($conn,$_POST["planName"]);
$planDisplayName = xcape($conn,$_POST["planDisplayName"]);
$lastUpdate = time();

$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];


if(empty($name)){
	$error = $LANG["name_cannot_be_empty"];
	$title =  $LANG['value_rejected'];
	$ready = false;
}

if(!preg_match(checkName(),$name)){
	$error = $LANG['name_contains_invalid_character'];
	$title =  $LANG['value_rejected'];
	$ready = false;
}

 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";

if($ready){
$sql = "UPDATE service SET
			name = '$name',
			display_name =  '$displayName',
			description = '$description',
			api = '$api',
			amount_name = '$amountName', 
                        plan_fixed_price ='$PlanFixedPrice',
                        plan_field_required = '$planFieldRequired',
                        plan_name = '$planName',
                        plan_display_name = '$planDisplayName',
			active = '$active', 
			category = '$category',  
			last_update	= '$lastUpdate'
			WHERE id ='$service'
			";
			
	    
		@$conn->query("UPDATE service SET debug_mode='$debugMode' WHERE id ='$service'");


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