<?php  $sql = "SELECT 
	  var1,
          var2,
          var3,
          var4,
          var5,
          var6,
		  var7
	  FROM third_party_feature WHERE name='monnify_reserved_account'"; $result = $conn->query($sql); if($result->num_rows > 0){ $row = $result->fetch_assoc(); $apiKey = $row["var1"]; $secreteKey = $row["var2"]; $contractCode = $row["var3"]; $fee = $row["var4"]; $feePercentage = $row["var5"]; $active = $row["var6"]; $noKYC = $row["var7"]; } ?>