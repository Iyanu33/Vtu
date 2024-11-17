<?php include "../include/ini_set.php"; ?>
<?php include '../include/checklogin.php';?> 
<?php include "../dashboard/include/header.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "function/value.php"; ?>
<title>KYC Verification</title>
<?php if($active == '1'){?>
<?php  $kyc = $conn->query("SELECT
        bvn, account_number, bank_name, account_name, verified , submitted, reject_reason 
        FROM reserved_account WHERE owner = '$loginUser'")->fetch_assoc(); 
?>
 <style>
.carousel .carousel-item {
  width: 100%;
}
.name-header{
    font-weight: bold;
}
</style>

    <div class="col s12">
        <div class="flexbox">
       <div class="custom-form-control">
        <div class="card-panel">
            
            <?php if(!empty($kyc["account_number"])){?>
            <h5><div class="name-header" >Bank Name</div></h5>
            <h5><div><?php echo $kyc["bank_name"]?></div></h5>
            <h5><div class="name-header" >Account Name</div></h5>
            <h5> <?php echo $kyc["account_name"]?></h5>
            <h5> <div class="name-header" >Account Number</div> </h5>
            <h5><div> <?php echo $kyc["account_number"]?> </div> </h5>
            <?php } else if($noKYC=='1'){ ?>
            <center><a class="btn green" href="create.php">Generate your Unique Bank Account</a></center>
            <?php } else if($kyc["verified"]=='1'){ ?>
            <center><a class="btn green" href="create.php">Generate your Unique Bank Account</a></center>
            <?php } else if($kyc["submitted"]==1 && $kyc["verified"]==0){?>
            <?php echo $kyc["reject_reason"]; ?>
            <center><a href="kyc.php">Update KYC</a></center>
            <?php } else{?>
            <center><a class="btn right btn-danger btn-sm py-0" href="kyc.php">Apply for Unique Bank Account</a></center>
            <?php }?>
        </div>
 </div>
 </div>
 </div>
 <?php }else{ alertDanger("Reserve Account Disabled on this system"); } ?>
 </div>
 </div>
 <?php include "../dashboard/include/footer.php"; ?>