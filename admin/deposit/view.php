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
checkAccess($adminInfo["deposit"]);
     
?>

<?php
$id= $_GET['id'];
$id = preg_replace("/[^0-9]/", "", "$id");
$sql = "SELECT * FROM deposit WHERE id ='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $amount = $row["amount"];
        $status = ucfirst($row["status"]);
		$iniBalance = $row["ini_balance"];
        $payAmount = $row["pay_amount"];
        $finalBalance = $row["final_balance"];
		$date = date("d-m-Y @ g:ia ",$row["reg_date"]);
		$u =  userInfo($row["owner"],$conn);
		$u = json_decode($u,true);
		$owner = $u["name"];
    }
} else {
     openAlert($LANG['no_transaction_found'].$conn->error);
}
?>

 <title><?php echo $LANG['deposit']; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG['deposit']; ?></p>
              <div class="divider"></div>
              <div class="flexbox">
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel">

<section class="container">
<div class="row py-3 flex-items-sm-center justify-content-center">
<div class="col s12 row">
<h5><?php echo $LANG['transaction_details']; ?></h5>

<table class ="table">


<tr>
   <td>
    <?php echo $LANG['transaction_id']; ?>
   </td>
   <td>
     <?php echo $id?>
   </td>
</tr>



<tr>
   <td>
   <?php echo $LANG['amount']; ?>
   </td>
     <td>
     <?php echo htmlspecialchars_decode($webConfig['currency']["symbol"]); ?><?php echo $amount?>
   </td>
</tr>

 <tr>
   <td>
  <?php echo $LANG['initial_balance']; ?>	
   </td>

     <td>
    <?php echo htmlspecialchars_decode($webConfig['currency']["symbol"]); ?><?php echo $iniBalance; ?>
   </td>
</tr>


 <tr>
   <td>
  <?php echo $LANG['final_balance']; ?>	
   </td>

     <td>
    <?php echo htmlspecialchars_decode($webConfig['currency']["symbol"]); ?><?php echo $finalBalance; ?>
   </td>
</tr>





<tr>
   <td>
  <?php echo $LANG['user_name']; ?>
   </td>
   <td>
     <?php echo $owner?>
   </td>
</tr>

<tr>
   <td>
  <?php echo $LANG['date']; ?>
   </td>
   <td>
     <?php echo $date?>
   </td>
</tr>


<tr>
   <td>
   <?php echo $LANG['status']; ?>
   </td>
   <td>
     <?php echo $status?>
   </td>
</tr>

</table>



</div>



</section>

                     </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
        </section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>