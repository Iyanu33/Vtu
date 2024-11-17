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
?> <?php include '../../include/data_config.php';?><?php
$service = mysqli_real_escape_string($conn, $service);
$value = mysqli_real_escape_string($conn, $_GET["value"]);
$service = $conn->query("SELECT id, plan_name,display_name,plan_fixed_price FROM service WHERE (name='$service' OR id='$service') AND active='1' AND api='1'")->fetch_assoc();
$serviceID = $service["id"];
$name = $service["display_name"];
$planName = $service["plan_name"];
$sql = "SELECT display_name,value,price FROM plans WHERE service = '$serviceID' AND active='1' AND value='$value'";
  $result = $conn->query($sql);
$n=0;
if ($result->num_rows > 0) {
    $subCategory["service"]=$name;
    $subCategory["PlanName"]=$planName;
    $subCategory["fixedPrice"]=$service["plan_fixed_price"]==1?true:false;
   // output data of each row
    while($row = $result->fetch_assoc()) {
	  $subCategory["plans"][$n]["displayName"] = $row["display_name"];
	  $subCategory["plans"][$n]["value"] = $row["value"];
	  $subCategory["plans"][$n]["price"] = $row["price"];
          $n++;
	}  
} else {
    $infoNotFound=true;
}
print_r(json_encode($subCategory,JSON_PRETTY_PRINT));
?>