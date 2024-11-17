<?php include "../include/ini_set.php"; ?>
<?php include '../include/checklogin.php';?> 
<?php include "../dashboard/include/header.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "function/value.php"; ?>
<title>KYC Verification</title>
<?php if($active == '1'){?>
<?php  $kyc = $conn->query("SELECT first_name, last_name,  middle_name,
        bvn, card_path, card_type, reject_reason, submitted, card_number, date_of_birth, verified
        FROM reserved_account WHERE owner = '$loginUser'")->fetch_assoc(); if($kyc["verified"]==1 || $kyc["verified"]=="1"){ $kycVerified = true; } ?>
<style>
.carousel .carousel-item {
  width: 100%;
}
</style>

    <div class="col s12">
      <ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3"><a class="active" href="#personalInfo">Profile </a></li>
        <li class="tab col s3"><a  href="#identifacationMeans">Means of Identification</a></li>
      </ul>
    </div>
	
    <div id="personalInfo" class="col s12">
	  <?php include "kyc/profile.php"; ?>
    </div>

    <div id="identifacationMeans" class="col s12">
	      <?php include "kyc/image.php"; ?>
     </div>
  </div>
 <?php }else{ alertDanger("Reserve Account Disabled on this system"); } ?>
 </div>
 </div>
 <?php include "../dashboard/include/footer.php"; ?>