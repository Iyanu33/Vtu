<?php

 $sql = "SELECT array_key,value FROM mini_config";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	    $miniConfig[$row["array_key"]] = $row["value"];
	
	}
} else {
    $infoNotFound=true;
}

$GLOBALS["miniConfig"] = $miniConfig;
?>