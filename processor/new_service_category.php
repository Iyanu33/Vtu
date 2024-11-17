<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../include/filter.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>


<?php
$name = xcape($conn,$_POST["name"]);
$service = xcape($conn,$_POST["service"]);
$displayName = xcape($conn,$_POST["displayName"]);


$id = md5(mt_rand());
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
$sql = "INSERT INTO category (
                        id,
                        name,
                        display_name
                        )
                 VALUES ('$id', 
                    '$name',  
                    '$displayName'
                            )";

if ($conn->query($sql) === TRUE) {
	    $output['message'] = $LANG['new_service_created_successfully'];
    	$output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = false;
		$output['button']=$LANG["continue"];
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