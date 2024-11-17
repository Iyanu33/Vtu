<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../include/filter.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php"; ?>
<?php
$table = xcape($conn,$_GET["id"]);
if($table=="api"){
    $table = 'api_test_pay';
}elseif($table=="visitor"){
    $table = 'visitor';
}

$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];
 
 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";
 
if(!empty($_GET["id"])){
$sql = "DELETE FROM  $table";
if ($conn->query($sql) === TRUE) {
	        $output['message'] = $LANG['record_removed_successfully'];
    	        $output['id'] = $id;
		$output['status']="success";
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = false;
		$output['button']=$LANG["okay"];
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