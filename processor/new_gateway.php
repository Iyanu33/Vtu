<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../include/filter.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php"; ?>

<?php
$displayName = xcape($conn,$_POST["displayName"]);
$id = md5(mt_rand());
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
$sql = "INSERT INTO service_gateway (id,display_name)
                 VALUES ('$id','$displayName')";

if ($conn->query($sql) === TRUE) {
	    $output['message'] = $LANG['success'];
    	       $output['id'] = $id;
		$output['status']="success";
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = false;
		$output['new'] = true;
		$output['button']=$LANG["continue"];
		$output['link']="edit.php?id=$id&new=true";
   
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