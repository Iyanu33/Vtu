	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$firstName = xcape($conn, $_POST['firstname']);
	$lastName = xcape($conn, $_POST['lastname']);
	$name = xcape($conn, $_POST['name']);
	$email = xcape($conn, $_POST['email']);
	$phone = xcape($conn, $_POST['phone']);
	$message = xcape($conn, $_POST['message']);
	$ip = get_client_ip();

	$regDate = time(); 
	$prc = 1;
	$id = md5(mt_rand());
	
	if(empty($firstName)){
	 $firstNameError ='<strong class="text-danger right"><small>'.$LANG["please_provide_your_first_name"].'</small></strong>';
	 $prc = 0;
	 }if(empty($lastName)){
	 $lastNameError='<strong class="text-danger right"><small>'.$LANG["please_provide_your_last_name"].'</small></strong>';
	 $prc=0;
	 } if(empty($email)){
	 $emailError ='<strong class="text-danger right"><small>'.$LANG["email_is_empty"].'</small></strong>';
	 $prc=0;
	 } if(empty($phone)){
	 $phoneError ='<strong class="text-danger right"><small>'.$LANG["please_provide_your_phone_number"].'</small></strong>';
	 $prc=0;
	 }
	 if(empty($message)){
	 $messageError ='<strong class="text-danger right"><small>'.$LANG["please_provide_your_massage"].'</small></strong>';
	 $prc=0;
	 }
	 
	 
	 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$prc= 0;
		    $emailError ='<strong class="text-danger right"><small>'.$LANG["invalid_email"].'</small></strong>';
		}
	
	 if($prc ==1){
	   
	
    
	$sql = "INSERT INTO feedback (
		id, 
		firstname,
		lastname,
		email,
		phone, 
		reg_date,
		message,
		ip
	)
   VALUES (
	   '$id',
	   '$firstName',
	   '$lastName', 
	   '$email',
	   '$phone', 
	   '$regDate',
	   '$message',
	   '$ip'
   )";

	 if ($conn->query($sql) === TRUE) {
             alertSuccess($LANG["mail_sent_successfully"]);
     }  else {
         alertDanger($LANG["operation_failed"]);
     }
 }
 }
?>