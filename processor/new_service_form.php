<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>


<?php
$name = xcape($conn,$_POST["name"]);
$service = xcape($conn,$_POST["service"]);
$regx = xcape($conn,$_POST["regx"]);
$value = xcape($conn,$_POST["value"]);
$attribute = xcape($conn,$_POST["attribute"]);
$className = xcape($conn,$_POST["className"]);
$displayName = xcape($conn,$_POST["displayName"]);
$maxLen = xcape($conn,$_POST["maxLen"]);
$required = xcape($conn,$_POST["required"]);
$description = xcape($conn,$_POST["description"]);
$type = xcape($conn,$_POST["type"]);
$order = xcape($conn,$_POST["order"]);
$date = time();
$id = md5(mt_rand());
$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];


if(empty($name)){
	$error = $LANG["name_cannot_be_empty"];
	$title =  $LANG['value_rejected'];
	$ready = false;
}
if(empty($type)){
	$error = $LANG["type_cannot_be_empty"];
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
$sql = "INSERT INTO form (
							id,
							name,
							type,
							required,
							display_name,
							regx,
							description,
							class_name,
							attribute,
							max_len,
							value,
							order_key,
                            reg_date,
							service
							)
                 VALUES ('$id', 
				         '$name', 
				         '$type', 
				         '$required', 
				         '$displayName', 
				         '$regx', 
				         '$description', 
				         '$className',
				         '$attribute',
				         '$maxLen',
				         '$value', 
				         '$order', 
				         '$date', 
				         '$service' 
						 )";

if ($conn->query($sql) === TRUE) {
	    $output['message'] = $LANG['new_service_created_successfully'];
    	$output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = true;
		$output['button']=$LANG["okay"];
		$output['reset']=true;
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