<?php 
function sendSMS($phone,$message){
    $conn= $GLOBALS["conn"];
$MSGateway = $GLOBALS["miniConfig"]["SMS_gateway"];
                        
 if($GLOBALS["miniConfig"]["notFound"]!=true){
    $sql = "SELECT * FROM service_gateway WHERE id='$MSGateway'";
    $result = $conn->query($sql);
		
    if ($result->num_rows > 0) {
        // output data of each row
        $gateway =  $result->fetch_assoc();
         $gatewayId = $gateway["id"];
        foreach ($gateway as $key => $gateValue) {
            if($key!="display_name" || $key!="id"){
                $gatewayValues[$key] = $gateValue;
            }
      }
                    
    }  
//echo $conn->error;			 
}

$sql = "SELECT value, name, type FROM gateway_form WHERE gateway='$MSGateway'";	 
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){
        
            $value = $row['value'];
            if(trim($row["type"])=='header'){
                    $headers[] = $row['name'] .":$value";
            }else if($row["type"]=='server' || $row["type"]=='hidden' || $row["type"]=="CURLOPT_POSTFIELDS"){
                    $transactionValue[$row['name']] = $value;
          }
    }
}

$transactionValue[$GLOBALS["miniConfig"]["SMS_phoneKey"]]=$phone;
$transactionValue[$GLOBALS["miniConfig"]["SMS_messageKey"]]=$message;
if($GLOBALS["miniConfig"]["SMS_debugMode"]==1){
echo "<pre> {$GLOBALS["LANG"]["debugging_mode"]} (SMS) <br/> {$GLOBALS["LANG"]["gateway_values"]} <br/>";
echo "{$GLOBALS["LANG"]["gateway"]}:  {$GLOBALS["miniConfig"]["SMS_gateway"]} <br/>";
print_r($gatewayValues);
echo "<br/> {$GLOBALS["LANG"]["form_values"]} <br/>";
print_r($transactionValue); 
echo "<br/> {$GLOBALS["LANG"]["header_values"]} <br/>";
print_r($headers);
}


$referLink= $GLOBALS["miniConfig"]["CURLOPT_REFERER"];
    if(empty($referLink)){
     $referLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    
}
	
	if($GLOBALS["miniConfig"]["CURLOPT_CUSTOMREQUEST"]=="GET"){ 
    $seperator =  "?";
    $queryData = parse_url($GLOBALS["miniConfig"]["CURLOPT_URL"])["query"];
     if(!empty($seperator)){
	$seperator =  "&";
     }
    $queryURL = $GLOBALS["miniConfig"]["CURLOPT_URL"].$seperator.http_build_query($transactionValue);
	}
	
$curl  = curl_init();
	
curl_setopt($curl, CURLOPT_URL, $gatewayValues["CURLOPT_URL"].$queryURL);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, $gatewayValues["SMS_CURLOPT_RETURNTRANSFER"]);
curl_setopt($curl, CURLOPT_POST, $gatewayValues["SMS_CURLOPT_POST"]);
curl_setopt($curl, CURLOPT_ENCODING, $gatewayValues["SMS_CURLOPT_ENCODING"]);
curl_setopt($curl, CURLOPT_POSTFIELDS, $transactionValue);
curl_setopt($curl, CURLOPT_REFERER, $gatewayValues["SMS_CURLOPT_REFERER"]);
curl_setopt($curl, CURLOPT_HTTPHEADER, array($headers));
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $gatewayValues["SMS_CURLOPT_FOLLOWLOCATION"]);
curl_setopt($curl, CURLOPT_MAXREDIRS, $gatewayValues["SMS_CURLOPT_MAXREDIRS"]);   
curl_setopt($curl, CURLOPT_POSTREDIR, $gatewayValues["SMS_CURLOPT_POSTREDIR"]);   
curl_setopt($curl, CURLOPT_TIMEOUT, $gatewayValues["SMS_CURLOPT_TIMEOUT"]);
curl_setopt($curl, CURLOPT_HTTP_VERSION, $gatewayValues["SMS_CURLOPT_HTTP_VERSION"]);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $gatewayValues["SMS_CURLOPT_CUSTOMREQUEST"]);

 $response = curl_exec($curl);
if($GLOBALS["miniConfig"]["SMS_debugMode"]==1){
        echo "<br/><br/>{$GLOBALS["LANG"]["curl_error"]} : ".curl_error($curl);
         echo "<br/><br/>{$GLOBALS["LANG"]["gateway_response"]} : $response";
   }
curl_close($curl);
}
?>