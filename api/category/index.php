<?php
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
   exit;
}
?> 
<?php include '../../include/data_config.php';?>
<?php 
$sql = "SELECT name, display_name,icon FROM category WHERE active='1'";
  $result = $conn->query($sql);
$n=0;
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	  $category[$n]["displayName"] = $row["display_name"];
	  $category[$n]["name"] = $row["name"];
          if(!empty($row["icon"])){
	  $category[$n]["image"] = "//$webLink/uploads/".$row["icon"];
          }
          $n++;
	}  
} else {
    $infoNotFound=true;
}
print_r(json_encode($category,JSON_PRETTY_PRINT));
?>