<?php include "../../include/checklogin.php"; ?>
<?php include "../../include/ini_set.php"; ?>
<?php include "../../include/data_config.php"; ?>
<?php include "../../include/filter.php"; ?>
<?php include "../../language/{$webConfig["LANG"]}.php"; ?>
<?php
$firstName = xcape($conn,$_POST["firstName"]); $lastName = xcape($conn,$_POST["lastName"]); $middlName = xcape($conn,$_POST["middleName"]); $bvn = xcape($conn,$_POST["bvn"]); $submitted = xcape($conn,$_POST["submitted"]); $birthDay = xcape($conn,$_POST["birthDay"]); $birthMonth = xcape($conn,$_POST["birthMonth"]); $birthYear = xcape($conn,$_POST["birthYear"]); $birthDate = "$birthDay-$birthMonth-$birthYear"; $birthDate = strtotime($birthDate); $id = md5(mt_rand().time()); $ready = true; $error = $LANG["unknown_error"]; $title = $LANG["an_error_occurred"]; $output['message'] = $error; $output['status'] = 'error'; $output['title'] = $title; $output['button']=$LANG["okay"]; $output['close'] = true; $output['icon'] = "error"; if($ready){ $result = $conn->query("SELECT id FROM reserved_account WHERE owner='$loginUser'"); if($result->num_rows == 0){ $conn->query("INSERT INTO reserved_account (id,owner) VALUES ('$id','$loginUser')"); } $sql = "UPDATE reserved_account SET
         first_name = '$firstName',
         last_name = '$lastName',
         middle_name = '$middlName',
         bvn =  '$bvn',
         submitted =  '$submitted',
         date_of_birth = '$birthDate'
         WHERE owner = '$loginUser' AND verified <> '1'
         "; if ($conn->query($sql) === TRUE) { $output['message'] = $LANG['success']; $output['id'] = $id; $output['status']="success"; $output['title']=$LANG["success"]; $output['icon'] = "success"; $output['close'] = false; $output['new'] = false; $output['button']=$LANG["okay"]; } else { $output['message']= $LANG["error_in_updating_record"]; $output['title']=$LANG["not_successful"]; $output['status']="error"; $output['button']=$LANG["okay"]; $output['close'] = true; $output['icon'] = "error"; } } echo json_encode($output); $conn->close(); ?>