 <?php include '../include/ini_set.php';?>
 <?php include '../include/checklogin.php';?>
 <?php include '../dashboard/include/header.php';?>
 <?php include '../include/filter.php';?>
 <?php include '../include/pagination.php'; $page = new pagination($conn);?>


<?php $q = xcape($conn,$_GET["q"]);?>
 

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
<?php echo $LANG['transaction_history']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h4><?php echo $LANG["transactions"]; ?> </h4>

			  
			  
			  
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM recharge WHERE (id='$q' OR status ='$q' OR phone ='$q' OR amount ='$q' OR email ='$q' OR payment_method='$q') AND  user='$loginUser'")->num_rows;
$page->searchForm($action,$q);
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

$sql = "SELECT service_id,id,payment_method,amount,status FROM recharge WHERE (id='$q' OR status ='$q' OR phone ='$q' OR amount ='$q' OR email ='$q' OR payment_method='$q') AND user='$loginUser' LIMIT $start,$stop";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">




<table class="bordered ">
<tr>
    <th class="hide-on-med-and-down">#</th>
        <th class="hide-on-med-and-down" ><?php echo $LANG['transaction_id']; ?></th>
	<th><?php echo $LANG["service"]; ?></th>
	<th><?php echo $LANG["amount"]; ?></th>
	<th><?php echo $LANG["status"]; ?></th>
        <th class="hide-on-med-and-down" colspan="2"><?php echo $LANG["payment_method"]; ?></th>
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
    
    $method = $LANG[strtolower($row["payment_method"])];
      if(empty($method)){
          $method = $LANG["none"];
    }
	
    echo "<tr>";
    echo '<td class="hide-on-med-and-down" >'.$i++.'</td>';
    echo '<td class="hide-on-med-and-down">'.$row["id"].'</td>';
    echo '<td>'.$serviceValue[$row["service_id"]].'</td>';
    echo '<td>'.$row["amount"].'</td>';
    echo '<td>'.$LANG[$row["status"]].'</td>';
    echo '<td class="hide-on-med-and-down"><center>'.$method.'</center></td>';
    echo '<td><center><a target="_blank" href="view.php?id='.$row["id"].'"><i class="material-icons">visibility<i> </a> </center></td>';
    echo "</tr>";
	
} 
}else {
    echo $LANG['no_transaction_found'];
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

</div>
 <?php include '../dashboard/include/footer.php';?>

