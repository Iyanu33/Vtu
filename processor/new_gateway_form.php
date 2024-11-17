<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>


<?php
$name = xcape($conn,$_POST["name"]);
$value = xcape($conn,$_POST["value"]);
$type = xcape($conn,$_POST["type"]);
$gateway = xcape($conn,$_POST["service"]);
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
$sql = "INSERT INTO gateway_form (
                        id,
                        name,
                        type,
                        value,
                        gateway
                        )
                 VALUES ('$id', 
                        '$name', 
                        '$type', 
                        '$value', 
                        '$gateway' 
                         )";

if ($conn->query($sql) === TRUE) {
	    $output['message'] = $LANG['success'];
    	$output['id'] = $id;
		$output['status']="success";
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