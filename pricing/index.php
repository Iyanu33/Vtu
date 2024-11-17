<?php include "../include/ini_set.php"?>
<?php include "../include/header.php"?>
 <?php include '../include/data_config.php';?>
<?php include '../include/webconfig.php';?>
<title><?php echo $LANG["pricing"]?></title>
<h4><?php echo $LANG["pricing"]?></h4>
<div class="container">
<div class="row flexbox  ">
<div class="col-sm-6">

<div class="card-panel">
<table class="table table-striped">
<?php
$sql = "SELECT id, fee,fee_capped,max,min,fee_percentage,display_name,image FROM service WHERE active='1' ORDER BY hit DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "<tr>";
	echo '<th colspan="2"><h4 class="valign" style="display:inline"><img class="valign" style="display:inline" width="50px" height="40px" src="../uploads/service/'.$row["image"].'"/> '.$row["display_name"].'</h4></th>';
        echo "</tr>";
        echo "<tr>";
        echo '<td>'.$LANG["fee_charge"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$row["fee"].'</td>';
        
        echo "<tr>";
        echo '<td>'.$LANG["fee_capped_at"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$row["fee_capped"].'</td>';
        echo "</tr>";
        
        echo "</tr>";
        echo $row["fee_percentage"]==1?"<tr>".'<td colspan="2"><b><i><center>'.$LANG["fee_percentage"].'</td>'."</i></b></center></tr>":"";
        if($row["fee_percentage"]==1){
        echo "<tr>";
        echo '<td>'.$LANG["fee_capped_at"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$row["fee_capped"].'</td>';
        echo "</tr>";
        }
        echo "<tr>";
        echo '<td>'.$LANG["max_amount"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$row["max"].'</td>';
        echo "</tr>";
        echo "<tr>";
        echo '<td>'.$LANG["min_amount"].'</td>';
        echo '<td>'.htmlspecialchars_decode($webConfig["currency"]["symbol"]).$row["min"].'</td>';
	echo "</tr>";
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