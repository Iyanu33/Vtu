<?php include "../../include/checklogin.php"; ?>
<?php include "../../include/ini_set.php"; ?>
<?php include "../../include/data_config.php"; ?>
<?php include "../../include/filter.php"; ?>
<?php include "../../language/{$webConfig["LANG"]}.php"; ?>
    <?php
 if($_SERVER["REQUEST_METHOD"]=="POST") { 
     $bytes = mt_rand();
     $cardNumber = xcape($conn, $_POST["cardNumber"]);
     $cardType = xcape($conn, $_POST["cardType"]);
     $submitted = xcape($conn, $_POST["submitted"]); 
     $utime = time(); $pname = $bytes.$utime; $target_dir = "../card/"; $uploadOk = 1; 
    $imageFileType = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
    $imageFileType= strtolower($imageFileType);
    $filename = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_FILENAME); 
    $target_file = $target_dir.$bytes.'.'.$imageFileType; 
    $dbdir = $bytes.'.'.$imageFileType;
    $id = md5(mt_rand().time());
    $error = $LANG["unknown_error"]; $title = $LANG["an_error_occurred"];
    $output['message'] = $error; $output['status'] = 'error'; 
    $output['title'] = $title; $output['button']=$LANG["okay"];
    $output['close'] = true; $output['icon'] = "error"; 
    clearstatcache(); 
    if (empty( $_FILES["fileToUpload"]["name"])){
        $output['message'] = $LANG["please_select_an_image"]; 
        $uploadOk = 0; $fmsg=="1";
        } else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $output['message'] =$LANG["sorry_only_JPG_JPEG_PNG_GIF_files_are_allowed"]; $uploadOk = 0; $fmsg=="1";
            } else if ($_FILES["fileToUpload"]["size"] > 900000) {
                $output['message'] = $LANG["sorry_your_image_is_too_large_please_note_you_can_not_upload_an_image_that_is_more_900kb"];
                $uploadOk = 0; $fmsg=="1"; } else if ($uploadOk == 0 && $fmsg=="") { 
                    $output['message'] = $LANG["there_was_an_error_uploading_your_file"];
                    } else { if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $result = $conn->query("SELECT id FROM reserved_account WHERE owner='$loginUser'");
                        if($result->num_rows == 0){ $conn->query("INSERT INTO reserved_account (id,owner) VALUES ('$id','$loginUser')"); } 
                        $sql = "SELECT card_path FROM reserved_account WHERE owner='$loginUser'"; 
                        $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {
                        $file = '../card/'.$row["card_path"];
                        unlink($file); 
                        }
                        }
                        $sql = "UPDATE  reserved_account SET card_path = '$dbdir', card_type='$cardType', card_number ='$cardNumber', submitted='$submitted'  WHERE owner='$loginUser' AND verified <> '1'"; 
                        if ($conn->query($sql)===true) { $output['message'] = $LANG["changes_saved_successfully"];
                        $output['id'] = $id; $output['status']="success"; $output['title']=$LANG["success"]; 
                        $output['icon'] = "success"; 
                        $output['close'] = false; 
                        $output['new'] = false;
                        $output['button']=$LANG["okay"];
                        } else {
                        $output['message'] = $LANG["there_was_an_error_uploading_your_file"]; 
                        $output['title']=$LANG["not_successful"]; 
                        $output['status']="error"; 
                        $output['button']=$LANG["okay"]; 
                        $output['close'] = true; $output['icon'] = "error";
                        } 
                        
                        } 
                        
                        } 
                        
                        } 
                        echo json_encode($output);
                        $conn->close(); ?>