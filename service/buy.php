<?php include "../include/ini_set.php" ;?>
<?php include "../include/header.php" ;?>
<?php include "../include/data_config.php" ;?>
<?php include "../include/filter.php" ;?>
<style>
    .minMax{
        font-weight: bold;
    }
</style>

        <?php  $id = xcape($conn,$_GET["id"]); $sql = "SELECT plan_fixed_price,plan_name,plan_display_name,plan_field_required, name, id, display_name,amount_name,image,html_tag,active,fee,fee_capped,fee_percentage,max,min FROM service WHERE id='$id' OR name='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); $id = $serviceValue["id"]; if($serviceValue["active"]==1){ ?>
<?php
 $settingButton = $LANG["service_settings"] ; $new = xcape($conn, $_GET["new"]); if($new=='true'){ $settingButton = $LANG["skip"]; } ?>
	

<?php  if(!empty($serviceValue["min"]) && !empty($serviceValue["max"]) && $serviceValue["min"]!="0" && $serviceValue["max"]!="0"){ $maxMin = "<div class=\"minMax \">{$LANG["min"]}:". htmlspecialchars_decode($webConfig["currency"]["symbol"])."{$serviceValue["min"]} {$LANG["and"]} {$LANG["max"]}:". htmlspecialchars_decode($webConfig["currency"]["symbol"])."{$serviceValue["max"]} </div>"; } ?>
	
	
 <title><?php echo $LANG["buy_service"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
  <?php echo htmlspecialchars_decode($serviceValue['html_tag']) ;?>
  <section id="content">
        
         
	 
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l12 custom-form-control">
                    <div  class="card-panel  hoverable ">
                       
                         <p  class="caption valign left"> 
                             <strong> <?php echo $serviceValue['display_name'] ;?></strong>
                         </p>
                         <img style="width: 100px; height: 100px" class="h-sm-30 right" src="//<?php echo $webConfig["webLink"]?>/uploads/service/<?php echo $serviceValue["image"]?>" />
                        
                        <hr class="clearfix">
	
                    
                      <div class="row  flexbox">
 <form name="systemServiceForm" method="post" class="col s12 my12" action="../buy/">
		<input name="systemService" value="<?php echo $id ?>" type="hidden" >
					<div class="row">
		<?php
 $amountName = ""; $phoneName = ""; $emailName = ""; $sql = "SELECT value, name FROM form WHERE (name = 'system-load-plans' OR name='system-load-form' || name='system-load-setup') AND service='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { if($row["name"]=="system-load-setup"){ $setupContents = json_decode(file_get_contents($row["value"]),true); if($setupContents==null || !is_array($setupContents)){ $loadSetup = false; }else{ $loadSetup = true; $emailName = $setupContents["emailName"]; $phoneName = $setupContents["phoneName"]; $amountName = $setupContents["amountName"]; } } if(is_array($setupContents["plan"]) && $loadSetup == true){ $plansContents = $setupContents["plan"]; } if(is_array($setupContents["form"]) && $loadSetup == true){ $formContents["form"] = $setupContents["form"]; } if($row["name"]==="system-load-plans"){ $plansContents = json_decode(file_get_contents($row["value"]),true); if($plansContents==null || is_array($plansContents)){ $loadPlan = false; } } if(is_array($plansContents)){ $loadPlan = true; $plans = $plansContents["list"]; if(empty($phoneName)){ $phoneName = $plansContents["phoneName"]; } if(empty($serviceValue['plan_display_name'])){ $serviceValue['plan_display_name'] = $plansContents["plan_display_name"]; } if(!empty($plansContents['plan_name'])){ $serviceValue['plan_name'] = $plansContents["plan_name"]; } if(empty($phoneName)){ $phoneName = $plansContents["phoneName"]; } if(empty($emailName)){ $emailName = $plansContents["emailName"]; } if(empty($amountName)){ $amountName = $plansContents["amountName"]; } } if($row["name"]=="system-load-form" && !is_array($formContents["from"])){ $formContents = json_decode(file_get_contents($row["value"]),true); } if($formContents==null || !is_array($formContents["form"])){ $loadForm = false; }else{ $loadForm = true; $form = $formContents["form"]; if(empty($phoneName)){ $phoneName = $formContents["phoneName"]; } if(empty($emailName)){ $emailName = $formContents["emailName"]; } if(empty($amountName)){ $amountName = $formContents["amountName"]; } } } } if(!empty($phoneName)){ $conn->query("UPDATE service SET phone_name='$phoneName' WHERE id='{$serviceValue["id"]}'"); } if(!empty($emailName)){ $conn->query("UPDATE service SET email_name='$emailName' WHERE id='{$serviceValue["id"]}'"); } if(!empty($amountName)){ $serviceValue["amount_name"] = $amountName; $conn->query("UPDATE service SET amount_name='$amountName' WHERE id='{$serviceValue["id"]}'"); } ?>                      
                    <?php
 if($loadPlan==false){ $sql = "SELECT * FROM plans WHERE active='1' AND service='$id' ORDER BY price ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { $planNotFound = false; while($row = $result->fetch_assoc()){ $plans[] = $row; } } } if(is_array($plans)){ foreach ($plans as $row) { $planPrice =""; if(!empty($row["price"])){ $planPrice =" - ".htmlspecialchars_decode($webConfig["currency"]["symbol"]).number_format($row["price"]); } $plansValue .="<option data-price=\"{$row["price"]}\" value=\"{$row["value"]}\">{$row["display_name"]} $planPrice  </option>"; }?>
                        
                                            
            <select id="systemPlan" onchange="fixedPrice(<?php echo $serviceValue["plan_fixed_price"]==1?"true":"false";?>)" <?php if($serviceValue["plan_field_required"] == 1){echo "required";}?> name="<?php echo $serviceValue["plan_name"]?>">
                <option value=""> <?php echo $serviceValue["plan_display_name"];?></option>
                <?php echo $plansValue?>
            </select> 
            <?php  }else{ $planNotFound = true; } ?>
           <span id="hiddenAmount"></span>
                                            
                    <?php  $col ="s12"; $fieldNotFound=true; if($loadForm == FALSE){ $sql = "SELECT name,display_name,value, required, regx, description, class_name, type, max_len,attribute FROM form WHERE type <> 'header' AND type <> 'server' AND type <> 'curl_param' AND name <> 'system-load-plans' AND name <> 'system-load-form' AND name <> 'system-load-display-value' AND name <> 'system-load-setup' AND service='$id'   ORDER BY order_key,reg_date DESC"; $result = $conn->query($sql); if ($result->num_rows > 0) { $fieldNotFound=false; while($row = $result->fetch_assoc()){ $form[]= $row; } } } if(is_array($form)){ $fieldNotFound=false; foreach($form as $row) { $pattern =""; $name = $row["name"]; $displayName = $row["display_name"]; $value = htmlspecialchars_decode($row["value"]); $type = $row["type"]; $class = $row["class_name"]; $max = $row["max_len"]; $attribute = htmlspecialchars_decode($row["attribute"]); $description = ""; if($row["required"]=='1'){ $required = "required"; } if($serviceValue["amount_name"]==$name){ $displayName .= " (".htmlspecialchars_decode($webConfig["currency"]["symbol"]).")"; } if(!empty($row["regx"])){ $pattern = "pattern = \"".$row["regx"]."\" "; } if(!empty($row["description"])){ $class .=" tooltipped"; $description = 'data-position="bottom" data-tooltip="'.$row["description"].'"'; } $input = "<div class=\"row $class\" $description >
                                   <div class=\"input-field col s12\"  >
                                     <input maxlength=\"$max\" value=\"$value\" $pattern $attribute name=\"$name\" type=\"$type\" $required />
                                     <label for=\"$name\">$displayName</label>
                                     </div>
                             </div>"; if($type=="hidden"){ $input = "
                                     <input maxlength=\"$max\" value=\"$value\" $pattern $attribute name=\"$name\" type=\"hidden\" $required />
                             "; } if($type=="option"){ $input = "<div class=\"row $class\" $description >
                                   <div class=\"input-field col s12\"  >
                                     <select $attribute name=\"$name\" $required >
                                            $value;
                                           </select>
                                           <label>$displayName</label>
                                     </div>
                             </div>"; } if($type=="textarea"){ $input = "<div  class=\"row $class\" $description >
                                   <div class=\"input-field col s12\"  >
                                     <textarea class=\"materialize-textarea\" $pattern $attribute name=\"$name\" $required ></textarea>
                                     <label for=\"$name\">$displayName</label>
                                     </div>
                             </div>"; } if($type=="reset"){ $col ="s6"; $input =""; $reset = "<div class=\"input-field col s6 $class\" $description >
                             <button class=\"btn waves-effect waves-light left\" type=\"reset\" >$value
                               <i class=\"material-icons right\">restore</i>
                             </button>
                           </div>"; } if($type=="file"){ $input = "<div class=\"file-field input-field $class\" $description >
                                     <div class=\"btn waves-effect waves-light\">
                                           <span>$displayName</span>
                                           <input type=\"file\" $attribute>
                                     </div>
                                     <div class=\"file-path-wrapper\">
                                           <input disabled class=\"file-path  validate\" type=\"text\" placeholder=\"$description\">
                                     </div>
                                   </div>"; } if($type=="checkbox" || $type=="radio"){ $iid = $name.mt_rand(); $input = "
                                   <p class=\"$class\" $description >
                                     <input  value=\"$value\" $attribute name=\"$name\" type=\"$type\" id=\"$iid\" />
                                     <label for=\"$iid\">$displayName</label>
                                   </p>
                                   "; } if($type=="switch"){ $input = "<div class=\"switch col s12 $class\" $description >
                           <div class=\"switch\">
                                   <label>
                                     <input value=\"$value\" $attribute type=\"checkbox\" name=\"$name\">
                                         $displayName
                                     <span class=\"lever\"></span>
                                   </label>
                             </div>
                             </div>"; } if($type=="date"){ $input = "<div class=\"row $class\" $description >
                                   <div class=\"input-field col s12\"  >
                                     <input class=\"datepicker\" maxlength=\"$max\" value=\"$value\" $pattern $attribute name=\"$name\" type=\"text\" $required />
                                     <label for=\"$name\">$displayName</label>
                                     </div>
                             </div>"; } if($type=="custom"){ $input = "<div class=\"row $class\" $description >
                                   <div class=\"input-field col s12\"  >
                                     <input  maxlength=\"$max\" value=\"$value\" $pattern $attribute name=\"$name\"  $required />
                                     <label for=\"$name\">$displayName</label>
                                     </div>
                             </div>"; } if($type=="html"){ $input = "<!--$displayName $description -->
                                  
                                 ". htmlspecialchars_decode($value) ." 
                                  
                               " ; } if($serviceValue["amount_name"]==$name){ $input .=$maxMin; } echo $input; } } ?>			  
						
			<?php if($planNotFound===false || $fieldNotFound===false){?>			  
                          
                            <div class="row">
							<?php echo $reset;?>
                              <div class="input-field col <?php echo $col; ?>">
                                <button  class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["continue"] ;?>
                                  <i class="material-icons right">send</i>
                                </button>
                              </div>
							 
                            </div>
                        <?php }?>
                          </div>
                        </form>
                    
                
 </div>
                    </div>
                  </div>
                </div>
              </div>
               

<script>
   var form =  document.forms.systemServiceForm;
   var amount =  form.<?php echo trim($serviceValue["amount_name"])?>;
function fixedPrice(fixed=false){
    
    value = getId('systemPlan').value;
    price = document.querySelector("#systemPlan option[value='"+value+"']").getAttribute("data-price");
    if(value!=""){
    if(fixed==true && price!="" && price!=0){
      amount.style.cursor="not-allowed";
      amount.value=price;
	  amount.focus();
	 amount.disabled="disabled";
      getId("hiddenAmount").innerHTML='<input value="'+price+'" name="<?php echo trim($serviceValue["amount_name"])?>" type="hidden">';
    }else{
      amount.style.cursor="default";
      amount.disabled="";
      amount.value="";
      getId("hiddenAmount").innerHTML='';
    }
    }else{
      amount.style.cursor="default";
      amount.disabled="";
      amount.value="";
      getId("hiddenAmount").innerHTML=''; 
    }
} 
</script>
<?php
 }else{ openAlert($LANG["service_is_temporary_unavailable_please_check_back_leter"]); } }else{ openAlert($LANG["service_cannot_be_found"],$LANG["an_error_occurred"],"error"); } ?>

                          

</div>
</div>

<?php include "../include/footer.php" ;?>