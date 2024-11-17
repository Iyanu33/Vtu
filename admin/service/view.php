 <?php include "../../include/ini_set.php"; ?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>  
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["service"]);  
?>
 
   <?php 
	   $id = xcape($conn,$_GET["id"]);
	   
	   $sql = "SELECT * FROM service WHERE id='$id' OR name='$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
			//print_r($serviceValue);
	  ?>
	  
	 <title> <?php echo $serviceValue["display_name"]?> - <?php echo $LANG["service_overview"]?> </title>
	 
   <?php 
		$totalTransaction = $conn->query("SELECT id FROM recharge WHERE service_id='$id'")->num_rows;
		$totalTransactionPer = round(($totalTransaction/$conn->query("SELECT id FROM recharge")->num_rows)*100,1);
		$successTransaction = $conn->query("SELECT id FROM recharge WHERE service_id='$id' AND status='success'")->num_rows;
		$pendingTransaction = $conn->query("SELECT id FROM recharge WHERE service_id='$id' AND status='pending'")->num_rows;
		$failedTransaction = $conn->query("SELECT id FROM recharge WHERE service_id='$id' AND status='failed'")->num_rows;
	?>
  
	  
	  
	  

  <section id="content">
          <!--start container-->
          <div class="container">
            <!--card stats start-->
            <div id="card-stats">
              <div class="row mt-1">
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text hoverable">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">add_shopping_cart</i>
                        <p><?php echo $LANG["all_transactions"]; ?></p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <p class="mb-0"><?php echo $totalTransactionPer; ?>%</p>
                        <h5 class="mb-0"><?php echo $totalTransaction; ?></h5>
                       
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text hoverable">
                    <div class="padding-4">
                      <div class="col s7 m7 left-align">
					   <i class="material-icons background-round mt-5">error</i>
					  </div>
                      <div class="col s5 m5 right-align">
					 
                        <p class="mb-0"><?php echo round(($failedTransaction/$totalTransaction)*100,1);?>%</p>
                        <h4 class="no-margin"><?php echo $failedTransaction;?></h4>
                      </div>
					   <div class="col s12">
                        
                        <p><?php echo $LANG["failed_transaction"];?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text hoverable">
                   <div class="padding-4">
                      <div class="col s7 m7 left-align">
					   <i class="material-icons background-round mt-5">restore</i>
					  </div>
                      <div class="col s5 m5 right-align">
					 
                        <p class="mb-0"><?php echo round(($pendingTransaction/$totalTransaction)*100,1);?>%</p>
                        <h4 class="no-margin"><?php echo $pendingTransaction;?></h4>
                      </div>
					   <div class="col s12">
                        
                        <p><?php echo $LANG["pending_transaction"];?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text hoverable">
                    <div class="padding-4">
                      <div class="col s7 m7 left-align">
					   <i class="material-icons background-round mt-5">done</i>
					  </div>
                      <div class="col s5 m5 right-align">
					 
                        <p class="mb-0"><?php echo round(($successTransaction/$totalTransaction)*100,1);?>%</p>
                        <h4 class="no-margin"><?php echo $successTransaction;?></h4>
                      </div>
					   <div class="col s12">
                        
                        <p><?php echo $LANG["successful_transaction"];?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          
            <!--card widgets start-->
            <div id="card-widgets">
              <div class="row">
			  
                <div class="col s12 m4 l4">
                  <ul id="task-card" class="collection with-header  hoverable">
                    <li class="collection-header teal accent-4">
                      <h4 class="task-card-title"><?php echo $LANG["general"]?></h4>
                    </li>
                                      
					
					
					<li class="collection-item">
                      <?php echo $LANG["display_name"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["display_name"] ?>
                        </span> 
                      
                    </li>  
					<li class="collection-item">
                      <?php echo $LANG["name"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["name"] ?>
                        </span> 
                      
                    </li>  					
					
					<li class="collection-item">
                      <?php echo $LANG["status"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["active"]==1 ? $LANG["active"] : $LANG["disabled"]; ?>
                        </span> 
                      
                    </li> 
					
					
					<li class="collection-item">
                      <?php echo $LANG["available_on_api"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["api"]==1 ? $LANG["yes"] : $LANG["no"]; ?>
                        </span> 
                      
                    </li>                    
					
					<li class="collection-item">
                      <?php echo $LANG["category"]?>
                        <span class="secondary-content">
                          <?php echo !empty($categoryValue["display_name"]) ? $categoryValue["display_name"] : "NONE"; ?>
                        </span> 
                      
                    </li>
					
					
					
                  </ul>
                </div>

				<div class="col s12 m4 l4">
                  <ul id="task-card" class="collection with-header  hoverable">
                    <li class="collection-header teal accent-4">
                      <h4 class="task-card-title"><?php echo $LANG["pricing"]?></h4>
                    </li>
                    <li class="collection-item">
                      <?php echo $LANG["max_amount"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["max"] ?>
                        </span> 
                      
                    </li>                      
					
					<li class="collection-item">
                      <?php echo $LANG["min_amount"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["min"] ?>
                        </span> 
                      
                    </li>  
					
					                 
					
					<li class="collection-item">
                      <?php echo $LANG["fee_charge"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["fee"] ?>
                        </span> 
                      
                    </li> 
					
					<li class="collection-item">
                      <?php echo $LANG["fee_percentage"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["fee_percentage"]==1 ? $LANG["yes"] : $LANG["no"]; ?>
                        </span> 
                      
                    </li>  
					
					<li class="collection-item">
                      <?php echo $LANG["fee_capped_at"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["fee_capped"] ?>
                        </span> 
                      
                    </li>  
					
                  </ul>
                </div>
				
				
				<div class="col s12 m4 l4">
                  <ul id="task-card" class="collection with-header  hoverable">
                    <li class="collection-header teal accent-4">
                      <h4 class="task-card-title"><?php echo $LANG["notification"]?></h4>
                    </li>
                    
					
					
					
					
					<li class="collection-item">
                      <?php echo $LANG["sms_to_user"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["sms_alert"]==1 ? $LANG["yes"] : $LANG["no"]; ?>
                        </span> 
                      
                    </li>  
					
					<li class="collection-item">
                      <?php echo $LANG["email_to_user"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["email_alert"]==1 ? $LANG["yes"] : $LANG["no"]; ?>
                        </span> 
                      
                    </li> 

					<li class="collection-item">
                      <?php echo $LANG["sms_to_me"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["sms_alert_me"]==1 ? $LANG["yes"] : $LANG["no"]; ?>
                        </span> 
                      
                    </li> 
					
					<li class="collection-item">
                      <?php echo $LANG["email_to_me"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["email_alert_me"]==1 ? $LANG["yes"] : $LANG["no"]; ?>
                        </span> 
                      
                    </li>  
					
					<li class="collection-item">
                      <?php echo $LANG["email_failed"]?>
                        <span class="secondary-content">
                          <?php echo $serviceValue["email_failed"]==1 ? $LANG["yes"] : $LANG["no"]; ?>
                        </span> 
                      
                    </li>  
					
					 
					
                  </ul>
                </div>
               
               
              </div>
            </div>
            <!--card widgets end-->
    <div class="card-panel  hoverable ">
   <p class="card-title"><?php echo $LANG["form_field_list"]?></p>
  <?php	
		$service =  $serviceValue["id"];
			$sql = "SELECT * FROM form  WHERE service='$service' ORDER BY display_name ASC";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
?>
   <table class="highlight">
        <thead>
          <tr>
              <th> <?php echo $LANG["display_name"]?></th>
              <th> <?php echo $LANG["name"]?></th>
              <th> <?php echo $LANG["type"]?></th>
              <th> <?php echo $LANG["value"]?></th>
              <th> <?php echo $LANG["required"]?></th>
              <th rowspan="4"> <?php echo $LANG["action"]?></th>
          </tr>
        </thead>
        <tbody>   
		
		<?php
				// output data of each row
			  while($row = $result->fetch_assoc()) {
			  $id = $row["id"];
			  $displayName = $row["display_name"];
			  $value = empty($row["vale"])? "NULL" : htmlspecialchars_decode($row["value"]);
			  $type = $row["type"];
			  $required = ucfirst($row["required"]==1 ? $LANG["yes"] : $LANG["no"]);
			  $name = $row["name"];
	echo "<tr>
            <td>$displayName</td>
            <td>$name</td>
            <td>$type</td>
            <td>$value</td>
            <td>$required</td>
            <td>
			
	          <td><a href=\"edit-form.php?id=$id\" class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["edit"])."\" href=\"setting.php?id=$id\"><i class=\"material-icons right\">edit</i></a></td>
			  <td><button onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_service_form.php?id=$id')\"  class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["delete"])."\" ><i class=\"material-icons right\">delete</i></button>
			
			
			</td>
          </tr>
			";
			
			  }
			}
		?>
			
			
		</tbody>
      </table>
            	
		</div>	  
		
		
<div class="card-panel  hoverable ">
   <p class="card-title"><?php echo $LANG["plan_list"]?></p>
   <?php	
		$service =  $serviceValue["id"];
			$sql = "SELECT * FROM plans  WHERE service = '$service' ORDER BY display_name ASC";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				?>
   <table class="highlight">
        <thead>
          <tr>
              <th> <?php echo $LANG["display_name"]?></th>
              <th> <?php echo $LANG["price"]?></th>
              <th> <?php echo $LANG["value"]?></th>
              <th class="right-align" rowspan="4"> <?php echo $LANG["action"]?></th>
          </tr>
        </thead>
        <tbody>   
		<?php
		
				// output data of each row
			  while($row = $result->fetch_assoc()) {
			  $id = $row["id"];
			  $displayName = $row["display_name"];
			  $value = htmlspecialchars_decode($row["value"]);
			  $price = $row["price"];
			  $fixedPrice = ucfirst($row["fix_price"]==1 ? $LANG["yes"] : $LANG["no"]);
			 
	echo "<tr>
            <td>$displayName</td>
            <td>$price</td>
            <td>$value</td>
            <td>
			
	          <td><a href=\"edit-plan.php?id=$id\" class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["edit"])."\" href=\"setting.php?id=$id\"><i class=\"material-icons left\">edit</i></a></td>
			  <td><button onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_service_plan.php?id=$id')\"  class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["delete"])."\" ><i class=\"material-icons right\">delete</i></button>
			
			
			</td>
          </tr>
			";
			
			  }
			}else{
				echo $LANG["no_record_found"];
			}
		?>
			
			
		</tbody>
      </table>
            	
		</div>	 


		
<div class="card-panel  hoverable ">
   <p class="card-title">Display Value List</p>
   <?php	
		$service =  $serviceValue["id"];
			$sql = "SELECT * FROM display_value  WHERE service = '$service' ORDER BY display_name ASC";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				?>
   <table class="highlight">
        <thead>
          <tr>
              <th> <?php echo $LANG["display_name"]?></th>
              <th> <?php echo $LANG["name"]?></th>
              <th class="right-align" rowspan="4"> <?php echo $LANG["action"]?></th>
          </tr>
        </thead>
        <tbody>   
		<?php
		
				// output data of each row
			  while($row = $result->fetch_assoc()) {
			  $id = $row["id"];
			  $displayName = $row["display_name"];
			  $name = $row["name"];
	echo "<tr>
            <td>$displayName</td>
            <td>$name</td>
            <td>
			
	          <td><a href=\"edit_display_value.php?id=$id\" class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["edit"])."\" href=\"setting.php?id=$id\"><i class=\"material-icons left\">edit</i></a></td>
			  <td><button onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_service_display_value.php?id=$id')\"  class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["delete"])."\" ><i class=\"material-icons right\">delete</i></button>
			
			
			</td>
          </tr>
			";
			
			  }
			}else{
				echo $LANG["no_record_found"];
			}
		?>
			
			
		</tbody>
      </table>
            	
</div>	 

			
						
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a <?php echo "onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"].'('.$LANG["copy_service"].')')."','../../processor/service_copy.php?id={$serviceValue['id']}','','','POST','info')\"" ?>  href="javaScript:void(0)" data-position="left" data-tooltip="<?php echo ucfirst($LANG["copy_service"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">content_copy</i></a></li>
      <li><a href="advance.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["html_tag"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">code</i></a></li>
      <li><a <?php echo "onclick=\"ajaxConfirm('".ucfirst($LANG["clear_all_transactions_data_for_this_service_this_action_cannot_be_undo"])."','../../processor/delete_transaction.php?id={$serviceValue['id']}')\"" ?>  href="javaScript:void(0)" data-position="left" data-tooltip="<?php echo ucfirst($LANG["clear_records"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">clear</i></a></li>
      <li><a href="gateway.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["gateway_edit"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">http</i></a></li>
      <li><a href="display_value.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_display_value"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">credit_card</i></a></li>
      <li><a href="plan.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_plan"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">subscriptions</i></a></li>
      <li><a href="form.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="setting.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">settings</i></a></li>
    </ul>
  </div>
		
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--end container-->
        </section>
		    <!-- END MAIN -->
			</div>
			</div>
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>