<?php 
function getRecharge($conn,$id){
$sql = "SELECT id, amount, service_id, payment_method_id FROM recharge WHERE id = '$id' LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
   $transactionValue = mysqli_fetch_assoc($result);
}else{
	$transactionValue["notFound"] = true;
}
$transactionValue["type"] = "recharge";
return $transactionValue;
}
?>


 <?php 

 function getService($conn,$service){
    $sql = "SELECT name, fee, fee_capped, fee_percentage, id, display_name FROM service WHERE id='$service' OR name='$service'";

         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
                 // output data of each row
                 $serviceValue = $result->fetch_assoc();
         }else{
                 $serviceValue["notFound"] = true;
         }
       return $serviceValue;
			
 }			
?>

 <?php 
 function getMethod($conn,$method){
    $sql = "SELECT * FROM payment_method WHERE id='$method'";

     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
             // output data of each row
             $paymentMethod = $result->fetch_assoc();
     }else{
             $paymentMethod["notFound"] = true;
     }
    return $paymentMethod;
			
 }			
?> 
 <?php 
 function getWallet($conn,$id){
   
    $sql = "SELECT id, amount, payment_method_id FROM payment WHERE id='$id'";

     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
             // output data of each row
             $transactionValue = $result->fetch_assoc();
     }else{
             $transactionValue["notFound"] = true;
     }
     $transactionValue["type"] = "wallet";
    return $transactionValue;
 			
 }			
?> 

<?php 
function getCurrency($conn,$currency){
$sql = "SELECT * FROM currency WHERE id='$currency'";

     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
             // output data of each row
             $currencyValue = $result->fetch_assoc();
     }else{
             $currencyValue["notFound"] = true;
     }
     return $currencyValue;

}	
?>


 <?php 
 function getGateway($conn,$gateway){ 
 $sql = "SELECT name, path_name, logo FROM payment_gateway_data WHERE id='$gateway'";

         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
                 // output data of each row
                 $gatewayData = $result->fetch_assoc();
         }else{
                 $gatewayData["notFound"] = true;
         }
         return $gatewayData;	
 }
?>



<?php 
 function serviceFee($serviceValue,$amount){
 $serviceFeePercentage =  $serviceValue['fee_percentage'];
$serviceFee  =  $serviceValue["fee"];
 $serviceFeeCapped  =  $serviceValue["fee_capped"];
if($serviceFeePercentage ==1 && ($serviceFee!=0 || $serviceFee!="")){
	  $serviceFee =  ($serviceFee/100)*trim($amount);
	 if($serviceFee > $serviceFeeCapped && ($serviceFeeCapped !='' || $serviceFeeCapped!=0) ){
		 $serviceFee = $serviceFeeCapped;
	 }
}
}
?>
<?php 
function methodFee($paymentMethod,$amount,$type){
if($type=="recharge"){
	$methodFee = $paymentMethod["recharge_fee"];
	$methodFeeCapped = $paymentMethod["recharge_capped"];
	$methodFeePercentage = $paymentMethod["recharge_percentage"];
	
}else if($type=="wallet"){
	$methodFee = $paymentMethod["wallet_fee"];
	$methodFeeCapped = $paymentMethod["wallet_capped"];
	$methodFeePercentage = $paymentMethod["wallet_percentage"];
}

if($methodFeePercentage ==1 && ($methodFee!=0 || $methodFee!="")){
	  $methodFee =  ($methodFee/100)*trim($amount);
	 if($methodFee > $methodFeeCapped && ($methodFeeCapped !='' || $methodFeeCapped!=0) ){
		
		 $methodFee = $methodFeeCapped;
		
	 }
}
return $methodFee;
}
 ?>
<?php
function getPayAmount($amount,$serviceFee,$methodFee,$systemCurrecy,$paymentMethod){
 $payAmount = $amount+$serviceFee+$methodFee;
if($paymentMethod["currency"]["id"] != $systemCurrecy["currency"]["id"]){
   $paymentMethodRate = $paymentMethod["currency"]["rate"];
   $systemRate = $systemCurrecy["currency"]["rate"];
   $payAmount =  ($payAmount * $systemRate)/$paymentMethodRate;
    $payAmount =  round($payAmount,2); 
}
return $payAmount;
}
?>