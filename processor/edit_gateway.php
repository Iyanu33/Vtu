    <?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../include/filter.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php"; ?>

<?php 
$com="";
$name = "";
$ready = true;
$id = trim(xcape($conn, $_POST["id"]));
foreach($_POST as $key => $value) {
	$key = mysqli_real_escape_string($conn,$key);
	$value = trim(xcape($conn, $value));
	if($key != "id" && $key != "new"){
		$name = $name."$com $key ='$value'";
	}
	if(!empty($name)){
       $com=",";
	}
}

$output['message']=$LANG["unknown_error"];
$output['status']="info";
$output['button']=$LANG["okay"];
$output['title']= $LANG["an_error_occurred"];
$output['close'] = true;
$output['icon'] = "error";
    

if($ready){
$sql = "UPDATE service_gateway SET $name WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
	    $output['message'] = $id;
	    $output['message']=$LANG["service_updated_successfuly"];
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = true;
		$output['button']=$LANG["okay"];
		
} else {
	    $output['message']=$conn->error;
	    $output['title']=$LANG["error_in_updating_record"];
		$output['status']="error";
		$output['button']=$LANG["okay"];
		$output['close'] = true;
		$output['icon'] = "error";
}

}
       

echo json_encode($output);
$conn->close();
?>