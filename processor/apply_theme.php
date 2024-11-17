<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php include "../include/filter.php"; ?>
<?php
$id = xcape($conn,$_REQUEST["id"]);
$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];

if(empty($id)){
$error = $LANG["theme_cannot_be_empty"];
$title =  $LANG['value_rejected'];
$ready = false;
}

 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";

if($ready){
$sql = "UPDATE mini_config SET value = '$id' WHERE array_key ='systemTheme'";
if ($conn->query($sql) === TRUE) {
    $output['message'] = $LANG['changes_saved_successfully'];
    $output['id'] = $id;
    $output['status']=$LANG["success"];
    $output['title']=$LANG["success"];
    $output['icon'] = "success";
    $output['close'] = true;
    $output['button']=$LANG["okay"];
    $output['reset']=false;
    $output['scroll']=true;
   
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