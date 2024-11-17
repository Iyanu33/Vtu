<?php header('Content-Type: application/json');?>
<?php include '../../include/data_config.php';?>
<?php include '../../include/filter.php';?>
<?php include '../../include/urlip.php';?>
<?php include '../getAuth.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$goReady =  1;
$api = xcape($conn, getBearerToken());
$phone = xcape($conn, $_POST['phone']);
$amount = xcape($conn, $_POST['amount']);
$email = xcape($conn, $_POST['email']);
$serviceId = xcape($conn, $_POST['serviceID']);
$requestId = xcape($conn, $_POST['requestID']);
$id =  mt_rand()+time();
$postValues = mysqli_real_escape_string($conn,  json_encode($_POST));
$status = "initiated";
$regDate = time();
$refer = $_SERVER['HTTP_REFERER'];
$url = parse_url($refer);
$host  = $url["host"];
$ip = getAddresses_www($host);
$ip = $ip[0];

if(empty($serviceId)){
$goReady=0;
$response["code"] = "204";
$response["description"] = "CONTEENT_REQUIRED_SERVICEID_IS_EMPTY";
$response["status"] = "TRANSACTION_FAILED";
}elseif ($serviceId!="test_pay") {
   $response["code"] = "401";
   $response["description"] = "NOT_ALLOWED_SERVICE_ID_FOR_TEST_IS_(test_pay)";
   $response["status"] = "TRANSACTION_FAILED";
   $goReady=0;
}
if($conn->query("SELECT id FROM api_test_pay WHERE request_id ='$requestId'")->num_rows > 0){
$goReady=0;
$response["code"] = "406";
$response["description"] = "INVALID_ARGUMENTS_DUPLICATE_REQUEST_ID";
$response["status"] = "TRANSACTION_FAILED";   
}

if(empty($api)){
$response["code"] = "204";
$response["description"] = "REQUIRED_CONTENT_API_IS_EMPTY";
$response["status"] = "TRANSACTION_FAILED";
}else{
$sql = "SELECT id,credit FROM users WHERE api ='$api' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		$user = $row["id"];
	}
} else {
   $response["code"] = "401";
   $response["description"] = "INVALID_API_OR_NOT_FOUND";
   $response["status"] = "TRANSACTION_FAILED";
   $goReady=0;
}
}

if($goReady!=0){
$sql = "INSERT INTO api_test_pay(
		id, 
		request_id,
		service_id,
                user,
		amount,
		phone,
		reg_date,
		status,
		email,
		description,
		code,
                transaction_value,
		refer
		 )
		VALUES (
		'$id', 
		'$requestId', 
		'$user',
		'$serviceId',
		'$amount',
		'$phone',
		'$regDate',
		'TRANSACTION_SUCCESSFUL',
		'$email',
		'TRANSACTION_SUCCESSFUL',
		'200',
                '$postValues',
		'$refer'
		)";

               $conn->query($sql);

$sql = "SELECT * FROM api_test_pay WHERE id ='$id' OR request_id = '$requestId'";
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
         $response["gateway"]["referrer"] = $row["refer"];
         $response["content"]["date"] = date("c",$row["reg_date"]);
    }
} 
}
}else{
   $response["code"] = "025";
   $response["status"] = "TRANSACTION_FAILED";
   $response["description"] = "REQUEST_METHOD_NOT_POST";
}
print_r(json_encode($response,JSON_PRETTY_PRINT));
?>