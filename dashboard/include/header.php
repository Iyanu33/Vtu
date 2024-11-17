<?php  function includeCheck($file){ if(file_exists($file)){ return $file; }else if(file_exists("../$file")){ return "../$file"; }else if(file_exists("../../$file")){ return "../../$file"; } } ?>
    <?php $selectedUser = $_SESSION["login_user"]; ?>
     <?php include includeCheck('include/ini_set.php');?>
     <?php include includeCheck('include/data_config.php');?>
     <?php include includeCheck('include/webconfig.php');?>
     <?php include includeCheck('include/visitorcount.php');?>
     <?php include includeCheck('account/userinfor.php');?>
    
<?php
 function formatWithSuffix($input) {
     $suffixes = array('', 'k', 'm', 'g', 't');
     $suffixIndex = 0; while(abs($input) >= 1000 && $suffixIndex < sizeof($suffixes)) {
         $suffixIndex++;
         $input /= 1000; 
         
     } return ( $input > 0 ? floor($input * 1000) / 1000 : ceil($input * 1000) / 1000 ) . $suffixes[$suffixIndex]; } 
  ?>


	

<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />	
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="theme-color"  content="<?php echo $webConfig["navBackgroundColor"];?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="keywords" content="<?php echo $webConfig["keyWord"] ?>" />
<meta name="description" content="<?php echo $webConfig["description"] ?>" />
<meta name="author" content="<?php echo $webConfig["webAuthor"] ?>" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<meta name="mobile-web-app-capable" content="yes">
<meta name="msapplication-TileColor" content="#00bcd4">
<meta name="msapplication-TileImage" content="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="msapplication-tap-highlight" content="no">
<?php echo htmlspecialchars_decode($webConfig["header"]) ?>
<?php include includeCheck("language/{$webConfig["LANG"]}.php"); ?>


  <style>

.dashboard-title {
     font-size:40px;
	 font-weight: bold;
}
.dashboard-image{
		height:140px !important;
}
.dashboard-text-container{
		left: 120px;
}

@media only screen and (max-width: 600px) {
    .dashboard-title {
        font-size:18px
	}
	
	.dashboard-image{
		height:80px !important;
	}
	.dashboard-text-container{
		left: 60px;
}
	
}
</style>

  

<!-- Latest compiled JavaScript -->
  
  <style>
 .flexbox {
  display: flex;
  flew-wrap: wrap;
  justify-content: center;
  align-items: center;
  }
  </style>
  
  
    	
<style>
	@media only screen and (min-height: 550px) {
	  .lg-text-input {
		height: 250px !important;
		margin: 0 !important;
	  }
	}
	
	
	@media only screen and (min-width: 550px) {
	  .custom-form-control {
		width: 500px !important;
	  }
	}
	
	@media only screen and (max-width: 992px) {
	  .custom-form-control {
		width: 400px !important;
	  }
	}
	
	@media only screen and (max-width: 600px)  {
	  .custom-form-control {
		width: 300px !important;
	  }
	}	
	
	@media only screen and (max-width: 400px)  {
	  .custom-form-control {
		width: 300px !important;
	  }
	}
	
	@media only screen and (max-width: 300px)  {
	  .custom-form-control {
		width: 250px !important;
	  }
	}
	@media only screen and (max-width: 270px)  {
	  .custom-form-control {
		width: 100% !important;
	  }
	}
</style>
  
	

  <style>

.dashboard-title {
     font-size:40px;
	 font-weight: bold;
}
.dashboard-image{
		height:140px;
}
.dashboard-text-container{
		left: 120px;
}

@media only screen and (max-width: 600px) {
    .dashboard-title {
        font-size:18px
	}
	
	.dashboard-image{
		height:80px;
	}
	.dashboard-text-container{
		left: 60px;
}
	
}
.custom-main {
     height: calc(100% - 90px) !important;
  }
@media only screen and (min-width: 993px) {
  .custom-main {
     height: calc(100% - 393px) !important;
  }
}

</style>
  
  
 


<!-- Favicons-->
<link rel="icon" href="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>" sizes="32x32">
<link rel="shortcut icon" href="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>" />
<!-- Favicons-->
<link rel="apple-touch-icon-precomposed" href="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>">
<!-- For iPhone -->

<!--JQuery-->
 <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/vendors/jquery-2.2.1.min.js"></script>
	

<!--External CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//<?php echo $webConfig["webLink"];?>/css/animate/animate.css"/>

<!-- CORE CSS-->
<link rel="stylesheet" href="//<?php echo $webConfig["webLink"] ?>/bootstrap/bootstrap-3.4.1/css/bootstrap.min.css">
<link href="//<?php echo $webConfig["webLink"] ?>/css/materialize.css" type="text/css" rel="stylesheet">
<link href="//<?php echo $webConfig["webLink"] ?>/css//style.css" type="text/css" rel="stylesheet">


<!-- Custome CSS-->
<link href="//<?php echo $webConfig["webLink"] ?>/css/custom/custom.css" type="text/css" rel="stylesheet">

<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
<link href="//<?php echo $webConfig["webLink"] ?>/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
 
<script src="//<?php echo $webConfig["webLink"] ?>/js/file/sweetalert.min.js" type="text/javascript"></script>
    	
 
 </head>
  

  <body>
    <!-- Start Page Loading -->
   <?php if($webConfig["activeLoader"]==1){?>
     <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
   <?php } ?>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        
        
     
        
        
        
         <div id="mobile-search" class="animated  slideInRight " style="backgraound:#fff ; display: none; position: fixed; z-index: 999999999;  width:100%; margin: 0 !important; padding:8px 0 !important; background:#fff" >
                <span style=" margin: 0 !important; width: 100% !important; background:#fff"  class="header-search-wrapper">
                    <i onclick="closeMobileSearch()" class="material-icons">keyboard_backspace</i>
                    <form method="get" action="//<?php echo $webConfig["webLink"]?>/service/search.php">  <input name="q" id="mobile-search-input" style="width: 100% !important; margin: 0; border-radius: 0; background: #fff; color: #000" type="search"  class="header-search-input z-depth-2" placeholder="<?php echo $LANG["search_service"]?>" /></form>
                </span>  
         </div>
              
     
      <!-- start header nav-->
      <div  class="navbar-fixed " >
         
        <nav  class="navbar-color lajela-header">
          <div class="nav-wrapper">
          <a style="" href="//<?php echo $webConfig["webLink"]?>" class=" hide-on-large-only darken-1 left no-margin">
              <strong><span style="margin-left: 45px; padding-top: 1px !important; font-weight: bolder; font-size: 1.2em" ><?php echo $webConfig["webName"]?></span></strong>
          </a>
            
              
              
              
           <a style="padding-bottom:4px !important" href="//<?php echo $webConfig["webLink"]?>" class="hide-on-med-and-down darken-1 left no-margin">
               <strong><span style="margin-left: 5px; font-weight: bolder; font-size: 1.5em" ><?php echo strtoupper($webConfig["webName"])?></span></strong>
          </a>  
              
            
          
              <ul class="hide-on-med-and-down">
               <li style="display:inline">
                <a href="//<?php echo $webConfig["webLink"]?>/about.php" class="">
                   <?php echo $LANG["about_us"];?>
                </a>
               </li>
             
               <li style="display:inline">
                <a href="//<?php echo $webConfig["webLink"]?>/pricing" class="">
                   <?php echo $LANG["pricing"];?>
                </a>
               </li>
             <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1){?>
               <li style="display:inline">
                <a href="//<?php echo $webConfig["webLink"]?>/affiliate.php" class="">
                   <?php echo $LANG["affiliate"];?>
                </a>
               </li>
               <li style="display:inline">
                <a href="//<?php echo $webConfig["webLink"]?>/pricing/commission_rate.php" class="">
                   <?php echo $LANG["commission_rate"];?>
                </a>
               </li>
               
             <?php } ?>
               
              </ul> 
              
              
           
            <ul class="right">
                
             
                
                
                
            <li style="width:200px; margin-right: 60px !important" class=" hide-on-med-and-down">
                <span style="padding:0 !important; margin-left: 0 !important; width: 100% !important"  class="header-search-wrapper left hide-on-med-and-down">
                  <i id="lg-search-icon" class="material-icons">search</i>
                  <form method="get" action="//<?php echo $webConfig["webLink"]?>/service/search.php"> <input type="search" onblur="longSearchBlur()" onfocus="longSearchFocus()" name="q" class="header-search-input z-depth-2" placeholder="<?php echo $LANG["search_service"]?>" /></form>
                </span>  
            </li>  
            
            
              <li>
                <a href="//<?php echo $webConfig["webLink"]?>/account/logout.php" class="hide-on-med-and-down waves-effect waves-block">
                   <?php echo $LANG["logout"]?>
                </a>
            </li>
            
            
              <li>
                <a href="javascript:void(0);" class="hide-on-med-and-down waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown">
                   <i class="material-icons">translate</i>
                </a>
              </li>
             
            
              
                
              <li class="hide-on-large-only">
                <a onclick="mobileSearchDisplay()" href="javascript:void(0);" class="waves-effect circle waves-light profile-button" >
                    <i class="material-icons">search</i>
                </a>
              </li>
              
              <li class="hide-on-large-only"> 
                <a href="javascript:void(0);" class="waves-effect waves-light profile-button circle"  data-activates="profile-dropdown">
                    <i class="material-icons">more_vert</i>
                </a>
              </li>
 
            </ul>
            <!-- translation-button -->
            <ul id="translation-dropdown" class="dropdown-content">
             <?php  $sql = "SELECT name,file_name FROM lang WHERE active='1' ORDER BY name"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {?>
              <li>
                  <a href="javaScript:void(0)" onclick=ajaxRequest('',"//<?php echo $webConfig["webLink"]?>/set_lang.php?id=<?php echo str_ireplace(".php","",$row["file_name"])?>") class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-gb"></i><?php echo $row["name"]?></a>
              </li>
            
              <?php } } ?>
              </ul>
            <div class="vt" style="position: fixed; right: 2; bottom: -25; "><a target="id" href="http://vtucreator.com">Developed By VTU Creator</a></div><style> .vt *{color: <?php echo $webConfig["footerForegroundColor"] ?> !important}</style>
          
            
                <!-- profile-dropdown -->
            <ul id="profile-dropdown" class="dropdown-content">
             
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
            
            
            
            
           
          </div>
            
        </nav>
          
          
          
      </div>
      <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
	  
    <style> 
@media only screen and (max-width: 992px) {
  .custom-slider {
    top:0 !important;
    
  }
}

  </style>  
    
    
    
    <!-- START MAIN -->
    <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">
       
	   
	    <?php include 'nav.php';?>
	   
	   
		
		
		
		
		
	
		
		
		

        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!-- START CONTENT -->


 
 
<?php
 function openAlert($msg,$title='',$state="info"){ if(empty($title)){ $title = strtoupper($GLOBALS["LANG"]["oops"]); } echo "<script>
swal('".addslashes($title)."','".addslashes($msg). "', '$state',{'button':'{$GLOBALS["LANG"]["okay"]}'});
</script>"; } function alertSuccess($msg){ echo "<script>
swal('".addslashes(strtoupper(trim($GLOBALS["LANG"]["success"])))."','".addslashes(trim($msg)). "', 'success',{'button':'{$GLOBALS["LANG"]["okay"]}'});
</script>"; } function alertDanger($msg){ echo "<script>
swal('".addslashes(strtoupper(trim($GLOBALS["LANG"]["failed"])))."','".addslashes(trim($msg)). "', 'error',{'button':'{$GLOBALS["LANG"]["okay"]}'});
</script>"; }?>		
	
        <style>
            .customModal{position: fixed; top: 0; right: 0; left:0; bottom:0; background: rgba(0,0,0,.3); z-index: 9999; display: none};
            
        </style>		
        
        <div class="customModal" id="fundWallet">
           <div class="col s12 m12 l6 flexbox">
               <div class="card-panel hoverable">
                   <div class="custom-form-control">
                      <input name="amount">
                   </div>
               </div>
           </div>
        </div>
        
         