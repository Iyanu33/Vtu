 <?php include "../include/ini_set.php" ;?>
<?php
include '../include/checklogin.php';

include '../include/data_config.php';
?>
<?php include '../account/userinfojson.php';?>
<?php include '../include/filter.php';?>
<?php 
if(empty($_SESSION["login_user"])){
include '../include/header.php';
}else{
 include '../dashboard/include/header.php';   
}
?>
<?php
$id= xcape($conn,$_GET['id']);
$sql = "SELECT * FROM payment WHERE id ='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $amount = $row["amount"];
        $phone = $row["phone"];
        $serviceId = $row["service_id"];
        $email = $row["email"];
        $status = $row["status"];
	$iniBalance = $row["ini_balance"];
        $finalBalance = $row["final_balance"];
        $fee = empty($row["fee"])?0:$row["fee"];
		//echo  $paymentCode;
		$date = date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$row["reg_date"]);
    }
} else {
    openAlert('no_transaction_found');
}
?>

<title><?php echo $LANG["transaction_details"]?></title>

  <section id="content">
        
        
          <div class="container">
            <div class="section flexbox">
			  
			  

  <!-- Form with placeholder -->
  <div style="" class="col s12 m12 l6 custom-form-control ">
	<div class="card-panel hoverable">


<section class="container">
<div class="row py-3 flex-items-sm-center justify-content-center">
<div class="col-sm-12 row">
    <div class="left"> <h4><?php echo $LANG["transaction_details"]?></h4></div>

<table class ="table">
<tr>

<tr>
   <td>
       <?php echo ucwords($LANG["transaction_id"]); ?>
   </td>
   <td>
     <?php echo $id?>
   </td>
</tr>

<tr>
   <td>
          <?php echo ucwords($LANG["service_name"]); ?>
   </td> 
   
   <td>
     <?php echo $LANG["wallet_funding"]?>
   </td>
</tr>

<tr>
   <td>
      <?php echo ucwords($LANG["amount"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $amount?>
   </td>
</tr>
<tr>
   <td>
     <?php echo ucwords($LANG["fee"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $fee; ?>
   </td>
</tr>


 <tr>
   <td>
   <?php echo ucwords($LANG["initial_balance"]); ?>	
   </td>

     <td>
     <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $iniBalance ; ?>
   </td>
</tr>


 <tr>
   <td>
     <?php echo ucwords($LANG["final_balance"]); ?>	
   </td>

     <td>
     <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $finalBalance; ?>
   </td>
</tr>



<tr>
   <td>
     <?php echo $LANG["status"]; ?>	
   </td>

     <td>
      <?php echo ucwords($LANG["$status"]); ?>
   </td>
</tr>

<tr>
   <td>
     <?php echo $LANG["date"]; ?>
   </td>
     <td>
     <?php echo $date; ?>
   </td>
</tr>


</table>

</div>

    <div>
        <a class="btn left tooltipped" data-position="top" data-tooltip="<?php echo ucfirst($LANG["download"]) ?>" href="../receipt/payment.php?id=<?php echo $id;?>" download="Receipt-<?php echo $id?>"><i class="material-icons">file_download</i></a>
        <a class="btn right tooltipped" data-position="top" data-tooltip="<?php echo ucfirst($LANG["print"]) ?>" href="../receipt/payment.php?id=<?php echo $id;?>"><i class="material-icons">print</i></a>
    </div>
    
</section>

					
	
			 </div>
			</div>
		  </div>
		</div>
	  </div>
</section>


</div>


<?php include '../dashboard/include/footer.php'; ?>