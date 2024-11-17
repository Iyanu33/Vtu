 <?php include "../include/ini_set.php" ;?>
<?php
session_start(); include '../include/data_config.php'; ?>
<?php include '../account/userinfojson.php';?>
<?php include '../include/filter.php';?>
<?php  if(empty($_SESSION["login_user"])){ include '../include/header.php'; }else{ include '../dashboard/include/header.php'; } ?>
<?php
$id= $_GET['id']; $id = preg_replace("/[^0-9]/", "", "$id"); $sql = "SELECT * FROM recharge WHERE id ='$id'"; $result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) { while($row = mysqli_fetch_assoc($result)) { $id = $row["id"]; $amount = $row["amount"]; $phone = $row["phone"]; $serviceId = $row["service_id"]; $email = $row["email"]; $user = $row["user"]; $paymentMethod = $row["payment_method"]; $status = $row["status"]; $paymentCode = $row["payment_code"]; $errorMessage = $row["error_message"]; $iniBalance = $row["ini_balance"]; $payAmount = $row["pay_amount"]; $finalBalance = $row["final_balance"]; $fee = empty($row["fee"])?0:$row["fee"]; $gatewayResponse = json_decode($row["gateway_response"],true); $date = date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$row["reg_date"]); } } else { openAlert('no_transaction_found'); } ?>
<?php  $sql = "SELECT display_name, image FROM service WHERE id='$serviceId' OR name = '$serviceId'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } ?>



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
    <img style="height: 80px !important; width: 100px !important" class="responsive-img right h-sm-30" src="../uploads/service/<?php echo $serviceValue['image']?>" />
    <div class="clearfix"></div>				
 <?php if(!empty(trim($errorMessage)) && $status=="failed"){ ?>
    <div class="alert alert-danger left-align">
        <h6 class="text-center title"> <?php echo strtoupper($LANG["error_message"]) ;?></h6>
        <ul>
            
 <?php foreach (explode(",",$errorMessage) as $error) {?>
            <li><i class="material-icons left small">error</i><?php echo $LANG[$error];?></li>
           <?php }?>
        </ul>
     </div>
   <?php }?>  

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


   <td>
          <?php echo ucwords($LANG["service_name"]); ?>
   </td> 
   
   <td>
     <?php echo $serviceValue["display_name"]?>
   </td>
</tr>
<?php if(!empty($phone)){ ?>
<tr>
   <td>
        <?php echo ucwords($LANG["phone"]); ?>
   </td>
     <td>
     <?php echo $phone?>
   </td>
</tr>
<?php } ?>
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
<?php if($paymentMethod == "card"){ $cardFee = $conn->query("SELECT fee FROM guest_payment WHERE transaction_id='$id'")->fetch_assoc()["fee"]; ?>
<tr>
   <td>
     <?php echo ucwords($LANG["card_processing_fee"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $cardFee; ?>
   </td>
</tr>

<?php } ?>

<tr>
   <td>
    <?php echo ucwords($LANG["amount_charged"]); ?>	
   </td>

     <td>
   <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $payAmount ;?>
   </td>
</tr>

<?php if(strtolower($paymentMethod)=="wallet" && $user==$_SESSION["login_user"]){?>
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

<?php } ?>



<?php if(!empty($email)){ ?>
<tr>
   <td>
   <?php echo ucwords($LANG["email"]); ?>
   </td>
   <td>
     <?php echo $email?>
   </td>
</tr>
<?php } ?>

 <tr>
   <td>
     <?php echo ucwords($LANG["payment_method"]); ?>
   </td>
   <td>
     <?php echo ucwords($LANG[$paymentMethod])?>
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

<?php  $sql = "SELECT value, name FROM form WHERE name='system-load-display-value' AND service='$serviceId'"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { if($row["name"]=="system-load-display-value"){ $displayValueContents = json_decode(file_get_contents($row["value"]),true); if($displayValueContents==null || !is_array($displayValueContents)){ $loadDisplayValue = false; }else{ $loadDisplayValue = true; $displayValue = $displayValueContents; } } } } $sql = "SELECT name, display_name FROM display_value WHERE active='1' AND service='$serviceId'"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $displayValue[] = $row; } } ?>

 <?php  if(is_array($displayValue)){ foreach($displayValue as $row) { if(!empty($gatewayResponse[$row["name"]])){ ?>
<tr>
	 <td> <?php  echo $row["display_name"]?> </td> 
	 <td> <?php echo $gatewayResponse[$row["name"]];?></td>
</tr>
<?php
 } } } ?>



</table>

</div>
    <div>
        <a class="btn left tooltipped" data-position="top" data-tooltip="<?php echo ucfirst($LANG["download"]) ?>" href="../receipt/transaction.php?id=<?php echo $id;?>" download="Receipt-<?php echo $id?>"><i class="material-icons">file_download</i></a>
        <a class="btn right tooltipped" data-position="top" data-tooltip="<?php echo ucfirst($LANG["print"]) ?>" href="../receipt/transaction.php?id=<?php echo $id;?>"><i class="material-icons">print</i></a>
    </div>
    
</section>

					
	
			 </div>
			</div>
		  </div>
		</div>
	  </div>
</section>


</div>


<?php  if(empty($_SESSION["login_user"])){ include '../include/footer.php'; }else{ include '../dashboard/include/footer.php'; } ?>