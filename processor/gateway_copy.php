<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
<?php
$gateway = xcape($conn,$_REQUEST["id"]);
$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];
$output['message'] = $error;
$output['status'] = 'error';
$output['title'] = $title;
$output['button']=$LANG["okay"];
$output['close'] = true;
$output['icon'] = "error";
if(empty($gateway)){
   $output['message'] = 'gateway_could_not_be_found';
}
$result = $conn->query("SELECT * FROM service_gateway WHERE id='$gateway'");
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $newGateway  = md5(mt_rand()+time());
    $conn->query("INSERT INTO service_gateway (id) VALUES ('$newGateway')");
    foreach ($row as $key => $value) {
        if($key!="id"){
            if($key=="display_name" ){
                      $value = $value."_copy";
            }
           $conn->query("UPDATE service_gateway SET $key = '$value' WHERE id='$newGateway'");
       
       }
    }
    $result = $conn->query("SELECT * FROM gateway_form WHERE gateway='$gateway'");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
         $newForm = md5(mt_rand()+time());
         $conn->query("INSERT INTO gateway_form(id,gateway) VALUES ('$newForm','$newGateway')");
           foreach ($row as $key => $value) {
              if($key!="id" && $key!="gateway"){
                $conn->query("UPDATE gateway_form SET $key = '$value' WHERE id='$newForm'");
       
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
	$output['link']="view.php?id=$newGateway &new=true";
} 
echo json_encode($output);
$conn->close();
?>