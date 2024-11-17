        <?php include '../include/checklogin.php';?>
		<?php include '../include/header.php';?>
		 <?php include '../../include/data_config.php';?>
		 <?php include '../../include/filter.php';?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["bank"]);
?>
 
		<?php 
		$id = xcape($conn, $_GET['id']);
		
		  $sql = "SELECT * FROM bank WHERE id='$id'";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $bankName =   $row["bank_name"];
				   $id =   $row["id"];
				   $accountNumber = $row["account_number"];
				   $accountType = $row["account_type"];
				   $accountName = $row["account_name"];
		
				}
			}
?>
		
		
		 
<?php
				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$prc = 1;
	$bankName = xcape($conn, $_POST['bankName']);
	$accountName = xcape($conn, $_POST['accountName']);
	$accountNumber = xcape($conn, $_POST['accountNumber']);
	$accountType = xcape($conn, $_POST['accountType']);
	$id = xcape($conn, $_POST['id']);
      if(empty($bankName)){
		 $bankNameError= '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["bank_name_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 }  if(empty($accountName)){
		 $errorMessage = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_name_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 }  if(empty($accountNumber)){
		 $accountNumberError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_number_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 } if(empty($accountType)){
		 $accountTypeError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_type_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 }

	
	 if($prc ==1){
$sql = "UPDATE bank SET
     	bank_name = '$bankName', 
		account_name = '$accountName', 
		account_number = '$accountNumber',
		account_type = '$accountType'
	    WHERE id = '$id'";
  
	 if ($conn->query($sql) === TRUE) {
		  alertSuccess($LANG["changes_saved_successfully"]);
	 } else {
	 alertDanger($conn->error);
	}
    }
	}
	$conn->close();
	
	?>
		
		 
<title><?php echo $LANG['edit_bank_account']; ?></title>
		
 

		 
<section class="container">
 
  <section id="content">
      
        
		   <p class="caption"><?php echo $LANG['edit_bank_account']; ?></p>
              <div class="divider"></div>
			  
            <div class="section flexbox">
             
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">			   

		    <form class="row py-2" method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
						<div id="output" class="col s12"><?php echo $errorMessage;?></div>	
						
						
						
				<input type="hidden" value='<?php echo $id;?>' class="form-control form-control-sm" name="id" id="id"  required>
						   
						<div class="input-field col s12">
							<label for="" class="form-control-label"><?php echo $LANG["bank_name"];?></label>
							<input type="text" value='<?php echo $bankName;?>' class="form-control form-control-sm" name="bankName" id="bankName"  required>
						   
						   <?php echo $bankNameError;?>
						
						</div>
			
						<div class="input-field col s12">
							<label for="" class="form-control-label"><?php echo $LANG["account_name"];?></label>
					  		<input type="text"   value='<?php echo $accountName;?>' class="form-control form-control-sm" name="accountName" id="accountName" required >
							 <?php echo $accountNameError;?>
						</div>
						
						<div class="input-field col s12">
							<label for="" class="form-control-label"><?php echo $LANG["account_number"];?></label>
					  		<input type="text" value='<?php echo $accountNumber;?>'  class="form-control form-control-sm" name="accountNumber" id="accountNumber"  required>
							 <?php echo $accountNumberError;?>
						</div>
						
						<div class="input-field col s12">
							<label for="" class="form-control-label"><?php echo $LANG["account_type"];?></label>
					  		<input type="text" placeholder="Eg Saving" value='<?php echo $accountType;?>'  class="form-control form-control-sm" name="accountType" id="accountType"  required>
							 <?php echo $accountTypeError;?>
						</div>
						
		
			
			  
			
	<div class="input-field col s12">
	<input  type="submit" class="btn btn-primary right" value="Edit Bank Account"  /> 
    </div>
			
				
				
		</form>


</div>
</div>
</div>
</section>
</div>
</div>


 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="new.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["add_new_bank_account"]) ?>" class="btn-floating tooltipped"><i class="material-icons">add</i></a></li>
      <li><a href="index.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
  <?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		
		
		