  <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/payment_method_setting_general.php');" >
						 
						  <input name="id" value="<?php echo $methodValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
							<div class="input-field col s12" >
							  <input  id="displayName" name="name" type="text" value="<?php echo $methodValue['name']; ?>">
							  <label for="displayName"><?php echo $LANG['display_name']; ?></label>
							  </div>
						 
							  
							 
						  
						  
						 
								<div class="input-field col s12">
								<select name="gateway" >
								 <option><?php echo $LANG["select_one_option"] ;?></option>
								<?php echo $gatewayOption ;?>
								 
								 
								</select>
								<label><?php echo $LANG["payment_gateway"] ;?></label>
						      </div>
							  
							  
						      <div class="input-field col s8">
								<select name="currency" >
								 <option><?php echo $LANG["select_one_option"] ;?></option>
								<?php echo $currencyOption ;?>
								 
								 
								</select>
                                                          <label><?php echo $LANG["currency"] ;?> <i><?php echo $LANG["will_be_converted_to_system_currency"] ;?></i></label>
						      </div>
							  
							
							  
							  
							  
						    
						
						
						
						 
							
				
						  
						  
						  			  
					    <div class="switch col s4"  >
					    <br/>
						<br/>
							 <div class="switch m-0 p-">
							<label>
							
							  <input <?php if($methodValue['active']==1){echo "checked";} ?> value="1" type="checkbox" name="active">
							  <span class="lever"></span>
							  <?php echo ucfirst($LANG["active"]) ;?>
							</label>
						  </div>
					    </div> 	
                                             <?php if($gatewayValue["is_testable"]==1){?>
						<br/>
						<br/>	  
						<div class="switch col s12 p-0 m-0"  >
					
							 <div class="switch m-0 p-">
							<label>
							
							  <input <?php if($methodValue['test_mode']==1){echo "checked";} ?> value="1" type="checkbox" name="testMode">
							  <span class="lever"></span>
							  <?php echo $LANG["test_mode"] ;?>
							</label>
						  </div>
					         </div> 	
                                             <?php } ?>
                                                
                                                
                                                
						<br/>
						<br/>
                                                
						<div class="switch col s12 p-0 m-0"  >
					
							 <div class="switch m-0 p-">
							<label>
							
							  <input <?php if($methodValue['use_wallet']==1){echo "checked";} ?> value="1" type="checkbox" name="useWallet">
							  <span class="lever"></span>
							  <?php echo $LANG["available_for_wallet_topup"] ;?>
							</label>
						  </div>
					    </div> 	

						<br/>
						<br/>
					    <div class="switch col s12 p-0 m-0"  >
					
							 <div class="switch">
							<label>
							
							  <input <?php if($methodValue['use_recharge']==1){echo "checked";} ?> value="1" type="checkbox" name="useRecharge">
							  <span class="lever"></span>
							  <?php echo ucfirst($LANG["available_for_direct_recharge"]) ;?>
							</label>
						  </div>
					    </div> 
						  
                         		 
				 </div> 
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['save']; ?>
                                  <i class="material-icons right">save</i>
                                </button>
                              </div>
                          </div>
                      
                        </form>
						
						
                    </div>
                  </div>
                </div>
               </div>
            </div>
        </section>
                