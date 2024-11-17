<?php include "../../include/ini_set.php"; ?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>

 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["currency"]);
     
?>

 
 
 
 <title><?php echo $LANG['create_new_currency']; ?></title>
  <section id="content">
        <div id="scroll"></div>
        
          <div class="container">
		   <p class="caption"><?php echo $LANG['create_new_currency']; ?></p>
              <div class="divider"></div>
			  
            <div class="section flexbox">
             
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
                      <div class="row">
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/new_currency.php',getId('scroll'));" >
						 <div class="row">
							
						<div class="input-field col s12" >
							  <input required  id="name" name="name" type="text" value="">
							  <label for="name"><?php echo $LANG['display_name']; ?></label>
							  </div>
						  </div> 
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input required placeholder="NGN"  id="code" name="code" type="text" value="">
							  <label for="name"><?php echo $LANG['currency_code']; ?></label>
							  </div>
						  </div> 
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input required placeholder="&#***;"  id="symbol" name="symbol" type="text" value="">
							  <label for="name"><?php echo $LANG['currency_symbol']; ?></label>
							  </div>
						  </div> 
						  
						<div class="row">
							<div class="input-field col s8" >
							  <input required   id="rate" name="rate" type="text" value="">
							  <label for="name"><?php echo $LANG['rate_to_system_currency']; ?></label>
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
					    </div> 
							  
                          
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['create']; ?>
                                  <i class="material-icons right">add</i>
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
   
   
   
   
   
   
   
   
   
   
       <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>">
    <a href="index.php" class="btn-floating btn-large">
      <i class="large material-icons">home</i>
    </a>
  </div>
   
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>