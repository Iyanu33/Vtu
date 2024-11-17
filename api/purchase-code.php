<?php header('Content-Type: application/json');?>
<?php include '../include/data_config.php';?>
<?php include '../include/filter.php';?>
<?php include '../include/urlip.php';?>
<?php include 'getAuth.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$goReady =  1;
$requestID = xcape($conn, $_POST['requestID']);
$api = xcape($conn, getBearerToken());

if(empty($api)){
$response["code"] = "011";
$response["description"] = "INVALID ARGUMENTS API IS EMPTY";
$response["status"] = "TRANSACTION FAILED";
}else{
$sql = "SELECT * FROM api_transaction WHERE request_id ='$requestID' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		$user = $row["api"];
	}
} else {
   $response["code"] = "023";
   $response["description"] = "INVALID API OR NOT FOUND";
   $response["status"] = "TRANSACTION FAILED";
   $goReady=0;
}
}

if($api != $user){
    $response["code"] = "024";
   $response["description"] = "ACCESS NOT ALLOWED";
   $response["status"] = "TRANSACTION FAILED";
   $goReady=0;
}

$username = "michael4dominion@gmail.com"; //email address
$password = "Beatitude11!"; //password 
$host = 'https://vtpass.com/api/query';
$data = array(  
  'request_id' => "$requestID"
);
$curl       = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => $host,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_USERPWD => $username.":" .$password,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => $data,
));  
$transaction =  curl_exec($curl);
$transaction;
$transaction = json_decode($transaction,true);
//print_r($transaction);
$tResponse =  $transaction["content"]["response_description"];

if($tResponse == "TRANSACTION SUCCESSFUL"){
$responseCode = "000";
$status = "TRANSACTION SUCCESSFUL";
}else{
 $responseCode = "016";
 $status = "TRANSACTION FAILED";
 $description = "TRANSACTION FAILED";
}

$sql = "SELECT * FROM api_transaction WHERE request_id = '$requestID'";
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
         $response["content"]["serviceID"] = $row["service_id"];
         $response["content"]["email"] = $row["email"];
         $response["content"]["customerID"] = $row["billers_code"];
         $response["content"]["plan"] = $row["variation_code"];
		 $response["content"]["image"] = $serviceDetail["image"];
		 $response["content"]["convinience_fee"] = $serviceDetail["convinience_fee"];
		 $response["content"]["productType"] = $serviceDetail["product_type"];
		 $response["content"]["serviceName"] = $serviceDetail["name"];
		 $response["gateway"]["referrer"] = $row["refer"];
		 $response["gateway"]["host"] = $row["host"];
		 $response["gateway"]["ip"] = $row["ip"];
		 $response["content"]["status"] = $row["status"];
		 $response["content"]["code"] = $row["code"];
		 $response["content"]["description"] = $row["description"];
		 $response["content"]["date"] = date("c",$row["reg_date"]);
		 $response["purchaseCode"]= $transaction["purchase_code"];
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