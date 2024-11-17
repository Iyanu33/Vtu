<?php include "../include/ini_set.php" ;?>
<?php
include '../include/header.php'; include '../include/data_config.php'; ?>
<?php include '../account/userinfojson.php';?>
<?php include '../include/webconfig.php';?>
<?php include '../include/filter.php';?>
<?php
$id= xcape($conn,$_GET['id']); $sql = "SELECT id,phone,service_id,amount,reg_date,email FROM recharge WHERE id ='$id'"; $result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) { while($row = mysqli_fetch_assoc($result)) { $id = $row["id"]; $amount = $row["amount"]; $phone = $row["phone"]; $email = $row["email"]; $serviceId = $row["service_id"]; $date = date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$row["reg_date"]); } } else { openAlert('no_transaction_found'); } ?>
<?php  $sql = "SELECT fee, fee_percentage, id, display_name,image FROM service WHERE id='$serviceId' OR name = '$serviceId'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } if($serviceValue["fee_percentage"]==1){ $per = "(".$LANG["in_percentage"].")"; } ?>


<title> <?php echo $LANG["confirm_transaction_detials_below"]?> - <?php echo $serviceValue["display_name"]?> </title>
  <section id="content">
        
         
	 
<div class="container flexbox">
  <div class="section" >



        <!-- Form with placeholder -->
        <div class="row col s6 m12 l12 custom-form-control">
      <div  class="card-panel  hoverable ">
   <strong style="font-weight: bold"><?php echo $LANG["confirm_transaction_detials_below"]?></strong>

   <div class="col s4 m2  right"><img class="img-responsive" src="../uploads/service/<?php echo $serviceValue['image']?>" class="right"  /></div>
<table class="row">
<tr>

<tr>
   <td>
  <?php echo $LANG["transaction_id"];?>
   </td>
   <td>
     <?php echo $id?>
   </td>
</tr>

<tr>
   <td><?php echo $LANG["service"];?>
   </td> 
   
   <td>
     <?php echo $serviceValue["display_name"]?>
   </td>
</tr>
<?php if(!empty($phone)){?>
<tr>
   <td>
   <?php echo $LANG["phone"];?>
   </td>
     <td>
     <?php echo $phone?>
   </td>
</tr>
<?php }?>
<?php if(!empty($email)){?>
<tr>
   <td>
   <?php echo $LANG["email"];?>
   </td>
     <td>
     <?php echo $email?>
   </td>
</tr>
<?php } ?>
<tr>
   <td>
    <?php echo $LANG["amount"];?>
   </td>
     <td>
     <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"])?><?php echo $amount?>
   </td>
</tr>
<tr>
   <td>
   <?php echo $LANG["convenience_fee"];?>
   
   </td>
     <td>
     <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"])?><?php echo $serviceValue["fee"]?> <?php echo $per; ?>
   </td>
</tr>


<tr>
   <td>
   <?php echo $LANG["date"];?>
   </td>
     <td>
     <?php echo $date; ?>
   </td>
</tr>


</table>


					
					
					
					
					
					
					
					
					
					
					


	       <div class="row  flex-items-sm-center justify-content-center">
                   <center>
			<div class="m12 ">
                            <a class="btn btn-success left-on-md-up my-5" href="../payment/method.php?recharge=<?php echo $id; ?>"><?php echo $LANG['pay_with_card'];?></a>
				<div class="show-on-small hide-on-med-and-up hide-on-med-and-down ">
				<br/>
				</div>
                            <a class="btn btn-success green right my-5 show-on-med-and-up hide-on-med-and-down" href="../payment/wallet.php?id=<?php echo $id?>"> <?php echo $LANG['pay_with_wallet'];?></a>
                            <a style="width: 200px;" class="btn btn-success green  my-5 show-on-small hide-on-med-and-up " href="../payment/wallet.php?id=<?php echo $id?>"> <?php echo $LANG['pay_with_wallet'];?></a>
			</div>
                   </center>
			</div>





			
			 </div>
			</div>
		  </div>
		</div>
	  </div>
</section>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>