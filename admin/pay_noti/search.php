 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/webconfig.php';?>
 <?php include '../include/header.php';?>
 <?php include '../../account/userinfojson.php';?>
 <?php include '../../include/pagination.php'; $page = new pagination($conn);?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["payment"]);
?>

<?php $q = xcape($conn, $_GET["q"]);?>
      
   
<title>
<?php echo $LANG['payment_notification']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h4><?php echo $LANG["payment_notification"]; ?> </h4>
<?php echo $LANG['the_below_table_contains_transaction_history_of_all_wallet_funding_by_admin']; ?>

			  
			  
			  
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM pay_noti WHERE id='$q' OR amount='$q' OR status='$q'")->num_rows;
$page->searchForm($action,$q);
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

$sql = "SELECT id,amount,status,reg_date,owner FROM pay_noti WHERE id='$q' OR amount='$q' OR status='$q' ORDER  BY reg_date DESC LIMIT $start,$stop ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">




<table class="bordered ">
<tr>
    <th>#</th>
        <th ><?php echo $LANG['transaction_id']; ?></th>
	<th><?php echo $LANG["amount"]; ?></th>
        <th><?php echo $LANG["date"]; ?></th>
        <th><?php echo $LANG["name"]; ?></th>
         <th><?php echo $LANG["settled"]; ?></th>
         <th><?php echo $LANG["action"]; ?></th>
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
    
    $date = date("d-m-Y @ g:ia ",$row["reg_date"]);
	$u =  userInfo($row["owner"],$conn);
    $u = json_decode($u,true);
	$owner = $u["name"];
	$ownerId = $u["id"];
	$phone = $u["phone"];
	$email = $u["email"];
       	echo "<tr>";
	echo '<td class="hide-on-med-and-down" >'.$i++.'</td>';
	echo '<td class="hide-on-med-and-down" >'.$row["id"].'</td>';
	echo '<td>'.$row["amount"].'</td>';
	echo '<td class="hide-on-med-and-down" >'.$date.'</td>';
	echo '<td>'.$owner.'</td>';
	echo '<td>'.strtoupper($LANG[$row["status"]]).'</td>';
	echo '<td><center><a class="tooltipped" data-position="left" data-tooltip="'.$LANG["view_or_settle_transaction"].'"  href="view.php?id='.$row["id"].'"><i class="material-icons">visibility</i> </a> </center></td>';
	echo "</tr>";
    
    
    
    
    
    
	
} 
}else {
    echo ($LANG['no_transaction_found']);
    openAlert($LANG['no_transaction_found']);
}
?>
</table>
</div>

    <?php $page->getPage($currentPage, $totalQuery,$q)?>

</div>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>




<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>

