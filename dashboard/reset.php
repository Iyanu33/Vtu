<?php include '../include/ini_set.php';?> 
<?php include '../include/checklogin.php';?> 
<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>


<?php
$key = xcape($conn,$_GET["key"]);


$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];

      if($key=="api"){
        $api = time()+mt_rand();
	$api = base64_encode($api);
	$code = "ap_".md5($api);
        $keyName =  "api";
       }elseif ($key=="widget") {
	$widget= time()+mt_rand();
	$widget= base64_encode($widget);
	$code= "wd_".md5($widget);
        $keyName = "widget";
       }elseif($key=="link"){
	$code = time()+mt_rand();
        $keyName = "refer_code";
       }else{ 
           $error = $LANG['value_rejected'];
          $title = $LANG["an_error_occurred"];
          $ready=false;
    
}


 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";

if($ready){
$sql = "UPDATE users SET
        $keyName =  '$code' 
        WHERE id ='$loginUser'
        ";

if ($conn->query($sql) === TRUE) {
	    $output['message'] = $LANG['changes_saved_successfully'];
    	$output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = false;
		$output['new'] = true;
		$output['button']=$LANG["continue"];
		$output['link']="";
   
} else {
	    $output['message']=$conn->error;
	    $output['title']=$LANG["not_successful"];
		$output['status']="error";
		$output['button']=$LANG["okay"];
		$output['close'] = true;
		$output['icon'] = "error";
}
}
echo json_encode($output);
$conn->close();
?>
