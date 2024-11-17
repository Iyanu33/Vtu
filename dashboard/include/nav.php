<style>
#slide-out{
     top:0px !important;
  }
@media only screen and (min-width: 993px) {
  #slide-out {
     top:auto !important;
     width:240px !important;
  }
}
</style>
 <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
              <div class="row">
                <div class="col col s4 m4 l4">
                  <img src="//<?php echo $webConfig["webLink"]?>/account/profile-pix/<?php echo $user['pix']?>" alt="<?php echo $user['name']?>" class="circle responsive-img  valign profile-image cyan">
                </div>
                <div class="col col s8 m8 l8">
                  <ul id="profile-dropdown-nav" class="dropdown-content">
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/account" class="grey-text text-darken-1">
                        <i class="material-icons">face</i><?php echo $LANG["profile"];?></a>
                    </li>
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/account/editprofile.php" class="grey-text text-darken-1">
                        <i class="material-icons">settings</i><?php echo $LANG["edit_profile"];?></a>
                    </li>
            
                    <li class="divider"></li>
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/account/change-password.php" class="grey-text text-darken-1">
                        <i class="material-icons">lock_outline</i><?php echo $LANG["change_password"]; ?></a>
                    </li>
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/account/logout.php" class="grey-text text-darken-1">
                        <i class="material-icons">keyboard_tab</i> <?php echo $LANG["logout"]?></a>
                    </li>
                    
                    
                    
                  </ul>
                  <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown-nav"><?php echo $user['userName']?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                 
                </div>
              </div>
            </li>
            <li class="no-padding ">
              <ul class="collapsible custom-nav" data-collapsible="accordion">
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/index.php" class="waves-effect waves-cyan">
                      <i class="material-icons">home</i>
                      <span class="nav-text"><?php echo $LANG["home"]?></span>
                    </a>
                </li>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/dashboard" class="waves-effect waves-cyan">
                      <i class="material-icons">dashboard</i>
                      <span class="nav-text"><?php echo $LANG["dashboard"];?></span>
                    </a>
                </li>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/service" class="waves-effect waves-cyan">
                      <i class="material-icons">add_shopping_cart</i>
                      <span class="nav-text"><?php echo $LANG["service"]?></span>
                    </a>
                </li>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/transactions" class="waves-effect waves-cyan">
                      <i class="material-icons">shopping_cart</i>
                      <span class="nav-text"><?php echo $LANG["transactions"]?></span>
                    </a>
                </li>
				
			    <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/reserved-account" class="waves-effect waves-cyan">
                      <i class="material-icons">account_balance</i>
                      <span class="nav-text">Reserved Account</span>
                    </a>
                </li>
                
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/payment" class="waves-effect waves-cyan">
                      <i class="material-icons">credit_card</i>
                      <span class="nav-text"><?php echo $LANG["payment"];?></span>
                    </a>
                </li>
                <li class="bold">
                    <a href="//<?php echo $webConfig["webLink"]?>/payment/add.php"  class="waves-effect waves-cyan">
                      <i class="material-icons">account_balance_wallet</i>
                      <span class="nav-text"><?php echo $LANG["fund_wallet"];?></span>
                    </a>
                </li>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/payment/deposit.php" class="waves-effect waves-cyan">
                      <i class="material-icons">account_balance</i>
                      <span class="nav-text"><?php echo $LANG["bank_deposit"];?></span>
                    </a>
                </li>
                <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1){?>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/payment/payout_request.php" class="waves-effect waves-cyan">
                      <i class="material-icons">launch</i>
                      <span class="nav-text"><?php echo $LANG["payout_request"];?></span>
                    </a>
                </li>
                <?php } ?>
                
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/payment/notification.php" class="waves-effect waves-cyan">
                      <i class="material-icons">add_alert</i>
                      <span class="nav-text"><?php echo $LANG["payment_notification"];?></span>
                    </a>
                </li>
               
                
                   
                 <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/payment/payout.php" class="waves-effect waves-cyan">
                      <i class="material-icons">done</i>
                      <span class="nav-text"><?php echo $LANG["payout"];?></span>
                    </a>
                </li>
                 
            <?php if($webConfig["enableAPI"]==1){?>  
                 <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/api_transactions" class="waves-effect waves-cyan">
                      <i class="material-icons">http</i>
                      <span class="nav-text"><?php echo $LANG["api_transactions"];?></span>
                    </a>
                </li>
            <?php } ?>   
               <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1 || $webConfig["enableAPI"]==1){?> 
                 <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/dashboard/key.php" class="waves-effect waves-cyan">
                      <i class="material-icons">vpn_key</i>
                      <span class="nav-text"><?php echo $LANG["key_settings"];?></span>
                    </a>
                </li>
               <?php } ?>
                
               <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1){?>
                 <li class="bold">
                     <a href="//<?php echo $webConfig["webLink"]?>/dashboard/banner.php" class="waves-effect waves-cyan">
                      <i class="material-icons">web</i>
                      <span class="nav-text"><?php echo $LANG["banners"];?></span>
                    </a>
                </li>               
               <?php } ?>
                

              
              <li class="bold show-on-medium-and-down hidden"><a  onclick="openMobileLang()" class="waves-effect waves-cyan  collapsible-header"  href="javaScript:void(0)"><i class="material-icons">translate</i> <?php echo $LANG["language"]; ?> </a></li>
		   
		   
              <ul id="mobileLang" style="display:none" class="animated">
	         <?php  $sql = "SELECT name,file_name FROM lang WHERE active='1' ORDER BY name"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {?>
              <li>
                  <a href="javaScript:void(0)" onclick=ajaxRequest('',"//<?php echo $webConfig["webLink"]?>/set_lang.php?id=<?php echo str_ireplace(".php","",$row["file_name"])?>") class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-gb"></i><?php echo $row["name"]?></a>
              </li>
            
              <?php } } ?>
		 </ul>
                
                
                
              </ul>
            </li>
          </ul>
             
            
           <a href="#" style="background:none; box-shadow: none !important;" data-activates="slide-out" class="sidebar-collapse left  btn-floating waves-effect waves-ripple left hide-on-large-only custom-menu-icon">
               <i style="color: <?php echo $webConfig["navForegroundColor"];?> !important" class="material-icons left">menu</i>
          </a>

        </aside>
 
           <style>
                @media only screen and (min-width: 600px) and (max-width: 992px) {
                     .custom-menu-icon{margin-top: -3}
                    }
                  
              
            </style> 
 
 
            
            
            

  
<div id="loaderDiv"  style="position:fixed; left:0;top:-7;right:0;bottom:0;background:rgba(0,0,0,0.6);z-index:9999999999999999999999999999999999999;display:none">
		        <div class="progress grey">
                            <div style="display:none" id="lajelaLoader1" class="indeterminate red"></div>
                            <div style="display:none" id="lajelaLoader2" class="indeterminate blue"></div>
                            <div  style="display:none" id="lajelaLoader3" class="indeterminate green"></div>    
                         </div>
                            
                        </div>