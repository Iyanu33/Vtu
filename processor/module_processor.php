<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../include/filter.php"; ?>
<?php include "../include/copy_folder.php"; ?>
<?php include "../include/delete_folder.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php"; ?>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
$name = xcape($conn,$_POST["name"]);
$code = xcape($conn,$_POST["code"]);
$symbol = xcape($conn,$_POST["symbol"]);
$rate = xcape($conn,$_POST["rate"]);
$active = xcape($conn,$_POST["active"]);
$id = md5(mt_rand());

$ready = true;
$error = $LANG["unknown_error"];
$title = $LANG["an_error_occurred"];

 $output['message'] = $error;
 $output['status'] = 'error';
 $output['title'] = $title;
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";

 if(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION)=="zip"){
$zipFile = $_FILES["file"]["tmp_name"];
if(!file_exists("../temp")){
    mkdir("../temp");
}
$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    $zip->extractTo('../temp');
    $zip->close();
}  else {
    $ready = false;
    $output['message'] = $LANG['an_error_occurred']."@Zip";
}



 $manifest = json_decode(file_get_contents("../temp/manifest.json"),true);
 unlink("../temp/manifest.json");
 if(!is_array($manifest)){
   $ready == false;  
    $output['message'] = $LANG['an_error_occurred']."@Manifest";
 }
    
 if($ready){   
     include '../temp/sql.php';  
    if(!$sqlError === true){
        unlink('../temp/sql.php');
       if($manifest["type"]=="language"){
           file_put_contents("../language/".$manifest["file"],file_get_contents("../temp/".$manifest["file"]));
          $output['link']="language/edit.php?id=$id&new=true";
          $output['new'] = true;
           
       }elseif($manifest["type"]=="payment"){
           if (!file_exists("../paymentgateway/".$manifest["file"])) {
           mkdir("../paymentgateway/".$manifest["file"], 0777, true);
         }
             cpy("../temp", "../paymentgateway/".$manifest["file"]);
        
       }
       
        $output['message'] = $LANG['module_installed_successfully'];
        $output['id'] = $id;
        $output['status']=$LANG["success"];
        $output['title']=$LANG["success"];
        $output['icon'] = "success";
        $output['close'] = false;
        $output['button']=$LANG["continue"];
} else {
        $output['message']=$conn->error;
        $output['title']=$LANG["not_successful"];
        $output['status']="error";
        $output['button']=$LANG["okay"];
        $output['close'] = true;
        $output['icon'] = "error";
}
}
 }else{
      $output['message']=$LANG["error_in_file_type"];
 }
echo json_encode($output);
$conn->close();
rrmdir("../temp");
}
?>