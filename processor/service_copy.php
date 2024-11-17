<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
<?php
$service = xcape($conn,$_REQUEST["id"]);
$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];
 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";
if(empty($service)){
   $output['message'] = 'service_cannot_be_found';
}
$result = $conn->query("SELECT * FROM service WHERE id='$service'");
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $newService = md5(mt_rand()+time());
    $conn->query("INSERT INTO service (id) VALUES ('$newService')");
    foreach ($row as $key => $value) {
        if($key!="id"){
            if($key=="display_name" || $key=="name"){
                      $value = $value."_copy";
            }
           $conn->query("UPDATE service SET $key = '$value' WHERE id='$newService'");
       
       }
    }
    $result = $conn->query("SELECT * FROM plans WHERE service='$service'");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
         $newPlan = md5(mt_rand()+time());
         $conn->query("INSERT INTO plans (id,service) VALUES ('$newPlan','$newService')");
           foreach ($row as $key => $value) {
              if($key!="id" && $key!="service"){
                $conn->query("UPDATE plans SET $key = '$value' WHERE id='$newPlan'");
       
            }
           }
        }
    }
    $result = $conn->query("SELECT * FROM form WHERE service='$service'");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
         $newForm = md5(mt_rand()+time());
         $conn->query("INSERT INTO form (id,service) VALUES ('$newForm','$newService')");
           foreach ($row as $key => $value) {
              if($key!="id" && $key!="service"){
                $conn->query("UPDATE form SET $key = '$value' WHERE id='$newForm'");
       
            }
           }
        }
    }
    $result = $conn->query("SELECT * FROM display_value WHERE service='$service'");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
         $newDisplayValue = md5(mt_rand()+time());
         $conn->query("INSERT INTO display_value (id,service) VALUES ('$newDisplayValue','$newService')");
           foreach ($row as $key => $value) {
              if($key!="id" && $key!="service"){
                $conn->query("UPDATE display_value SET $key = '$value' WHERE id='$newDisplayValue'");
       
            }
           }
        }
    }
    
}  else {
    $errorFound = true;
}
if ($errorFound !== true) {
	        $output['message'] = $LANG['copied_successfully'];
    	        $output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = false;
		$output['new'] = true;
		$output['button']=$LANG["continue"];
		$output['link']="view.php?id=$newService&new=true";
} 
echo json_encode($output);
$conn->close();
?>