<?php $month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');?> 
<section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
            
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
				<?php ?>	  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'process/kyc-profile.php');" >
						 
					
						 <div class="row">
							<div class="input-field col s6" >
                                                            <input <?php if($kycVerified){ echo "disabled";}?> required  id="displayName" name="firstName" type="text" value="<?php echo $kyc['first_name']; ?>">
							  <label for="displayName">First Name</label>
							  </div>
						 
							  <div class="input-field col s6"  >
                                                              <input <?php if($kycVerified){ echo "disabled";}?> required id="name" name="lastName" type="text" value="<?php echo $kyc['last_name']; ?>">
							     <label for="name">Last Name</label>
							  </div>
							  
							  <div class="input-field col s6">
							     <input <?php if($kycVerified){ echo "disabled";}?>  id="planName" name="middleName" type="text" value="<?php echo $kyc['middle_name']; ?>">
							     <label for="middleName">Middle Name</label>
							  </div>
							  
							  <div class="input-field col s6">
                                                              <input <?php if($kycVerified){ echo "disabled";}?>  required id="planDisplayName" name="bvn" type="text" value="<?php echo $kyc['bvn']; ?>">
							     <label for="bvn">BVN</label>
							  </div>
                                                       	<div class="input-field col s12">
                                                          
                                                            <label>Date of Birth</label>
                                                            <br/>
                                                        </div>
                                                     
                                                       <div class="input-field col s4">
                                                         <select <?php if($kycVerified){ echo "disabled";}?> required name="birthDay">
                                                           <option value="">Day</option>
                                                            <?php for($i = 1; $i < 32; $i++){?>
                                                               <option <?php if(date("d", $kyc["date_of_birth"]) == $i && !empty($kyc["date_of_birth"])){echo "selected";}?> value="<?php echo $i; ?>"><?php echo $i;?></option>
                                                           <?php } ?>
                                                         </select>
							</div>
                                                     
                                                      <div class="input-field col s4">
                                                         <select <?php if($kycVerified){ echo "disabled";}?> required name="birthMonth">
                                                           <option value="">Month</option>
                                                            <?php for($i = 0; $i < count($month); $i++){?>
                                                           <option  <?php if(date("m", $kyc["date_of_birth"]) == $i+1 && !empty($kyc["date_of_birth"])){echo "selected";}?> value="<?php echo $i+1; ?>"><?php echo $month[$i];?></option>
                                                           <?php } ?>
                                                         </select>
							</div>
							
                                                     
                                                     
                                                         <div class="input-field col s4">
                                                         <select <?php if($kycVerified){ echo "disabled";}?> required  name="birthYear">
                                                           <option value="">Year</option>
                                                            <?php for($i = date("Y")-50; $i < date("Y")-10; $i++){?>
                                                           <option  <?php if(date("Y", $kyc["date_of_birth"]) == $i && !empty($kyc["date_of_birth"])){echo "selected";}?> value="<?php echo $i; ?>"><?php echo $i;?></option>
                                                           <?php } ?>
                                                         </select>
							</div>
                                                     
                                                     
                                                       </div>	  	
                      
                                                <?php if(!empty($kyc["reject_reason"])){?>
                                                <div class=" col s12">
                                                      <?php echo $kyc["reject_reason"]?>
                                                   </div>                            
                                                 <?php } ?>
                            
                            
                              <div class="switch col s12"  >
                                  <br/>
                                  <br/>

                         <div class="switch">
                               <label>
                                 <input <?php if($kycVerified){ echo "disabled";}?> <?php if($kyc["submitted"] == '1'){echo 'checked';}?>  id="submit" value="1" type="checkbox" name="submitted">
                                 <span class="lever"></span>
                                Submit KYC for approval now
                               </label>
                         </div>
                   </div>
                              <div class="input-field col s12">
                                <button <?php if($kycVerified){ echo "disabled";}?> class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['save']; ?>
                                  <i class="material-icons right">save</i>
                                </button>
                              </div>
                          </div>
                      
                        </form>
						
                      </div>
                  </div>
            </div>
          </div>
</section>
  
               
  