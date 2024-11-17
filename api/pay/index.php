<?php header('Content-Type: application/json');?>
<?php include '../../include/ini_set.php';?>
<?php include '../../include/data_config.php';?>
<?php include '../../include/filter.php';?>
<?php include '../../include/webconfig.php';?>


<?php include '../getAuth.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$goReady =  1;
$api = xcape($conn, getBearerToken());
$requestId = xcape($conn, $_POST['requestID']);
$serviceId = xcape($conn, $_POST['serviceID']);
if(empty($requestId)){
$requestId =  mt_rand()+time();
}
$_POST["refer"] = xcape($conn, $_SERVER['HTTP_REFERER']);

if(empty($serviceId)){
$goReady=2;
$response["code"] = "204";
$response["description"] = "CONTEENT_REQUIRED_SERVICEID_IS_EMPTY";
$response["status"] = "TRANSACTION_FAILED";
}
if($conn->query("SELECT id FROM api_transaction WHERE request_id ='$requestId'")->num_rows > 0){
$goReady=2;
$response["code"] = "406";
$response["description"] = "INVALID_ARGUMENTS_DUPLICATE_REQUEST_ID";
$response["status"] = "TRANSACTION_FAILED";   
}


if(empty($api)){
$response["code"] = "204";
$response["description"] = "REQUIRED_CONTENT_API_IS_EMPTY";
$response["status"] = "TRANSACTION_FAILED";
}else{
$sql = "SELECT id,credit,refer_by,status, email FROM users WHERE api ='$api' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	        $referBy = $row["refer_by"];
		$GLOBALS["user"]["credit"] = $row["credit"];
		$GLOBALS["user"]["id"]= $row["id"];
		$GLOBALS["user"]["email"]= $row["email"];
                
                if($row["status"]=='block'){
                    $goReady=2;
                    $response["code"] = "406";
                    $response["description"] = "ACCOUNT_BLOCKED";
                    $response["status"] = "TRANSACTION_FAILED";
                }
                
                
	}
} else {
   $response["code"] = "401";
   $response["description"] = "INVALID_API_OR_NOT_FOUND";
   $response["status"] = "TRANSACTION_FAILED";
   $goReady=2;
}
}

if($goReady==1){
  include "../../payment/recharge_processor.php";
  $response = payService($conn, $_POST, $referBy, false, true);
}
}else{
   $response["code"] = "405";
   $response["status"] = "TRANSACTION_FAILED";
   $response["description"] = "REQUEST_METHOD_NOT_IN_POST";
}


print_r(json_encode($response,JSON_PRETTY_PRINT));
?>