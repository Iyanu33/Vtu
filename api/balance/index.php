<?php header('Content-Type: application/json');?>
<?php include '../include/data_config.php';?>
<?php include '../include/filter.php';?>
<?php include 'getAuth.php';?>
<?php
$response;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$api =  xcape($conn, getBearerToken());

if(empty($api)){
$response["code"] = "401";
$response["description"] = "REQUIRED_CONTENT_API_IS_EMPTY";
$response["status"] = "TRANSACTION_FAILED";
}else{

$sql = "SELECT credit,status FROM users WHERE api ='$api' ";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
                 if ($row["status"] == 'block') {
                    $goReady = 2;
                    $response["code"] = "406";
                    $response["description"] = "ACCOUNT_BLOCKED";
                    $response["status"] = "TRANSACTION_FAILED";
                }else{
                $credit= $row["credit"];
		$response["code"] = "000";
                $response["content"]["balance"] = $credit;
                }
	}
} else {
   $response["code"] = "401";
   $response["description"] = "INVALID_API_OR_NOT_FOUND";
   $response["status"] = "TRANSACTION_FAILED";
}
}



}else{
   $response["code"] = "405";
   $response["status"] = "TRANSACTION_FAILED";
   $response["description"] = "REQUEST_METHOD_NOT_IN_POST";
}

echo json_encode($response,JSON_PRETTY_PRINT);
?>