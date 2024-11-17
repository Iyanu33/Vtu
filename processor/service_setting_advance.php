<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>


<?php
$htmlTag = xcape($conn,$_POST["htmlTag"]);
$service = xcape($conn,$_POST["service"]);
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
$sql = "UPDATE service SET
			html_tag = '$htmlTag', 
			last_update	= '$lastUpdate'
			WHERE id ='$service'
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