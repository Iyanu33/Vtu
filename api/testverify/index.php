<?php header('Content-Type: application/json');?>
<?php include '../../include/ini_set.php';?>
<?php include '../../include/data_config.php';?>
<?php include '../../include/filter.php';?>
<?php include '../../include/urlip.php';?>
<?php include '../getAuth.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$goReady =  1;
$requestID = xcape($conn, $_POST['requestID']);
$api = xcape($conn, getBearerToken());

if(empty($api)){
$response["code"] = "401";
$response["description"] = "REQUIRED_CONTENT_API_IS_EMPTY";
$response["status"] = "TRANSACTION_FAILED";
}else{
$sql = "SELECT user FROM api_test_pay WHERE request_id ='$requestID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		$user = $row["user"];
	}
} else {
   $response["code"] = "404";
   $response["description"] = "CONTENT_NOT_FOUND_API_OR_NOT_FOUND";
   $response["status"] = "TRANSACTION_FAILED";
   $goReady=0;
}
}


$sql = "SELECT api FROM users WHERE id='$user'";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		if($row["api"] != $api){
                $response["code"] = "406";
               $response["description"] = "ACCESS_NOT_ALLOWED";
               $response["status"] = "TRANSACTION_FAILED";
               $goReady=0;
            }
	}
}


$sql = "SELECT * FROM api_test_pay WHERE request_id = '$requestID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
	 $response["code"] = $row["code"];
	 $response["status"] = $row["status"];
	 $response["description"] = $row["description"];
         $response["content"]["transactionID"] = $row["id"];
         $response["content"]["requestID"] = $row["request_id"];
         $response["content"]["amount"] = $row["amount"];
         $response["content"]["phone"] = $row["phone"];
         $response["content"]["serviceID"] = "test_pay";
         $response["content"]["email"] = $row["email"];
         $response["content"]["image"] = "https://example.com/test-image.jpg";
         $response["content"]["serviceName"] = "Test Payment";
         $response["content"]["status"] = $row["status"];
         $response["content"]["code"] = $row["code"];
         $response["content"]["description"] = $row["description"];
         $response["content"]["date"] = date("c",$row["reg_date"]);
         $response["postValues"] = json_decode($row["transaction_value"],true);
         $response["content"]["date"] = date("c",$row["reg_date"]);
         
         if(!empty($row["refer"])){
            $url = parse_url($row["refer"]);
            $host  = $url["host"];
            $ip = getAddresses_www($host);
            $ip = $ip[0];
            }
         $response["gateway"]["referrer"] = $row["refer"];
         $response["gateway"]["host"] = $host;
         $response["gateway"]["ip"] = $ip;
    }
} else {
    //echo "0 results";
}
}else{
   $response["code"] = "025";
   $response["status"] = "TRANSACTION FAILED";
   $response["description"] = "REQUEST METHOD NOT POST";
}
print_r(json_encode($response,JSON_PRETTY_PRINT));
?>