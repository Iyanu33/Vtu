<?php 
class sendMail{
     protected $api;
 
 /*******************************************************************************
*                              Constructor                               *
*******************************************************************************/
 
 function __construct($api){
 $this->api = $api;
 }
 
 
/*******************************************************************************
*                               Public methods                                 *
*******************************************************************************/

function send($to,$message,$subject="",$senderName="",$replyTo=""){
        $host = "http://".$GLOBALS["webConfig"]["webLink"].'/mail';
	$api =  $this->api; //Your API Key
	$data = array(
	'to' => "$to",
	'message' => "$message" ,
	'subject' => "$subject",
	'replyTo' => "$replyTo",
	'senderName' => "$senderName"
	);   
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $host,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_ENCODING => "",
	CURLOPT_POSTFIELDS => $data,
	CURLOPT_HTTPHEADER => array("Authorization: Bearer $api"),
	CURLOPT_FOLLOWLOCATION=> true,
	CURLOPT_MAXREDIRS => 10,   
	CURLOPT_POSTREDIR => 3,   
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	));
	$response =  curl_exec($curl); 
	curl_close($curl);
        if($GLOBALS["webConfig"]["email_debug_mode"]!=1){
	return $response;
        }else{
           echo  "{$GLOBALS["LANG"]["gateway_link"]}: $host";
            echo $response."<br/></br/>{$GLOBALS["LANG"]["curl_error"]}: ".curl_error($curl);
        }
 }
 
}