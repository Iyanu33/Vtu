<?php
$a = "
 '000':'TRANSACTION SUCCESSFUL',
 '001':'TRANSACTION QUERY',
 '011':'INVALID ARGUMENTS', 
 '012':'PRODUCT DOES NOT EXIST', 
 '013':'BELOW MINIMUM AMOUNT ALLOWED', 
 '017':'ABOVE MAXIMUM AMOUNT ALLOWED', 
 '018':'LOW WALLET BALANCE', 
 '014':'REQUEST ID ALREADY EXIST',             
 '015':'INVALID REQUEST ID',             
 '016':'TRANSACTION FAILED',
 '019':'LIKELY DUPLICATE TRANSACTION',               
 '020':'BILLER CONFIRMED',               
 '021':'ACCOUNT LOCKED',               
 '022':'ACCOUNT SUSPENDED',               
 '023':'API ACCESS NOT ENABLE FOR USER',               
 '024':'ACCOUNT INACTIVE'
 ";
 
 $a = str_replace("\n", "", $a);
$a = str_replace("\r", "", $a);
echo json_encode($a);
?>