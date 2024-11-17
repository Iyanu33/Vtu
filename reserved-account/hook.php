<?php include "../include/ini_set.php"; ?>
<?php include '../include/filter.php';?> 
<?php include "../include/data_config.php"; ?>
<?php include "function/login.php"; ?>
<?php include "function/value.php"; ?>
<?php include "function/link.php"; ?>
<?php
$response = json_decode(file_get_contents('php://input'),true); $ref = $response["product"]["reference"]; $user = $conn->query("SELECT users.name AS name, reserved_account.owner AS id, users.credit AS credit FROM reserved_account,users WHERE reserved_account.ref='$ref' AND users.id=reserved_account.owner")->fetch_assoc(); $token = monifyLogin($apiKey, $secreteKey,$monnifyLink); $api = $token["responseBody"]["accessToken"]; $verifyHost = "$monnifyLink2/transactions/".urlencode($response["transactionReference"]); $curl = curl_init(); curl_setopt_array($curl, array( CURLOPT_URL => "$verifyHost", CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => array("Authorization: Bearer $api"), CURLOPT_FOLLOWLOCATION=> true, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "GET", )); $r = curl_exec($curl); $r = json_decode($r,true); if($r["requestSuccessful"]===true && $r["responseMessage"] == "success"){ $verified = true; } $amount = (float)$response["amountPaid"]; if($feePercentage=='1'){ $fee = ($fee/100)*$amount; } $settleAmount = $amount - $fee; $settleAmount = $settleAmount + $user["credit"]; $hash = "{$secreteKey}|{$response["paymentReference"]}|{$response["amountPaid"]}|{$response["paidOn"]}|{$response["transactionReference"]}"; $hash = hash("SHA512",$hash); $id = md5($hash); $id = preg_replace("/[^0-9]/", "", $id ); $regDate = time(); $paymentCode = $response["paymentReference"]; $gatewayResponse = $r["responseMessage"]; $sql = "
   INSERT INTO payment (
   id,
   owner,
   amount,
   status,
   payment_code,
   payment_method_id,
   reg_date,
   settled,
   gateway_response,
   ref,
   ini_balance,
   final_balance,
   fee
   ) VALUES(
   '$id',
   '{$user["id"]}',
   '$amount',
   '$paymentCode',
   'success',
   'monnify_reserved_account',
   '$regDate',
   '1',
   '$gatewayResponse',
   '$paymentCode',
   '{$user["credit"]}',
   '$settleAmount',
   '$fee'
   )
"; if($verified===true && $hash == $response["transactionHash"]){ if($conn->query($sql) === true){ $conn->query("UPDATE users SET credit='$settleAmount' WHERE id='{$user["id"]}'"); } } ?>