<?php include "../include/ini_set.php"?>
<?php include "../include/header.php"?>
 <?php include '../include/data_config.php';?>
<?php include '../include/webconfig.php';?>
<?php include '../include/filter.php';?>
<title><?php echo $LANG["commission_rate_discount"]?></title>
<h4><?php echo $LANG["commission_rate_discount"]?></h4>
<div class="container">
<div class="row flexbox  ">
<div class="col-sm-6">
  <?php 
  if($GLOBALS["webConfig"]["referalEnable"]!=1 && $GLOBALS["webConfig"]["discountEnable"]!=1){
      javaScriptRedirect("../index.php");
    exit;
  }
  ?>
    
<div class="card-panel">
<table class="table table-striped">
<?php
$sql = "SELECT id,display_name,image FROM service WHERE active='1' ORDER BY hit DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $rate = $conn->query("SELECT * FROM commission_rate WHERE service='{$row["id"]}'")->fetch_assoc();
       	echo "<tr>";
	echo '<th colspan="3"><h4 class="valign" style="display:inline"><img class="valign" style="display:inline" width="50px" height="40px" src="../uploads/service/'.$row["image"].'"/> '.$row["display_name"].'</h4></th>';
        echo "</tr>";
        echo "<tr>";
	echo "<tr>";
        echo '<td>'.$LANG["users"].'</td>';
        echo '<td>'.$LANG["rate"].'</td>';
        echo '<td>'.$LANG["in_percentage"].'</td>';
        echo "</tr>";
        if($GLOBALS["webConfig"]["discountEnable"]==1){
	echo "<tr>";
        echo '<td>'.$LANG["unregistered_user"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$rate["unregistered_user"].'</td>';
        echo $rate['unregistered_user_percentage']==1?'<td>'.$LANG["yes"].'</td>':'<td>'.$LANG["no"].'</td>';
        echo "</tr>";
        
	echo "<tr>";
        echo '<td>'.$LANG["registered_user"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$rate["registered_user"].'</td>';
        echo $rate['registered_user_percentage']==1?'<td>'.$LANG["yes"].'</td>':'<td>'.$LANG["no"].'</td>';
        echo "</tr>";
        
	echo "<tr>";
        echo '<td>'.$LANG["api_user"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$rate["api_user"].'</td>';
        echo $rate['api_user_percentage']==1?'<td>'.$LANG["yes"].'</td>':'<td>'.$LANG["no"].'</td>';
        echo "</tr>";
        }
         if($webConfig["referralEnable"]==1){
        echo "<tr>";
        echo '<td>'.$LANG["referrer_earns"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$rate["referrer_user"].'</td>';
        echo $rate['referrer_user_percentage']==1?'<td>'.$LANG["yes"].'</td>':'<td>'.$LANG["no"].'</td>';
        echo "</tr>";
        }
    }
} 

?>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
    

<?php include "../include/footer.php"?>