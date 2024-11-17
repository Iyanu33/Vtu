 <?php include '../include/ini_set.php';?>
 <?php include '../include/checklogin.php';?>
 <?php include '../dashboard/include/header.php';?>
 <?php include '../include/filter.php';?>
 <?php include '../include/pagination.php'; $page = new pagination($conn);?>



<title>
<?php echo $LANG['payout_request']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
                <p class="left"><?php echo $LANG["payout_request"]; ?> </p> 
                <a href="payout_request.php" class="right bold"><?php echo $LANG["new_request"]?></a>
                


			  
			  
			  
              <div class="divider clearfix"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM payout_request WHERE  user='$loginUser'")->num_rows;
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];
//refresh
$sql = "SELECT reg_date,settled,id,amount FROM payout_request WHERE user='$loginUser' LIMIT $start,$stop";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">




<table class="bordered ">
<tr>
    <th class="hide-on-med-and-down">#</th>
        <th class="hide-on-med-and-down" ><?php echo $LANG['transaction_id']; ?></th>
	<th><?php echo $LANG["amount"]; ?></th>
	<th><?php echo $LANG["settled"]; ?></th>
        <th  colspan="2"><?php echo $LANG["date"]; ?></th>
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
   $settled = $row["settled"]==1?"yes":"no";
    echo "<tr>";
    echo '<td class="hide-on-med-and-down" >'.$i++.'</td>';
    echo '<td class="hide-on-med-and-down">'.$row["id"].'</td>';
    echo '<td>'.$row["amount"].'</td>';
    echo '<td>'.$LANG[$settled].'</td>';
    echo '<td >'.date("d-m-Y",$row["reg_date"]).'</td>';
     echo "</tr>";
	
} 
}else {
    echo ($LANG['no_transaction_found']);
   openAlert($LANG['no_transaction_found']);
}
?>
</table>
</div>

    <?php $page->getPage($currentPage, $totalQuery)?>

</div>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>

</div>
 <?php include '../dashboard/include/footer.php';?>

