<?php header('Content-Type: application/json');?>
<?php include '../include/ini_set.php';?>
<?php include '../include/data_config.php';?>
<?php include '../include/miniconfig.php';?>
<?php include '../include/filter.php';?>
<?php include '../api/getAuth.php';?>
<?php  use PHPMailer\PHPMailer\PHPMailer; use PHPMailer\PHPMailer\Exception; ?>
<?php  $webConfig = $conn->query("SELECT value FROM web_config WHERE array_key='webName' OR array_key='supportEmail' OR array_key='repyTo'")->fetch_assoc(); function sendMail($to,$message,$subject="",$senderName="",$replyTo=""){ require '../PHPMailer/src/Exception.php'; require '../PHPMailer/src/PHPMailer.php'; require '../PHPMailer/src/SMTP.php'; $debugNum = 0; if($GLOBALS["miniConfig"]['email_debug_mode']==1){ echo "<pre>---PHPMailer-----"; $debugNum = 2; } $mail=new PHPMailer(); $mail->CharSet = 'UTF-8'; $mail->IsSMTP(); $mail->Host = $GLOBALS["miniConfig"]['emailHost']; $mail->Port = $GLOBALS["miniConfig"]['emailPort']; $mail->SMTPDebug = $debugNum; $mail->SMTPAuth = true; $mail->SMTPSecure = $GLOBALS["miniConfig"]['emailSMTPSecure']; $mail->Username = "{$GLOBALS["miniConfig"]['email_username']}"; $mail->Password = "{$GLOBALS["miniConfig"]['email_password']}"; $mail->SetFrom($GLOBALS["miniConfig"]['email_SetFrom'], $GLOBALS["miniConfig"]["email_senderName"]); $mail->AddReplyTo($GLOBALS["miniConfig"]["emailReplyTo"],$GLOBALS["miniConfig"]['email_senderName']); $mail->Subject = $subject; $mail->MsgHTML($message); $mail->AddAddress($to); $mail->send(); } ?>
<?php
$response; if ($_SERVER["REQUEST_METHOD"] == "POST") { $api = getBearerToken(); $to = $_POST["to"]; $replyTo = $_POST["replyTo"]; $senderName = $_POST["senderName"]; $message = $_POST["message"]; $subject = $_POST["subject"]; if($GLOBALS["miniConfig"]['email_debug_mode']==1){ echo "<br/><br/>{$GLOBALS["LANG"]["http_post_value"]}"; print_r($_POST); } if(empty($api)){ $response["code"] = "011"; $response["content"]["description"] = "INVALID ARGUMENTS API IS EMPTY"; }else{ $token = $conn->query("SELECT value FROM web_config WHERE array_key='licencesToken'")->fetch_assoc()["value"]; if ($token==$api) { if($miniConfig["useMailFunction"]=='1'){ $sender = empty($GLOBALS["miniConfig"]['email_SetFrom'])?$webConfig["supportEmail"]:$GLOBALS["miniConfig"]['email_SetFrom']; $senderName = empty($GLOBALS["miniConfig"]["email_senderName"])?$webConfig["webName"]:$GLOBALS["miniConfig"]["email_senderName"]; $replyTo = empty($GLOBALS["miniConfig"]["emailReplyTo"])?$webConfig["repyTo"]:$GLOBALS["miniConfig"]["emailReplyTo"]; $headers = "MIME-Version: 1.0" . "\r\n"; $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; $headers .= "From: $senderName <$sender>" . "\r\n"; $headers .= "Reply-To: $senderName <$replyTo>" . "\r\n"; mail($to,$subject,$message,$headers); $response["code"] = "000"; $response["content"]["description"] = "SENT"; }else{ sendMail($to,$message,$subject,$senderName,$replyTo); $response["code"] = "000"; $response["content"]["description"] = "SENT"; } } else { $response["code"] = "023"; $response["content"]["description"] = "INVALID API $token $api"; } } }else{ $response["code"] = "025"; $response["content"]["description"] = "REQUEST METHOD NOT POST"; } echo json_encode($response,JSON_PRETTY_PRINT); ?>