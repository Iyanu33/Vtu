<?php session_start();?>
<?php include '../include/ini_set.php';?>
<?php include '../include/data_config.php';?>
<?php include '../include/filter.php';?>
<?php include '../include/webconfig.php';?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") { $serviceId = xcape($conn, $_POST['systemService']); $user = $_SESSION["login_user"]; if(empty($user) && !empty($_COOKIE["uKey"])){ $user = mysqli_real_escape_string($conn,$_COOKIE['uKey']); } $sql = "SELECT email_name,amount_name,phone_name FROM service WHERE id='$serviceId' OR name='$serviceId'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } $amount = xcape($conn,$_POST[$serviceValue['amount_name']]); $phone = xcape($conn,$_POST[$serviceValue['phone_name']]); $email = xcape($conn,$_POST[$serviceValue['email_name']]); $id = mt_rand()+time(); $status = "pending"; $regDate = time(); $goReady=1; $error = ""; $transactionValue = json_encode($_POST); if($goReady==1){ $sql = "INSERT INTO recharge (
		id, 
		service_id,
		transaction_value,
		amount,
		phone,
		email,
		reg_date,
		status,
                user
		 )
		VALUES (
		'$id', 
		'$serviceId',
		'$transactionValue',
		'$amount',
		'$phone',
		'$email',
		'$regDate',
		'$status',
                '$user'
		)"; $conn->query($sql); javaScriptRedirect("confirm.php?id=$id"); } } ?>