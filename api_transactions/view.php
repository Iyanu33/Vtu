 <?php include "../include/ini_set.php" ;?>
<?php
include '../include/checklogin.php';

include '../include/data_config.php';
?>
<?php include '../account/userinfojson.php';?>
<?php include '../include/filter.php';?>
<?php 
 include '../dashboard/include/header.php';   
?>

<?php if($webConfig["enableAPI"]!=1){
     javaScriptRedirect("../index.php");
}
?>

<?php
$id= $_GET['id'];
$id = preg_replace("/[^0-9]/", "", "$id");
$sql = "SELECT * FROM api_transaction WHERE id ='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $amount = $row["amount"];
        $phone = $row["phone"];
        $serviceId = $row["service_id"];
        $email = $row["email"];
        $user = $row["user"];
        $status = $row["status"];
        $paymentCode = $row["payment_code"];
        $errorMessage = $row["error_message"];
	$iniBalance = $row["ini_balance"];
        $payAmount = $row["pay_amount"];
        $finalBalance = $row["final_balance"];
        $fee = empty($row["fee"])?0:$row["fee"];
		//echo  $paymentCode;
		$date = date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$row["reg_date"]);
    }
} else {
    openAlert('no_transaction_found');
}
?>
<?php 
	   
	   $sql = "SELECT display_name, image FROM service WHERE id='$serviceId' OR name = '$serviceId'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
			//print_r($serviceValue);
			

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
<tr>
   <td>
        <?php echo ucwords($LANG["phone"]); ?>
   </td>
     <td>
     <?php echo $phone?>
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
    <?php echo ucwords($LANG["amount_charged"]); ?>	
   </td>

     <td>
   <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $payAmount ;?>
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
   <?php echo ucwords($LANG["email"]); ?>
   </td>
   <td>
     <?php echo $email?>
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
    <?php echo $LANG["download"];?>
    <div>
        <a class="btn left tooltipped" data-position="top" data-tooltip="<?php echo ucfirst($LANG["download"]) ?>" href="../receipt/apitransaction.php?id=<?php echo $id;?>" download="Receipt-<?php echo $id?>"><i class="material-icons">file_download</i></a>
        <a class="btn right tooltipped" data-position="top" data-tooltip="<?php echo ucfirst($LANG["print"]) ?>" href="../receipt/apitransaction.php?id=<?php echo $id;?>"><i class="material-icons">print</i></a>
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