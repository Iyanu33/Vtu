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
$service = $conn->query("SELECT id,display_name FROM service WHERE (name='$service' OR id='$service') AND active='1' AND api='1'")->fetch_assoc();
$serviceID = $service["id"];
$name = $service["display_name"];
$sql = "SELECT * FROM form WHERE service = '$serviceID' AND type <> 'header' AND type <> 'server' AND type <> 'curl_param' AND type<>'hidden' ORDER BY display_name";
  $result = $conn->query($sql);
$n=0;
if ($result->num_rows > 0) {
    $subCategory["service"]=$name;
   // output data of each row
    while($row = $result->fetch_assoc()) {
	  $subCategory["field"][$n]["displayName"] = $row["display_name"];
	  $subCategory["field"][$n]["name"] = $row["name"];
	  $subCategory["field"][$n]["type"] = $row["type"];
	  $subCategory["field"][$n]["description"] = $row["description"];
	  $subCategory["field"][$n]["regExp"] = $row["regx"];
          $subCategory["field"][$n]["required"]=$row["required"]==1?true:false;
          $n++;
	}  
} else {
    $infoNotFound=true;
}
print_r(json_encode($subCategory,JSON_PRETTY_PRINT));
?>