<?php include "../../include/ini_set.php" ;?>
<?php include "../../include/data_config.php" ;?>
<?php include "../../include/filter.php" ;?>
<?php include "../../include/webconfig.php" ;?>
<?php include '../../account/userinfojson.php';?>
<?php include '../get_data.php';?>


<!--<pre>-->

<?php 
function verifyPayment($key,$a,$test=false){
$r= $a;
$result = array();
if(!empty($r)){
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$r;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, 
    ["Authorization: Bearer $key"]
);
$request = curl_exec($ch);
curl_close($ch);
return $request;

}
}

?>

    
 <?php   

$transactionRef = xcape($conn, $_GET["ref"]);
if(!empty($_GET["recharge"])){
    $transactionId = xcape($conn, $_GET["recharge"]);
    $transactionData = getRecharge($conn, $transactionId);
    $serviceData = getService($conn, $transactionData["service_id"]);
}elseif(!empty($_GET["wallet"])){
    $transactionId = xcape($conn, $_GET["wallet"]);
    $transactionData = getWallet($conn, $transactionId);
    $serviceData["fee"]=$webConfig["walletCharge"];
    $serviceData["fee_capped"]=$webConfig["chargeCap"];
    $serviceData["fee_percentage"]=$webConfig["walletFeePercentage"];
}
$methodData = getMethod($conn, $transactionData["payment_method_id"]);
$gatewayData = getGateway($conn, $methodData["gateway"]);
$methodCurrency  = getCurrency($conn, $methodData["currecny"]);
$systemCurrency = $webConfig["currency"];
$methodFee = methodFee($methodData, $transactionData["amount"], $transactionData["type"]);
$serviceFee = serviceFee($serviceData, $transactionData["amount"]);
//print_r($transactionData);
//print_r($methodData);
//print_r($gatewayData);
//print_r($serviceData);


//variables

$key = $methodData["custom_2"];
$r = verifyPayment($key, $transactionRef);
$r = json_decode($r,true); 

$requestSatus = $r['status'];
$transactionSatus = $r['data']['status'];
$gatewayResponse = $r['message'];
$payStatus = "failed";
$id = $transactionRef;  
$regDate = time();
$amount = $transactionData["amount"];
$fee = $methodFee+$serviceFee;

if(md5($r['data']["amount"].$methodData["encrypt_key"])==$r['data']['metadata']['custom_fields'][0]['salt'] && $requestSatus === true && $transactionSatus == "success"){
  $payStatus = 'success';
}

if($transactionData["type"]=="recharge"){

$sql = "INSERT INTO guest_payment (
	        id, 
		amount,   
		transaction_id, 
                gateway_response,
		reg_date,
                fee,
		status
                )
        VALUES (
              '$id',
              '$amount', 
              '$transactionId', 
              '$gatewayResponse',
              '$regDate',
              '$fee',
              '$payStatus'
              )";
}elseif($transactionData["type"]=="wallet"){
 $sql="UPDATE payment SET status='$payStatus', payment_code='$id',ref='$transactionRef',gateway_response='$gatewayResponse' WHERE id='$transactionId'"; 
}
$url = "../../payment/done.php?{$transactionData["type"]}=$id&id=$transactionId";
$conn->query($sql);
$conn->close();
javaScriptRedirect($url);
?>

