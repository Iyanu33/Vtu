<?php

 $sql = "SELECT array_key,value FROM web_config WHERE key_group='image'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	    $webIcon[$row["array_key"]] = $row["value"];
	
	}
} else {
    $infoNotFound=true;
}

?>
