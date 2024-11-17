<?php include '../include/checklogin.php';?> 
<?php include '../dashboard/include/header.php';?>
<?php include '../include/data_config.php';?>
<?php include '../include/filter.php';?>	
<?php include '../include/webconfig.php';?>
<?php 
 include "../sendMail/sendMail.php";
$mail =  new sendMail($webConfig["licencesToken"]); 
?>
	<?php
	$selectedUser = $_SESSION["login_user"]; 			
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$webName = $webConfig["webName"];
	$replyTo = $webConfig["replyTo"];
	$webLink  = $_SERVER["SERVER_NAME"];
	if(!empty($webConfig["webLink"])){  
		$webLink = $webConfig["webLink"];
	}
	$name = xcape($conn, $_POST['name']);
	$amount = xcape($conn, $_POST['amount']);
	$ref = xcape($conn, $_POST['ref']);
	$remark = xcape($conn, $_POST['remark']);
	$regDate = time(); 
	$prc = 1;
	$id = mt_rand();
	$lit = '<a href="//'.$webLink.'/admin/pay_noti/view.php?id='.$id.'">
	<button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$LANG["view"].'</strong></button>
	</a>';
	 if(empty($name)){
	 $nameError ='<strong class="text-danger right"><small>'.$LANG["please_provide_depositor_name"].'</small></strong>';
	 $prc = 0;
	 }if(empty($amount)){
	 $amountError='<strong class="text-danger right"><small>'.$LANG["please_provide_amount"].'</small></strong>';
	 $prc=0;
	 }
	 if($prc ==1){
	 	$sql = "INSERT INTO pay_noti (
		id, 
		name,
		owner,
		ref, 
		amount, 
		remark, 
		reg_date
		)
   VALUES (
	   '$id',
	   '$name',
	   '$selectedUser', 
	   '$ref', 
	   '$amount',
	   '$remark', 
	   '$regDate'
   )";

	 if ($conn->query($sql) === TRUE) {
		 $subject ="{$LANG["a_new_payment_notification_from"]} $name";
   $sql = "SELECT name, email FROM admin WHERE deposit='1'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
	while($row = $result->fetch_assoc()) {
		$adminName =  $row["name"];
		 $message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong> '.$LANG["hey"].' '.$adminName.',</strong> </p>
        <p> '.$LANG["you_have_a_new_payment_notification"].' '.$name.'.</p>
		<p> '.$LANG["kindly_see_the_paymment_details_bellow"].' <br/>
		<strong>'.$LANG["depositor_name"].':</strong> '.$name.' <br/>
		<strong>'.$LANG["amount"].'</strong> '.$amount.'<br/>
		<strong>'.$LANG["teller_number"].'</strong> '.$ref.'<br/>
		<strong>'.$LANG["remark"].'</strong> '.$remark.'<br/>
		</p>
		<p><center>'.$lit.' </center></p>
		<p>'.$LANG["kind_regards"].'</p>
		</div>
		</center>
		';
		 $mail->send($row["email"],"$message","$subject","$webName","$replyTo"); 
                
				//$ref=$amount=$remark=$name='';
                    alertSuccess($LANG["payment_notification_were_received_successfully"]);
	}
}
}else{
    alertDanger($LANG["an_error_occurred"]);
}
}
}
?>	
	


  <title><?php echo $LANG["payment_notification"] ;?></title>
  <section style="width:100% !important" id="content">
          <div class="container flexbox">
            <div class="section row ">
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 custom-form-control ">
                    <div class="card-panel   hoverable ">
                   

 
		
		
		
			<div class="row flex-items-sm-center justify-content-center">
			 
				
					<form class=" flex-items-sm-center justify-content-center border border-success px-3 overflow-hidden py-3  bg-white text-success" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
							
							<div class="row w-100 col s12 form-divider" id="student">
					    
                       		                     <div class="col s12 input-field">
							<h6><?php echo $LANG["payment_notification"]?></h6>
							<hr color="#fff"/>
							</div>
                       		
						
						<input value="<?php echo $do_to;?>" type="hidden" class="form-control" name="do_to" >
						
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["depositor_name"]?></label>
							<input type="text" value='<?php echo $name;?>' class="form-control form-control-sm" name="name" id="name"  required>
						   
						   <?php echo $nameError;?>
						
						</div>
			
						<div class="col s12  input-field">
							<label for="" class="form-control-label"><?php echo $LANG["amount"]?></label>
					  		<input type="tel"   value='<?php echo $amount;?>' class="form-control form-control-sm" name="amount" id="phone" required >
							 <?php echo $amountError;?>
						</div>
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["teller_number"]?></label>
					  		<input type="text" value='<?php echo $ref;?>' class="form-control form-control-sm" name="ref" id="ref"  required>
							 <?php echo $refError;?>
						</div>
						
						
						
						
						

                                              <div class="col s12 input-field">
                                                  <textarea id="remark" class="materialize-textarea" name="remark" > <?php echo $remark;?></textarea>
							
							<label for="remark"><?php echo $LANG["remark"]?></label>
											  
						</div>								
						
						  
						<div class="col s12 form-group">
							<button class="btn btn-md btn-success right"><?php echo $LANG["submit"]?></button>
						   
						  
						</div>	
						
						
					     </div>
						
						
						
						
					</form>
				</div>
		
		
		

	</div>
</div>

              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
</section>
<?php include "../dashboard/include/footer.php"; ?>
 