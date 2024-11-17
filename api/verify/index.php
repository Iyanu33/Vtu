<?php header('Content-Type: application/json');?>
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
$sql = "SELECT user, service_id FROM api_transaction WHERE request_id ='$requestID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		$user = $row["user"];
                $serviceID =$row["service_id"];
	}
} else {
   $response["code"] = "404";
   $response["description"] = "CONTENT_NOT_FOUND_API_OR_NOT_FOUND";
   $response["status"] = "TRANSACTION_FAILED";
   $goReady=0;
}
}


$sql = "SELECT api,status FROM users WHERE id='$user'";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		if($row["api"] != $api){
                $response["code"] = "406";
               $response["description"] = "ACCESS_NOT_ALLOWED";
               $response["status"] = "TRANSACTION_FAILED";
               $goReady=0;
            }else if($row["status"]=='block'){
                    $goReady=0;
                    $response["code"] = "406";
                    $response["description"] = "ACCOUNT_BLOCKED";
                    $response["status"] = "TRANSACTION_FAILED";
                }
	}
}

if($goReady==1){
$sql = "SELECT image,display_name,fee FROM service WHERE id='$serviceID' OR name='$serviceID'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
          // output data of each row
          $serviceValue = $result->fetch_assoc();
  }else{
          $serviceValue["notFound"] = true;
  }
          //print_r($serviceValue);


$sql = "SELECT * FROM api_transaction WHERE request_id = '$requestID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
                $response["code"] = $row["code"]; 
                $response["status"] = $row["status"];
                $response["description"] = $row["description"];
                  
                $response["content"]["code"] = $row["code"];
                $response["content"]["status"] = $row["status"];
		$response["content"]["description"] = $row["description"];
                $response["content"]["transactionID"] = $row["id"];
                $response["content"]["requestID"] = $row["request_id"];
                $response["content"]["amount"] = $row["amount"];
                $response["content"]["phone"] = $row["phone"];
                $response["content"]["serviceID"] = $serviceValue["name"];
                $response["content"]["email"] = $row["email"];
                $response["content"]["finalBalance"] = $row["final_balance"];
                $response["content"]["initialBalance"] = $row["ini_balance"];
                $response["content"]["amountPaid"] = $row["pay_amount"];
		$response["content"]["image"] = $serviceValue["image"];
		$response["content"]["fee"] = $row["fee"];
		$response["content"]["serviceName"] = $serviceValue["display_name"];
	        $response["postValues"] = json_decode($row["transaction_value"],true);
                
                if(!empty($row["refer"])){
                $url = parse_url($row["refer"]);
                $host  = $url["host"];
                $ip = getAddresses_www($host);
                $ip = $ip[0];
                }
                $response["gateway"]["referrer"] = $row["refer"];
		$response["gateway"]["host"] = $host;
		$response["gateway"]["ip"] = $ip;
		$response["content"]["date"] = date("c",$row["reg_date"]);
               
    }
} else {
    //echo "0 results";
}
}
}else{
   $response["code"] = "405";
   $response["status"] = "TRANSACTION_FAILED";
   $response["description"] = "REQUEST_METHOD_NOT_IN_POST";
}
print_r(json_encode($response,JSON_PRETTY_PRINT));
?>