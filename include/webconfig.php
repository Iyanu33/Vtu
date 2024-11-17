<?php
 $sql = "SELECT array_key,value FROM web_config";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	    $webConfig[$row["array_key"]] = $row["value"];
	
	}
} else {
    $infoNotFound=true;
}
 $webConfig["SMS_debugMode"]=$conn->query("SELECT value FROM mini_config WHERE array_key='SMS_debugMode'")->fetch_assoc()["value"];
 $webConfig["email_debug_mode"]=$conn->query("SELECT value FROM mini_config WHERE array_key='email_debug_mode'")->fetch_assoc()["value"];
?>
<?php
$systemCurrencyId = $webConfig["currency"];
 $sql = "SELECT * FROM currency WHERE id ='$systemCurrencyId'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
$webConfig["currency"] = $result->fetch_assoc();
}
$GLOBALS["webConfig"] = $webConfig;
?>