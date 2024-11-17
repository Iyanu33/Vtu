 <?php include "../../include/ini_set.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
  <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["payment"]); ?>

 <title>Monnify Reserved Account</title>
  <section id="content">
   <?php  $sql = "SELECT 
	  var1,
          var2,
          var3,
          var4,
          var5,
          var6,
          var7
	  FROM third_party_feature WHERE name='monnify_reserved_account'"; $value = $conn->query($sql)->fetch_assoc(); ?>
			  
            <div class="section flexbox">
             
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
                      <div class="row">
                          <div style="font-weight: bolder"> Please only use your LIVE KEYS from Monnify.</div>
                          <br/>
                          <br/>
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/edit_reserved_account.php');" >
						 <div class="row">
							<div class="input-field col s12" >
							  <input  id="apiKey" name="apiKey" type="text" value="<?php echo $value["var1"]?>">
							  <label for="apiKey">API Key</label>
							  </div>
						  </div>
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input  id="secreteKey" name="secreteKey" type="text" value="<?php echo $value["var2"]?>">
							  <label for="secreteKey">Secrete Key</label>
							  </div>
						  </div>
                          
                                                   <div class="row">
							<div class="input-field col s12" >
							  <input  id="contractCode" name="contractCode" type="text" value="<?php echo $value["var3"]?>">
							  <label for="contractCode">Contract Code</label>
							  </div>
						  </div>
                            
                                                   <div class="row">
							<div class="input-field col s6" >
							  <input  id="fee" name="fee" type="text" value="<?php echo $value["var4"]?>">
							  <label for="fee">Fee</label>
							  </div>
                                                       
                                                       <br/>
                                                       <br/>
                                                        <div class="switch col s6 "  >

                                                                         <div class="switch">
                                                                        <label>

                                                                          <input <?php if($value["var5"]==1){echo "checked";} ?> value="1" type="checkbox" name="feePercentage">
                                                                          <span class="lever"></span>
                                                                          Fee in Percentage
                                                                        </label>
                                                                  </div>
                                                            </div>
                                                      
						  </div>
       
                                 <div class="row">
                               
                                <div class="switch col s6 "  >
                                <br/>
                                      <div class="switch">
                                               <label>

                                                 <input <?php if($value["var6"]==1){echo "checked";} ?> value="1" type="checkbox" name="active">
                                                 <span class="lever"></span>
                                                 Active
                                               </label>
                                         </div>
                                     </div> 
                                     
                                <div class="switch col s6 "  >
                                <br/>
                                      <div class="switch">
                                               <label>

                                                 <input <?php if($value["var7"]==1){echo "checked";} ?> value="1" type="checkbox" name="noKYC">
                                                 <span class="lever"></span>
                                                 No KYC Verification
                                               </label>
                                         </div>
                                     </div> 
                                
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" >Save
                                  <i class="material-icons right">save</i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>
   
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>