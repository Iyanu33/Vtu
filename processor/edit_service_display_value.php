<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
<?php
$id = xcape($conn,$_POST["id"]);
$active = xcape($conn,$_POST["active"]);
$displayName = xcape($conn,$_POST["displayName"]);
$name = xcape($conn,$_POST["name"]);

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
$sql = "UPDATE display_value SET
			name = '$name',
			display_name =  '$displayName',
			active =  '$active' 
			WHERE id ='$id'
			";

if ($conn->query($sql) === TRUE) {
	        $output['message'] = $LANG['changes_saved_successfully'];
    	        $output['id'] = $id;
		$output['status']="success";
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