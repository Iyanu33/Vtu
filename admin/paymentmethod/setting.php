 <?php include "../../include/ini_set.php"; ?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
 
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["payment_method"]);
?>
 
    <?php 
	   $id = xcape($conn,$_GET["id"]);
	   
	   $sql = "SELECT * FROM payment_method WHERE id='$id' OR name='$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$methodValue = $result->fetch_assoc();
		}else{
			$methodValue["notFound"] = true;
		}
			//print_r($methodValue);
	  ?>
	  
	   
	   <?php 
	  
	   
	   $id = $methodValue["id"];
	   $gateway = $methodValue["gateway"];
	   
	   $sql = "SELECT * FROM payment_gateway_data WHERE id='$gateway'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$gatewayValue = $result->fetch_assoc();
		}else{
			$gatewayValue["notFound"] = true;
		}
			//print_r($commissionRate );

      $gatewayOption ="";
	  $sql = "SELECT name, id FROM payment_gateway_data ORDER BY name ASC";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
		while($row = $result->fetch_assoc()){
			$selected  = "";
			if($methodValue["gateway"]==$row["id"]){
				$selected = "selected";
			}
		$gatewayOption = "<option $selected value=\"{$row['id']}\">{$row['name']}</option>$gatewayOption";
		}
		}else{
			$gatewayOption = 'false';
		}
			//echo $gatewayOption;     
			
    $currencyOption ="";
	  $sql = "SELECT name, id FROM currency ORDER BY name ASC";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
		while($row = $result->fetch_assoc()){
			$selected  = "";
			if($methodValue["currency"]==$row["id"]){
				$selected = "selected";
			}
		$currencyOption = "<option $selected value=\"{$row['id']}\">{$row['name']}</option>$currencyOption";
		}
		}else{
			$currencyOption = 'false';
		}
			//echo $currencyOption;   
			
	  ?>
	
 
  <title><?php echo $LANG["setting"] ;?>  - <?php echo $methodValue['name'] ;?></title>
 
 
 
 <style>
.carousel .carousel-item {
  width: 100%;
}
</style>

 
 

    <div class="col s12">
      <ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3"><a class="active" href="#general"><?php echo $LANG['general']; ?></a></li>
        <li class="tab col s3"><a  href="#custom"><?php echo $LANG['custom_value']; ?></a></li>
        <li class="tab col s3"><a  href="#fee"><?php echo $LANG['fee']; ?></a></li>
        </ul>
    </div>
	
    <div id="general" class="col s12">
	
	  <?php include "setting/general.php"; ?>
	
	</div>
	
	
	
   
	
	
    <div id="custom" class="col s12">
	      <?php include "setting/custom.php"; ?>
	</div>
	
	 <div id="fee" class="col s12">
	     <?php include "setting/fee.php"; ?>
	
	</div>
	
	
	
	
	
	
  </div>
 
  
 

 
 
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="new.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_payment_method"]) ?>" class="btn-floating tooltipped"><i class="material-icons">add</i></a></li>
      <li><a href="index.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
		
 
 
 </div>
 </div>
 <?php include "../../include/right-nav.php"; ?>
 <?php include "../include/footer.php"; ?>