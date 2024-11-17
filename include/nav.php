<?php 
   session_start();
   $loginUser = $_SESSION["login_user"];
   ?>
   
  <style>
                @media only screen and (min-width: 600px) and (max-width: 992px) {
                     .custom-menu-icon{margin-top: -3}
                    }
                  
              
            </style> 
   
<?php include includeCheck('include/data_config.php');?>
<?php include includeCheck('include/webconfig.php');?>
<?php include includeCheck('account/userbalance.php');?>

	  

 <!-- START LEFT SIDEBAR NAV-->
 <aside class="hide-on-large-only" id="left-sidebar-nav">
     <ul style="top: 0 !important" id="slide-out" class="side-nav fixed leftside-navigation">
           
            <li class="no-padding">
              <ul class="collapsible" data-collapsible="accordion">
                
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/index.php" class="waves-effect waves-cyan">
                      <i class="material-icons">home</i>
                      <span class="nav-text"><?php echo $LANG["home"]?></span>
                    </a>
                </li>
                <?php if(!empty($_SESSION["login_user"])){?>
                  <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/dashboard" class="waves-effect waves-cyan">
                      <i class="material-icons">dashboard</i>
                      <span class="nav-text"><?php echo $LANG["dashboard"]?></span>
                    </a>
                </li>
                <?php } ?>
                
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/about.php" class="waves-effect waves-cyan">
                      <i class="material-icons">info</i>
                      <span class="nav-text"><?php echo $LANG["about_us"]?></span>
                    </a>
                </li>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/pricing" class="waves-effect waves-cyan">
                      <i class="material-icons">attach_money</i>
                      <span class="nav-text"><?php echo $LANG["pricing"];?></span>
                    </a>
                </li>
                 <?php if($webConfig["enableAPI"]==1){?>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/api_doc" class="waves-effect waves-cyan">
                      <i class="material-icons">code</i>
                      <span class="nav-text"><?php echo $LANG["api_documentations"];?></span>
                    </a>
                </li>
                 <?php } ?>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/feedback.php" class="waves-effect waves-cyan">
                      <i class="fa fa-feed"></i>
                      <span class="nav-text"><?php echo $LANG["feedback"];?></span>
                    </a>
                </li>
               
                
               <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1){?>
                 <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/affiliate.php" class="waves-effect waves-cyan">
                      <i class=" fa fa-money "></i>
                      <span class="nav-text"><?php echo $LANG["affiliate"];?></span>
                    </a>
                </li>
                
                <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/pricing/commission_rate.php" class="waves-effect waves-cyan">
                      <i class=" fa fa-money "></i>
                      <span class="nav-text"><?php echo $LANG["commission_rate"];?></span>
                    </a>
                </li>
                
                 <?php } ?>
                
                 <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/faq.php" class="waves-effect waves-cyan">
                      <i class="material-icons">help</i>
                      <span class="nav-text"><?php echo $LANG["faq"];?></span>
                    </a>
                </li>
                
               
                
                
                
                 <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/terms.php" class="waves-effect waves-cyan">
                      <i class="fa fa-legal"></i>
                      <span class="nav-text"><?php echo $LANG["terms_and_conditions"];?></span>
                    </a>
                </li>
                
                
                
              <li class="bold show-on-medium-and-down hidden"><a  onclick="openMobileLang()" class="waves-effect waves-cyan  collapsible-header"  href="javaScript:void(0)"><i class="material-icons">translate</i> <?php echo $LANG["language"]; ?> </a></li>
		   
		   
              <ul id="mobileLang" style="display:none" class="animated">
	         <?php 
             $sql = "SELECT name,file_name FROM lang WHERE active='1' ORDER BY name";
             $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                    // output data of each row
              while($row = $result->fetch_assoc()) {?>
              <li>
                  <a href="javaScript:void(0)" onclick=ajaxRequest('',"//<?php echo $webConfig["webLink"]?>/set_lang.php?id=<?php echo str_ireplace(".php","",$row["file_name"])?>") class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-gb"></i><?php echo $row["name"]?></a>
              </li>
            
              <?php }
             }
             ?>
		 </ul>
                
              </ul>
            </li>
          </ul>
        <a href="#"  style="background:none; box-shadow: none !important" data-activates="slide-out" class="sidebar-collapse left  btn-floating waves-effect waves-ripple left custom-menu-icon ">
            <i style="color: <?php echo $webConfig["navForegroundColor"];?> !important" class="material-icons left">menu</i>
          </a>

     
        </aside>
   
        <div id="loaderDiv"  style="position:fixed; left:0;top:-7;right:0;bottom:0;background:rgba(0,0,0,0.6);z-index:9999999999999999999999999999999999999;display:none">
		        <div class="progress grey">
                            <div style="display:none" id="lajelaLoader1" class="indeterminate red"></div>
                            <div style="display:none" id="lajelaLoader2" class="indeterminate blue"></div>
                            <div  style="display:none" id="lajelaLoader3" class="indeterminate green"></div>    
                         </div>
                            
                        </div>