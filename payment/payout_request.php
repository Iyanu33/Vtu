<?php include '../include/ini_set.php';?> 
<?php include '../include/checklogin.php';?> 
<?php include '../dashboard/include/header.php';?>
<?php include '../include/data_config.php';?>
<?php include '../include/filter.php';?>	
<?php include '../include/webconfig.php';?>
<?php  include "../sendMail/sendMail.php"; $mail = new sendMail($webConfig["licencesToken"]); ?>
<?php
 function payoutCharge($amount,$wallet=false){ $feePer = $GLOBALS["webConfig"]["payoutFeePercentage"]; $fee = $GLOBALS["webConfig"]["payoutFee"]; $feeCapped = $GLOBALS["webConfig"]["payoutFeeCapped"]; if($feePer==1 && $fee!=0 && $fee!=""){ $fee = ($fee/100)*trim($amount); if($fee > $feeCapped && ($feeCapped !='' && $feeCapped!=0) ){ $fee = $feeCapped; } } if($wallet===true && $GLOBALS["webConfig"]["payoutChargeWallet"]!=1){ $fee = 0; } if(empty($fee)){ $fee = 0; } return $fee; } ?>
       <?php
 $selectedUser = $_SESSION["login_user"] ; '../account/userinfor.php'; $webName = $webConfig["webName"]; $replyTo = $webConfig["replyTo"]; $webLink = $_SERVER["SERVER_NAME"]; if(!empty($webConfig["webLink"])){ $webLink = $webConfig["webLink"]; } if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bankPayout"]==1) { $regDate = time(); $prc = 1; $id = md5(mt_rand().time()); $amount = trim(xcape($conn, $_POST["amount"])); $regDate = time(); $fee = payoutCharge($amount); $payAmount = $amount+payoutCharge($amount); $earnBalance = $user["earn"]-$payAmount; $balance = $amount+$user["credit"]; $bankName = xcape($conn, $_POST["bankName"]); $accountName = xcape($conn, $_POST["accountName"]); $accountType = xcape($conn, $_POST["accountType"]); $accountNumber = xcape($conn, $_POST["accountNumber"]); $custom1 = xcape($conn, $_POST["custom1"]); $custom2 = xcape($conn, $_POST["custom2"]); if($amount > $webConfig['payoutMaxAmount'] && $webConfig['payoutMaxAmount'] !=0 && $webConfig['payoutMaxAmount'] !=""){ alertDanger($LANG["amount_above_max"]); $prc = 0; } if($amount < $webConfig['payoutMinAmount'] && $webConfig['payoutMinAmount'] !=0 && $webConfig['payoutMinAmount'] !="" ){ alertDanger($LANG["amount_below_min"]); $prc = 0; } $lit = '<a href="//'.$webLink.'/admin/payout_request/view.php?id='.$id.'">
    <button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$LANG["view"].'</strong></button>
    </a>'; if($prc==1) { if(empty($amount)){ $amountError = '<div class="alert alert-danger alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong>'.$LANG["please_provide_amount"].'</strong>
                         </div>'; $prc = 0; }elseif($payAmount>$user["earn"]){ $amountError = '<div class="alert alert-danger alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong>'.$LANG["insufficient_balance"].'</strong>
                         </div>'; $prc = 0; } if(empty($bankName)){ $bankNameError= '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["bank_name_is_empty"].'</strong>
						</div>'; $prc = 0; } if(empty($accountName)){ $accountNameError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_name_is_empty"].'</strong>
						</div>'; $prc = 0; } if(empty($accountNumber)){ $accountNumberError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_number_is_empty"].'</strong>
						</div>'; $prc = 0; } if(empty($accountType)){ $accountTypeError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_type_is_empty"].'</strong>
						</div>'; $prc = 0; } } if($prc==1){ $sql= "INSERT INTO payout_request(
                 user,
                 id,
                 bank_name,
                 account_name,
                 account_number,
                 account_type,
                 amount,
                 fee,
                 custom_1,
                 custom_2,
                 reg_date
                 )
                 VALUES(
                 '$loginUser',
                 '$id',
                 '$bankName',
                 '$accountName',
                 '$accountNumber',
                 '$accountType',
                 '$amount',
                 '$fee',
                 '$custom1',
                 '$custom2',
                 '$regDate'
                 )
                 "; if($conn->query($sql)===true){ $subject ="{$LANG["a_new_payout_request_from"]} {$user["name"]}"; $sql = "SELECT name, email FROM admin WHERE payment='1'"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $adminName = $row["name"]; $message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong> '.$LANG["hey"].' '.$adminName.',</strong> </p>
        <p> '.$LANG["a_new_payout_request_from"].' '.$user["name"].'.</p
		<p>'.$LANG["kind_regards"].'</p>
		</div><p>'.$lit.' </p>
		</center>
		'; $mail->send($row["email"],"$message","$subject","$webName","$replyTo"); ; } alertSuccess($LANG["request_were_received"]); } }else{ echo $conn->error; alertDanger($LANG["unknown_error"]); } } } ?>	
<?php
 if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["sendToWallet"]==1){ $prc= 1; $id = md5(mt_rand().time()); $amount = trim(xcape($conn, $_POST["amount"])); $regDate = time(); if ($amount > $webConfig['payoutMaxAmount'] && $webConfig['payoutMaxAmount'] != 0 && $webConfig['payoutMaxAmount'] != "") { alertDanger($LANG["amount_above_max"]); $prc = 0; } if ($amount < $webConfig['payoutMinAmount'] && $webConfig['payoutMinAmount'] != 0 && $webConfig['payoutMinAmount'] != "") { alertDanger($LANG["amount_below_min"]); $prc = 0; } $fee = payoutCharge($amount); $payAmount = $amount+payoutCharge($amount, true); $earnBalance = $user["earn"]-$payAmount; $balance = $amount+$user["credit"]; if($prc==1){ if($payAmount<$user["earn"]){ $sql = "UPDATE users SET credit='$balance', earn ='$earnBalance' WHERE id='{$user['id']}'"; if($conn->query($sql)===true){ $conn->query("INSERT INTO payout_request(
                 user,
                 id,
                 wallet,
                 amount,
                 settled,
                 fee,
                 reg_date
                 )
                 VALUES(
                 '$loginUser',
                 '$id',
                 '1',
                 '$amount',
                 '1',
                 '$fee',
                 '$regDate'
                 )
                 " ); alertSuccess($LANG["transaction_successful"]); }else{ alertDanger($LANG["unknown_error"]); } }else{ openAlert($LANG["insufficient_balance"],$LANG["transaction_failed"],"error"); } } } ?>


  <title><?php echo $LANG["payout_request"] ;?></title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h5><?php echo $LANG["payout_request"]; ?> </h5>
                     
                        <?php echo !empty($webConfig["payoutMessage"])?htmlspecialchars_decode($webConfig["payoutMessage"]):'';?>
                       
                       

			  
			  
			  
              <div class="divider"></div>
             
              
              
              
            <div class="section  flexbox ">
             
       
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 custom-form-control ">
                    <div class="card-panel   hoverable ">
                   
                          <?php echo !empty($webConfig["payoutDateTime"])?htmlspecialchars_decode($webConfig["payoutDateTime"]):'';?>
                        <hr/>
                    <?php
 $currency = htmlspecialchars_decode($webConfig["currency"]["symbol"]); if($webConfig['payoutMaxAmount'] && $webConfig['payoutMaxAmount'] !=0 && $webConfig['payoutMaxAmount'] !=""){ echo "<p>{$LANG["max_amount"]}: $currency{$webConfig['payoutMaxAmount']}</p>"; } if($webConfig['payoutMinAmount'] !=0 && $webConfig['payoutMinAmount'] !="" ){ echo "<p>{$LANG["min_amount"]}: $currency{$webConfig['payoutMinAmount']}</p>"; } ?>
			        <div class="row flex-items-sm-center justify-content-center">
			               
                                  
                                <?php if($webConfig["payoutSendToWalletEnabled"]==1){?>
                                <div style="display: none" id="sendToWallet">
                                  <form method="POST" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                                    <div class="col s7 m9  input-field">
                                        <input type="hidden" name="sendToWallet" value="1" />
                                            <label for="" class="form-control-label"><?php echo $LANG["amount"]?></label>
                                            <input type="text"   value='<?php echo $amount;?>' class="form-control form-control-sm" name="amount" id="anmount" required >
                              	    </div>
						
                                    <div class="col s5  m3 input-field">

                                        <button class="btn btn-md btn-success right"><?php echo $LANG["send"]?></button>
                                    </div>	
                                  </div>
                                </form>
                                  <div class="col s12" ><span onclick="$('#sendToWallet').toggle('show')" style="cursor: pointer;" class="right green-text"><?php echo $LANG["send_to_wallet"]; ?></span></div>
                                <?php } ?>
                                  <!--Wallet-->
                                <?php if($webConfig["bankPayoutEnabled"]==1){?>
                                  <form class=" flex-items-sm-center justify-content-center border border-success px-3 overflow-hidden py-3  bg-white text-success" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
							
                       		
						
						<input value="1" type="hidden" class="form-control" name="bankPayout" >
						
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["bank_name"]?></label>
							<input type="text" value='<?php echo $bankName;?>' class="form-control form-control-sm" name="bankName"   required>
						   
						   <?php echo $bankNameError;?>
						
						</div>
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["account_name"]?></label>
							<input type="text" value='<?php echo $accountName;?>' class="form-control form-control-sm" name="accountName"  required>
						   
						   <?php echo $accountNameError;?>
						
						</div>
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["account_number"]?></label>
							<input type="text" value='<?php echo $accountNumber;?>' class="form-control form-control-sm" name="accountNumber"  required>
						   
						   <?php echo $accountNumberError;?>
						
						</div>
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["account_type"]?></label>
							<input type="text" value='<?php echo $accountType;?>' class="form-control form-control-sm" name="accountType"  required>
						   
						   <?php echo $accountTypeError;?>
						
						</div>
			
						<div class="col s12  input-field">
							<label for="" class="form-control-label"><?php echo $LANG["amount"]." ($currency)"?></label>
					  		<input type="text"   value='<?php echo $amount;?>' class="form-control form-control-sm" name="amount"  required >
							 <?php echo $amountError;?>
						</div>
						
						<?php
 if(!empty($webConfig["payoutCustom1"])){?>
                                                  <div class="col s12 input-field">
                                                    <textarea id="custom1" class="materialize-textarea" name="custom1" ><?php echo $custom1;?></textarea>
							<label for="custom1"><?php echo $webConfig["payoutCustom1"]?></label>		  
						</div>	
                                                <?php } ?>
                                                
                                                
                                                <?php
 if(!empty($webConfig["payoutCustom2"])){?>
                                                  <div class="col s12 input-field">
                                                    <textarea id="custom2" class="materialize-textarea" name="custom2" ><?php echo $custom1;?></textarea>
							<label for="custom2"><?php echo $webConfig["payoutCustom2"]?></label>		  
						</div>	
                                                <?php } ?>
                                                
                                             	
						  
						<div class="col s12 form-group">
                                                    
				         		<button class="btn btn-md btn-success right"><?php echo $LANG["submit"]?></button>
						   
						</div>	
						
						
					     </div>
						
						
						
						
					</form>
                                <?php }?>
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


 <?php include '../include/right-nav.php';?>
<?php include "../dashboard/include/footer.php"; ?>
 