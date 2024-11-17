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
$id = $service;

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
$sql = "UPDATE form SET
			name = '$name', 
			type = '$type',
			required = '$required',
			display_name =  '$displayName',
			regx = '$regx', 
			description = '$description',
			class_name = '$className',
			attribute = '$attribute',
			max_len  = '$maxLen',
			value =  '$value', 
			order_key = '$order'
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