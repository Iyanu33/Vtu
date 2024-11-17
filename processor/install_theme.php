<?php include "../include/ini_set.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "../include/filter.php"; ?>
<?php include "../include/copy_folder.php"; ?>
<?php include "../include/delete_folder.php"; ?>
<?php include "../language/{$webConfig["LANG"]}.php"; ?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
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
   $ready = false;  
    $output['message'] = $LANG['an_error_occurred']."@Manifest";
 }

     $id = md5(mt_rand()+time());
     $name = xcape($conn, $manifest["name"]);
     $loc = xcape($conn, $manifest["location"]);
     $img = xcape($conn, $manifest["image"]); 
     $checkTheme = $conn->query("SELECT id FROM theme WHERE name='$name' OR loc =  '$loc'")->num_rows;
     if($checkTheme > 0){
      $output['message'] = $LANG["theme_already_exist"];
       //$ready = false;
     }
     if(empty($name) || empty($loc) || empty($img)){
        $output['message'] = $LANG["an_error_occurred"]."@FILE_NAME_LOCATION_IMAGE";
        $ready = false; 
     }
 if($ready){  
     $insert = $conn->query("INSERT INTO theme (id,name,loc,img)
              VALUES ('$id','$name','$loc','$img')");
     if($insert===TRUE){
      if (!file_exists("../themes/".$manifest["location"])) {
         mkdir("../themes/".$manifest["location"], 0777, true);
      }
         cpy("../temp", "../themes/".$manifest["location"]);
        if(file_exists("../themes/".$manifest["location"]."/manifest.json")){
            unlink("../themes/".$manifest["location"]."/manifest.json");
        }
       
        $output['message'] = $LANG['module_installed_successfully'];
        $output['id'] = $id;
        $output['status']="success";
        $output['title']=$LANG["success"];
        $output['icon'] = "success";
        $output['close'] = false;
        $output['button']=$LANG["okay"];
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
      $output['message']=$LANG["error_in_file_type"].pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
 }
echo json_encode($output);
$conn->close();
rrmdir("../temp");
}
?>