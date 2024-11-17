<?php  $category = $_GET["category"]; ?><?php 
// Custom variables
$variables = array('#CCC','#800'); // from db
// CSS Content
header('Content-type: application/json');
// Last Modified
$lastModified = filemtime(__FILE__);
// Get a unique hash of this file (etag)
$etagFile = md5_file(__FILE__);
// Get the HTTP_IF_MODIFIED_SINCE header if set
$ifModifiedSince = (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
// Get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
$etagHeader = (isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);
// Set last-modified header
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
// Set etag-header
header("Etag: $etagFile");
// Make sure caching is turned on
header('Cache-Control: public');
// Check if page has changed. If not, send 304 and exit
if(@strtotime($ifModifiedSince) == $lastModified || $etagHeader == $etagFile){
   header("HTTP/1.1 304 Not Modified");
 //  exit;
}
?> <?php include '../../include/data_config.php';?><?php
$category = mysqli_real_escape_string($conn, $category);
$category = $conn->query("SELECT id FROM category WHERE (name='$category' OR id='$category') AND active='1'")->fetch_assoc()["id"];
$webLink = $conn->query("SELECT value FROM web_config WHERE array_key='webLink'")->fetch_assoc()["value"];
$sql = "SELECT name, display_name , plan_name, min, max, image, fee, fee_percentage, fee_capped FROM service  WHERE category = '$category' AND active='1' AND api='1' ORDER BY display_name";
  $result = $conn->query($sql);
$n=0;
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	  $subCategory[$n]["displayName"] = $row["display_name"];
	  $subCategory[$n]["name"] = $row["name"];
          if(!empty($row["image"])){
	  $subCategory[$n]["image"] = "//$webLink/uploads/service/".$row["image"];
          }
	  $subCategory[$n]["max"] = $row["max"];
	  $subCategory[$n]["min"] = $row["min"];
	  $subCategory[$n]["fee"] = $row["fee"];
          if(!empty($row["plan_name"])){
	  $subCategory[$n]["planName"] = $row["plan_name"];
          }
	  $subCategory[$n]["feePercentage"] = $row["fee_percentage"] == 1?true:false;
	  $subCategory[$n]["feeCapped"] = $row["fee_capped"];
          $n++;
	}  
} else {
    $infoNotFound=true;
}
print_r(json_encode($subCategory,JSON_PRETTY_PRINT));
?>