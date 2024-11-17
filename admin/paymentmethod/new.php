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
  $sql = "SELECT name, id FROM payment_gateway_data ORDER BY name ASC";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
		  while($row = $result->fetch_assoc()){
		    $gateway = "<option $selected value=\"{$row['id']}\">{$row['name']}</option>$gateway";
		  }
		}else{
			$gateway = false;
		}

?>
 
 
 
 <title><?php echo $LANG['create_new_payment_method']; ?></title>
  <section id="content">
        
        
          <div class="container">
		   <p class="caption"><?php echo $LANG['create_new_payment_method']; ?></p>
              <div class="divider"></div>
			  
            <div class="section flexbox">
             
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
                      <div class="row">
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/new_payment_method.php');" >
						 <div class="row">
							<div class="input-field col s12" >
							  <input required  id="name" name="name" type="text" value="">
							  <label for="name"><?php echo $LANG['display_name']; ?></label>
							  </div>
						  </div>
						  
						    
							<div class="input-field"  >
								<select name="gateway" required>
								<option value=""><?php echo $LANG["select_one_option"] ;?></option>
								 
								<?php echo $gateway ; ?>
								 
								 
								</select>
								<label><?php echo $LANG["payment_gateway"] ;?></label>
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