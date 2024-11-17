 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/webconfig.php';?>
 <?php include '../include/header.php';?>
 <?php include '../../account/userinfojson.php';?>

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["payment"]) 
?>




<?php
$sql = "SELECT id, display_name FROM service ";
 
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	      	$serviceValue[$row['id']]=$row['display_name'];		
		}
	  }else{
		$serviceValue["notFound"] = true;
	  }
	//print_r($serviceValue);
?>





<title>
<?php echo $LANG["online_payment"]; ?>
</title>
  
<div class="container pl-sm-5">
<div class="row flex-items-sm-center justify-content-center">

<div class="col s12">
    <div class="card-panel">
<h4><?php echo $LANG["purchase"]; ?> </h4>
<div class="col s12">
    <a class="right"  href="purchase.php"><?php echo $LANG["view_all"]?></a>
</div>
<table class="table table-striped">
 <?php

$i=1;
$sql = "SELECT * FROM guest_payment ORDER BY reg_date DESC LIMIT 6 ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {?>
<tr>
	<th>#</th>
	<th><?php echo $LANG["transaction_id"]?></th>
	<th><?php echo $LANG["amount"]?></th>
	<th><?php echo $LANG["date"]?></th>
	<th><?php echo $LANG["service"]?></th>
	<th><?php echo $LANG["status"]?></th>
	<th colspan="2"><?php echo $LANG["action"]?></th>
</tr>
<?php

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
    
	$date = date("d-m-Y @ g:ia ",$row["reg_date"]);	
	$serviceID  = $conn->query("SELECT service_id FROM recharge WHERE id='{$row["transaction_id"]}' ")->fetch_assoc()["service_id"];
	
	$gatewayResponse= !empty($row["gateway_response"])?$row["gateway_response"]:$LANG["none"];
	echo "<tr>";
	echo '<td>'.$i++.'</td>';
	echo '<td>'.$row["id"].'</td>';
	echo '<td>'.$row["amount"].'</td>';
	echo '<td>'.$date.'</td>';
	echo '<td>'.$serviceValue[$serviceID].'</td>';
	echo '<td>'.$LANG[$row["status"]].'</td>';
	echo '<td><center><a data-position="left" data-tooltip="'.$gatewayResponse.'" class="tooltipped"  href="javaScript:void(0)"><i class="material-icons">visibility</i></a> </center></td>';
	echo "</tr>";
	
}
}else{
	echo $LANG["no_transaction_found"];
} 
?>
</table>
</div>
</div>

</div>
</div>

<div class="container pl-sm-5">
<div class="row flex-items-sm-center justify-content-center">

<div class="col s12 row">
<div class="card-panel">
<div class="col-6">
<h4><?php echo $LANG["wallet_funding"]?></h4>
</div>

    
 <div class="col-12">
     <a  class="right" href="funding.php"><?php echo $LANG["view_all"]?></a>
</div>
<table class="table table-striped">
 <?php
$i=1;
$sql = "SELECT * FROM payment ORDER BY reg_date DESC LIMIT 6";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>
<tr>
	<th>#</th>
	<th><?php echo $LANG["transaction_id"]?></th>
	<th><?php echo $LANG["amount"]?></th>
	<th><?php echo $LANG["date"]?></th>
	<th><?php echo $LANG["name"]?></th>
	<th><?php echo $LANG["status"]?></th>
	<th colspan="2"><?php echo $LANG["action"]?></th>
</tr>
<?php
	 $totalQuery = $result->num_rows;
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
	$gatewayResponse= !empty($row["gateway_response"])?$row["gateway_response"]:$LANG["none"];
	$date = date("d-m-Y @ g:ia ",$row["reg_date"]);
	$u =  userInfo($row["owner"],$conn);
        $u = json_decode($u,true);
	$owner = $u["name"];
	$ownerId = $u["id"];
	$phone = $u["phone"];
	$email = $u["email"];	
        
	echo '<td>'.$i++.'</td>';
	echo '<td>'.$row["id"].'</td>';
	echo '<td>'.$row["amount"].'</td>';
	echo '<td>'.$date.'</td>';
	echo '<td>'.$owner.'</td>';
	echo '<td>'.$LANG[$row["status"]].'</td>';
	echo '<td><center><a data-position="left" data-tooltip="'.$gatewayResponse.'" class="tooltipped"  href="javaScript:void(0)"><i class="material-icons">visibility</i></a> </center></td>';
        echo "</tr>";

}
}else{
	echo $LANG["no_transaction_found"];
} 
?>
</table>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
<?php include '../include/footer.php';?>