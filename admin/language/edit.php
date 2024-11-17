 <?php include "../../include/ini_set.php" ;?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["language"]); 
?>
  <?php 
	   $id = xcape($conn,$_GET["id"]);
	   
	   $sql = "SELECT * FROM lang WHERE id='$id' OR code = '$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$currencyValue = $result->fetch_assoc();
		}else{
			$currencyValue["notFound"] = true;
		}
			//print_r($currencyValue);
			$id = $currencyValue["id"];
			$name = $currencyValue["name"];
			$symbol = $currencyValue["symbol"];
			$code = $currencyValue["code"];
			$rate = $currencyValue["rate"];
	  ?>
	  
	
     
 <title><?php echo ucfirst($LANG['edit']); ?> -  <?php echo $name;?></title>
  <section id="content">
        <div id="scroll"></div>
        
          <div class="container">
              <p class="caption"><?php echo ucfirst($LANG['edit']); ?> - <?php echo $name;?></p>
              <div class="divider"></div>
			  
            <div class="section flexbox">
             
            
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
                      <div class="row">
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/edit_language.php',getId('scroll'));" >
						 <div class="row">
							<input  name="id" type="hidden" value="<?php echo $id;?>">
							
						<div class="input-field col s12" >
						
							  <input required  id="name" name="name" type="text" value="<?php echo $name;?>">
							  <label for="name"><?php echo $LANG['display_name']; ?></label>
							  </div>
						  </div> 
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input required   id="code" name="code" type="text" value="<?php echo $code;?>">
							  <label for="code"><?php echo $LANG['code']; ?></label>
							  </div>
						  </div> 
						  
						  
						  
						    
						<div class="switch col s4"  >
					        <br/>
						    <br/>
							 <div class="switch m-0 p-">
							<label>
							
							  <input <?php if($currencyValue['active']==1){echo "checked";} ?> value="1" type="checkbox" name="active">
							  <span class="lever"></span>
							  <?php echo ucfirst($LANG["active"]) ;?>
							</label>
						  </div>
					    </div> 
					    </div> 
							  
                          
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['edit']; ?>
                                  <i class="material-icons right">edit</i>
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
   
   
    <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
        <li><a href="../module.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["install_new_language"]) ?>" class="btn-floating tooltipped"><i class="material-icons">font_download</i></a></li>
      <li><a href="index.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["language"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
      
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
	
	

  </body>
</html>