 <?php
 function monifyLogin($apiKey,$secreteKey,$link,$json=false){ $api = base64_encode("$apiKey:$secreteKey"); $curl = curl_init(); curl_setopt_array($curl, array( CURLOPT_URL => "$link/auth/login", CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => array("Authorization: Basic $api"), CURLOPT_FOLLOWLOCATION=> true, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "POST", )); $r = curl_exec($curl); curl_close($curl); if($json===FALSE){ return json_decode($r,true); }else{ return $r; } } ?>