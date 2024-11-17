<?php include "../include/ini_set.php" ;?>
<?php include "../include/header.php" ;?>
<?php include "../include/data_config.php" ;?>
<?php include "../include/filter.php" ;?>
<?php include "../include/webconfig.php" ;?>


<?php
if(!is_array("$LANG")){ include "../language/{$webConfig["LANG"]}.php"; } ?>

<?php  $method = xcape($conn, $_GET["method"]); ?>
	
<?php  if(!empty($_GET["recharge"])){ $id = xcape($conn,$_GET["recharge"]); $sql = "SELECT * FROM recharge WHERE id = '$id' LIMIT 1"; $result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) { $transactionValue = mysqli_fetch_assoc($result); }else{ $transactionValue["notFound"] = true; } $transactionValue["type"] = "recharge"; $conn->query("UPDATE recharge SET payment_method_id='$card', payment_method_id='$method' WHERE id='$id'"); $changeMethod = "../buy/confirm.php?id=$id"; $transactionValue['systemService']; if($GLOBALS["webConfig"]["discountEnable"]==1){ $sql = "SELECT unregistered_user,unregistered_user_percentage FROM commission_rate WHERE service ='{$transactionValue['service_id']}'"; $result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) { while($row = mysqli_fetch_assoc($result)) { if($GLOBALS["webConfig"]["unregisteredUserDiscountEnable"]==1){ $discount = $row["unregistered_user"]; $discountMoney = $discount; $percent = $row["unregistered_user_percentage"]; } } } $discount = trim($discount); if($discount != 0 && $discount !="0" && !empty($discount)){ if($percent == 1){ $discount = ($discount/100)*trim($transactionValue["amount"]); $discountPer = "(".$LANG["in_percentage"].")"; } }else{ $discount = 0; } $discount; }else{ $discount = 0; } }elseif(!empty($_GET["wallet"])){ $id = xcape($conn,$_GET["wallet"]); $sql = "SELECT * FROM payment WHERE id = '$id' LIMIT 1"; $result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) { $transactionValue = mysqli_fetch_assoc($result); }else{ $transactionValue["notFound"] = true; } $transactionValue["type"] = "wallet"; $user = $transactionValue["owner"]; $conn->query("UPDATE payment SET  payment_method_id='$method' WHERE id='$id'"); $changeMethod = "method.php?wallet=$id"; } ?>
<?php include '../account/userinfojson.php';?>

 <?php  if(!empty($_GET["recharge"])){ $service = $transactionValue["service_id"]; $sql = "SELECT name, fee, fee_capped, fee_percentage, id, display_name FROM service WHERE id='$service' OR name='$service'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } }else{ $serviceValue["display_name"]=$LANG["wallet_funding"]; $serviceValue["fee"]=$webConfig["walletCharge"]; $serviceValue["fee_capped"]=$webConfig["chargeCap"]; $serviceValue["fee_percentage"]=$webConfig["walletFeePercentage"]; } ?>

 <?php  $sql = "SELECT * FROM payment_method WHERE id='$method'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $paymentMethod = $result->fetch_assoc(); }else{ $paymentMethod["notFound"] = true; } ?> 

<?php  $currency = $paymentMethod["currency"]; $sql = "SELECT * FROM currency WHERE id='$currency'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $paymentMethod['currency'] = $result->fetch_assoc(); }else{ $currency["notFound"] = true; } ?>


 <?php  $gateway = $paymentMethod["gateway"]; $sql = "SELECT name, path_name, logo FROM payment_gateway_data WHERE id='$gateway'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $gatewayData = $result->fetch_assoc(); }else{ $gatewayData["notFound"] = true; } include "../paymentgateway/{$gatewayData["path_name"]}/index.php"; ?>



 <?php  $serviceFeePercentage = $serviceValue['fee_percentage']; $serviceFee = $serviceValue["fee"]; $serviceFeeCapped = $serviceValue["fee_capped"]; if($serviceFeePercentage ==1 && ($serviceFee!=0 || $serviceFee!="")){ $serviceFee = ($serviceFee/100)*trim($transactionValue["amount"]); if($serviceFee > $serviceFeeCapped && ($serviceFeeCapped !='' || $serviceFeeCapped!=0) ){ $serviceFee = $serviceFeeCapped; } } if($transactionValue["type"]=="recharge"){ $methodFee = $paymentMethod["recharge_fee"]; $methodFeeCapped = $paymentMethod["recharge_capped"]; $methodFeePercentage = $paymentMethod["recharge_percentage"]; }else if($transactionValue["type"]=="wallet"){ $methodFee = $paymentMethod["wallet_fee"]; $methodFeeCapped = $paymentMethod["wallet_capped"]; $methodFeePercentage = $paymentMethod["wallet_percentage"]; $discount = 0; } $displayMethodFee = $methodFee; if($methodFeePercentage ==1 && ($methodFee!=0 || $methodFee!="")){ $methodFee = ($methodFee/100)*trim($transactionValue["amount"]); if($methodFee > $methodFeeCapped && ($methodFeeCapped !='' || $methodFeeCapped!=0) ){ $methodFee = $methodFeeCapped; } } if($transactionValue["type"]=="wallet"){ $walletFee = $serviceFee+$methodFee; $conn->query("UPDATE payment SET fee='$walletFee' WHERE id='$id'"); } $transactionValue["payAmount"] = $transactionValue["amount"] - $discount; $transactionValue["payAmount"] = $transactionValue["payAmount"]+$serviceFee+$methodFee; $displayPayAmount = htmlspecialchars_decode($webConfig["currency"]["symbol"]).round($transactionValue["payAmount"],2); if($paymentMethod["currency"]["id"] != $webConfig["currency"]["id"]){ $paymentMethodRate = $paymentMethod["currency"]["rate"]; $systemRate = $webConfig["currency"]["rate"]; $amountToConvert = $transactionValue["payAmount"]; $transactionValue["payAmount"] = ($amountToConvert * $systemRate)/$paymentMethodRate; $transactionValue["payAmount"] = round($transactionValue["payAmount"],2); $displayPayAmount = $displayPayAmount." ".$LANG["converted_to"]." ".htmlspecialchars_decode($paymentMethod["currency"]["symbol"]).$transactionValue["payAmount"]; } ?>
<?php
$userInfo = userInfo($user,$conn); $userInfo = json_decode($userInfo,true); if(empty($userInfo['name'])){ $userInfo['name'] = "Unregistered User"; $userInfo['phone'] = $transactionValue["phone"]; $userInfo['email'] = empty($transactionValue["email"])?$webConfig["supportEmail"]:$transactionValue["email"]; } $userInfo['name'] = ucwords($userInfo['name']); ?>
	
<?php  if($serviceFeePercentage==1){ $servicePer = "(".$LANG["in_percentage"].")"; } if($serviceFeeCapped > 0){ $servicePer = $servicePer."<p class='hide-on-med-and-up'><br/></p>  ".$LANG["fee_capped_at"]." ".htmlspecialchars_decode($webConfig["currency"]["symbol"]).$serviceFeeCapped; } ?>

<?php  if($methodFeePercentage==1){ $methodPer = "(".$LANG["in_percentage"].")"; } if($serviceFeeCapped > 0){ $methodPer = $methodPer." ".$LANG["fee_capped_at"]." ".htmlspecialchars_decode($webConfig["currency"]["symbol"]).$methodFeeCapped; } ?>	
						

 <title><?php echo $LANG["payment"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
  <section style="width:100% !important; font-size: 120%">
          <div class="container flexbox">
            <div class="section row "  >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 ">
                    <div class="card   hoverable ">
                   
					  
					   <div class="col s12 center-align"> 
					      <h5> <?php echo strtoupper($LANG["confirm_transaction_detials_below"]);?> </h5>
					  </div>
					  
					 
                                    	<div class="col s4 ">
                                            <p>
                                                <span class="light-blue-text"><?php echo $LANG["customer"]; ?></span><br>
                                                <b><?php echo $userInfo["name"]; ?></b><br>
                                                <b><?php echo $userInfo["phone"]; ?></b><br>
                                            </p>
                                        </div> 
                                        <div class="col s4">
                                            <p>
                                                <span class="light-blue-text"><?php echo $LANG["date"]; ?></span><br>
                                                <b><?php echo date("d-M-Y",$transactionValue["reg_date"]); ?></b><br>
                                            </p>
                                        </div> 
                                        <div class="col s4">
                                            <p>
                                               <span class="light-blue-text"><?php echo $LANG["status"]; ?></span><br>
                                                <b><?php echo $LANG[$transactionValue["status"]]; ?></b><br>
                                                

                                            </p>
                                        </div>
                                       
                                   
                                    <div class="row no-margin p-0">
                                        <div class="col s12">
                                            <table class="responsive-table ">
                                                <thead>
                                                    <tr>
                                                        <th class="left-on-sm-only right-align"><?php echo $LANG["id"]; ?></th>
                                                        <th class="left-on-sm-only right-align"><?php echo $LANG["service"]; ?></th>
                                                        <th class="left-on-sm-only right-align"><?php echo $LANG["amount"]; ?></th>
                                                        <th class="left-on-sm-only center-align"><?php echo $LANG["fee"]; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    	<th class="left-on-sm-only right-align"> <?php echo $transactionValue["id"];?></th>
                                                        <td class="left-on-sm-only right-align"><?php echo $serviceValue["display_name"]; ?></td>
                                                        <td class="left-on-sm-only right-align"><?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]); ?><?php echo $transactionValue["amount"]; ?></td>
                                 						<td class="left-on-sm-only right-align"><?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]); ?><?php echo $serviceValue["fee"]; ?> <?php echo $servicePer ?></td>                       
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row padding-3">
                                        <div class="col s12 m6 l6">
                                            <span><?php echo $LANG["thank_you"]; ?></span>
                                            
                                                                                        
                                               <?php if($transactionValue["status"]=="pending"){?>                            		<br>
                                       		<a  href="<?php echo $changeMethod; ?>" class="btn-flat pink lighten-4"><?php echo $LANG["change_payment_method"]; ?></a>     
                                               <?php } ?>
                                        </div>
                                        <div class="col s12 m6 l6">
                                            <div class="left-on-sm-only right-align">
                                                <p class=" light-blue-text"><b><?php echo $LANG["payment_method_charge"]; ?></b></p>
                                                <p><?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]); ?><?php echo $displayMethodFee ; ?> <?php echo $methodPer; ?></p>
                                                <?php if($transactionValue["type"]=="recharge"){?>
												<p class=" light-blue-text"><b><?php echo $LANG["discount"]; ?></b></p>
                                                <p><?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]); ?><?php echo $discountMoney ; ?> <?php echo $discountPer; ?></p>
                                                <?php } ?> 
												<div class="divider"></div>
                                                    								   
                                                <p class=" text-success light-blue-text"><b><?php echo $LANG["total"]; ?></b></hp>
                                                <h5 class="text-success"><?php echo $displayPayAmount ; ?></h5>
                                                <div class="divider"></div>
                                                <p class="text-success light-blue-text"><b><?php echo $LANG["payment_method"]; ?></b></p>
                                                <p class="text-success"><?php echo $gatewayData["name"]; ?></p>
                                                <br>

					  
					  
					  
					  
					  </div>
					  
					  </div>
					  
					  
					  
					  
					  
		  <?php if($transactionValue["status"]=="pending"){?> 			  
		    <div class="row">
                        <div class="col s11 m12 padding-3">		     
                               <?php $btn = '<button id="payNowButton" class="btn btn-success waves-effect waves-light left-on-sm-only  right" type="submit" >'. $LANG["pay_now"]. '</button>'; ?>
                              <?php echo paymentData($transactionValue,$userInfo,$paymentMethod,$btn);?>
							 
                       </div>
                       </div>
                  <?php } ?>
                          </div>
					     </div>
                                     <?php if($transactionValue["status"]!="pending"){?> 	    
                                        
                                        <center>  <p class="text-danger">  <?php echo $LANG["transaction_could_not_be_initiated_because_it_was_settled_and_completed"]?></p></center>
                                     <?php } ?>
                
					     </div>
					  
                    </div>
                  </div>
                </div>
              </div>
               





</div>
</div>
</div>
<?php include "../include/footer.php" ;?>
