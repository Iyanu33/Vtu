<?php  $service = $_GET["service"]; ?><?php 
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
?><?php include '../../include/data_config.php';?><?php
$service = mysqli_real_escape_string($conn, $service);
$webLink = $conn->query("SELECT value FROM web_config WHERE array_key='webLink'")->fetch_assoc()["value"];
$sql = "SELECT name, display_name , plan_name, min, max, image, fee, fee_percentage, fee_capped FROM service  WHERE (name = '$service' OR id='$service') AND active='1' AND api='1'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	  $subCategory["displayName"] = $row["display_name"];
	  $subCategory["name"] = $row["name"];
          if(!empty($row["image"])){
	  $subCategory["image"] = "//$webLink/uploads/service/".$row["image"];
          }
          if(!empty($row["plan_name"])){
	  $subCategory["planName"] = $row["plan_name"];
          }
	  $subCategory["max"] = $row["max"];
	  $subCategory["min"] = $row["min"];
	  $subCategory["fee"] = $row["fee"];
	  $subCategory["feePercentage"] = $row["fee_percentage"] == 1?true:false;
	  $subCategory["feeCapped"] = $row["fee_capped"];
	}  
} else {
    $infoNotFound=true;
}
print_r(json_encode($subCategory,JSON_PRETTY_PRINT));
?>