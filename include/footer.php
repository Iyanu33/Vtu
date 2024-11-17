

<!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START FOOTER -->
    <footer class="page-footer gradient-45deg-light-blue-cyan no-padding no-margin">
      
<?php 
$_SESSION["webLink"]=$webConfig["webLink"];
?>
        
        <div class="container-fluid alert-info footer lajela-footer hide-on-med-and-down" style=" padding-bottom: 0 !important;"> 
		<div class="container">
                    <div style=" padding-bottom: 0 !important; height: 120.3525px !important; overflow-y: hidden" class="row">
			<div class="col s6" style=" padding-bottom: 0 !important" >
				<h5><?php echo $LANG["join_us"];?></h5>  
				<ul class="social-icons footer-group">
					
					<?php if(!empty($webConfig["facebook"])){echo '<a href="'.$webConfig["facebook"].'"><li class="facebook"><i class="fa fa-facebook"></i> </li></a>';}?>
					<?php if(!empty($webConfig["twitter"])){echo '<a href="'.$webConfig["twitter"] .'"><li class="twitter" ><i class="fa fa-twitter"></i></li></a>';}?>
					<?php if(!empty($webConfig["googlePlus"])){echo '<a href="'.$webConfig["googlePlus"].'"><li class="googleplus" ><i class="fa fa-google-plus"></i></li></a>';}?>
					<?php if(!empty($webConfig["youTube"])){ echo '<a href="'.$webConfig["youTube"] .'" ><li class="youtube" ><i class="fa fa-youtube"></i></li></a>';}?>
					<?php if(!empty($webConfig["instagram"])){echo '<a href="'.$webConfig["instagram"].'" ><li class="instagrammagenta" ><i class="fa fa-instagram"></i></li></a>';}?>
				 
				</ul> 
			</div> 
			<div class="col s6" style=" padding-bottom: 0 !important" >
			<div class="col-12" id="newsLetterResponse"></div>
				<h5 class=""><?php echo $LANG["subscribe_to_our_newsletter"]?></h5>  
				<form action="#" id="newsLetterForm" onsubmit="return newsLetter(); return false" method="post" class="row"> 
                                    <div class="input-field col s9">	
                                    <input class="form-control" type="email" name="email" required="require">
                                    <label for="email"><?php echo $LANG["email"]?></label>
                                    </div>   
                                    <div class="input-field col s3">
                                        <button class="btn waves-effect waves-light right"><?php echo $LANG["submit"]?></button>
                                    </div>
				</form>  
			</div>  
		</div>
	</div>
</div>
<!-- //subscribe --> 
    
<!--footer-->
<div class="container-fluid white-text lajela-footer footer hide-on-med-and-down">
		<div class="container">
		<div class="row">
			<div class="col s4">
				<h5><?php echo $LANG["company"];?></h5>
				<ul class="footer-group">
					<li><a class="white-text" href="//<?php echo $webConfig["webLink"]?>/about.php"><?php echo $LANG["about_us"];?></a></li>
					<li><a class="white-text" href="//<?php echo $webConfig["webLink"]?>/feedback.php"><?php echo $LANG["feedback"];?></a></li>	
					<li><a class="white-text" href="//<?php echo $webConfig["webLink"]?>/faq.php"><?php echo $LANG["faq"];?></a></li>	
					<li><a class="white-text" href="//<?php echo $webConfig["webLink"]?>/terms.php"><?php echo $LANG["terms_and_conditions"];?></a></li>
						
				</ul>	
			</div>
			
			
<div class="col s4">
   <h5><?php echo $LANG["get_in_touch"];?></h5>
    <ul class="footer-group">

    <?php
    $method =  explode(",",$webConfig["address"]);
    $arrlength = count($method);
    for($x = 0; $x < $arrlength; $x++) {
     $paymentMethod = $method[$x];
    echo "<li>$paymentMethod,</li>";
    }
    ?>

    <?php
    $phone =  explode(",",$webConfig["phoneNumber"]);
    $arrlength = count($phone);
    for($x = 0; $x < $arrlength; $x++) {
     $i = $phone[$x];
    echo "<li>$i,</li>";
    }
    ?>
				
    <?php
    $email =  explode(",",$webConfig["supportEmail"]);
    $arrlength = count($email);
    for($x = 0; $x < $arrlength; $x++) {
     $i = $email[$x];
    echo "<li>$i,</li>";
    }
    ?>
	
				
				
				
			
				
			</ul>	
			</div>
    <div class="col-sm-4">
       <h5><?php echo $LANG["quick_links"]; ?></h5>
          <ul class="footer-group">
               <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1){?>
              <li><a class="white-text" href="//<?php echo $webConfig["webLink"]?>/affiliate.php"> <?php echo $LANG["affiliate"]?>  </a></li>
              <li><a class="white-text" href="//<?php echo $webConfig["webLink"]?>/pricing/commission_rate.php"> <?php echo $LANG["commission_rate"]?>  </a></li>
               <?php } ?>
               <?php if($webConfig["enableAPI"]==1){?>
              <li><a class="white-text" href="//<?php echo $webConfig["webLink"]?>/api_doc"><?php echo $LANG["api_documentations"]?> </a></li>
               <?php } ?>
              <li><img src="//<?php echo $webConfig["webLink"]?>/images/icon/card.png" alt=""/></li>
              
              
          </ul>	
      </div>
    </div>

    <div class="col s12 no-margin no-padding">
        <center><p ><?php echo $LANG["copyright"]; ?> &copy; <?php echo date("Y")?> <?php echo $webConfig["companyName"];?> <?php echo $LANG["all_rights_reserved"]; ?></p></center>
    </div>
		
</div>
</div>
        
        
   
        <div class="footer-copyright lajela-footer hide-on-large-only">
        <div class="container">
            <span><?php echo $LANG["copyright"]; ?> &copy;
            <?php echo date("Y");?> <?php echo $LANG["all_rights_reserved"]; ?></span>
            <span class="right hide-on-small-only"><a class="white-text" href="tel:<?php echo $phone[0]?>"><?php echo $phone[0]?></a></span>
        </div>
      </div>     
        
</footer>
    <!-- END FOOTER -->
    <!-- ============================================================================================ -->
         <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/popper.min.js"></script>
	 <!--materialize js-->
 
    <!--scrollbar-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/custom-script.js"></script>
    	<script src="//<?php echo $webConfig["webLink"];?>/bootstrap/bootstrap-3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/materialize.min.js"></script>
	<script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/js.php"></script>
    <!-- //////////////////////////////////////////////////////////////////////////// -->
		
<div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service"]) ?>">
    <a href="//<?php echo $webConfig["webLink"]?>/service" class="btn-floating btn btn-large">
      <i class="large material-icons">add_shopping_cart</i>
    </a>
  </div>


<?php echo htmlspecialchars_decode($webConfig["chatCode"]);?>

    <style>
         
        .lajela-footer{
            background-color: <?php echo $webConfig["footerBackgroundColor"];?> !important;
        }
        .lajela-footer *{
            color: <?php echo $webConfig["footerForegroundColor"];?> !important;
        }
        
         .lajela-header{
            background-color: <?php echo $webConfig["navBackgroundColor"];?> !important;
        }
        .lajela-header *{
            color: <?php echo $webConfig["navForegroundColor"];?> !important;
        }
        
        .btn{
            background-color: <?php echo  $webConfig["buttonBackgroundColor"];?> !important;
            color: <?php echo $webConfig["buttonForegroundColor"];?> !important;
            
        } 
    </style>
<style>
    .social-icons li{
        display: inline-block;
        width: 30px;
        height: 30px;
        text-align: center; 
        padding-top: 8px;
        margin-top: 40px;
    }
    .social-icons *{
        color:#fff !important; 
    }
    .social-icons li:hover{
        opacity: 0.6;
    }
    .lg-search-icon{color: #000 !important};
</style>

<script>
  function  longSearchFocus(){
       $("#lg-search-icon").addClass("lg-search-icon");
   }
    function longSearchBlur(){
       $("#lg-search-icon").removeClass("lg-search-icon");
   }
</script>