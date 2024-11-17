			
<div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service"]) ?>">
    <a href="//<?php echo $webConfig["webLink"]?>/service" class="btn-floating btn btn-large">
      <i class="large material-icons">add_shopping_cart</i>
    </a>
  </div>
<?php 
$_SESSION["webLink"]=$webConfig["webLink"];
?>

<!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START FOOTER -->
    <footer class="page-footer lajela-footer ">
      <div class="footer-copyright">
        <div class="container">
            <span><?php echo $LANG["copyright"]; ?> &copy;
            <?php echo date("Y");?> <?php echo $webConfig["companyName"]?> <?php echo $LANG["all_rights_reserved"]; ?></span>
            <span class="right hide-on-small-only"><a href="//<?php echo $webConfig["webLink"]?>/faq.php"><i class="material-icons white-text">help</i></a></span>
        </div>
      </div>
    </footer>
    <!-- END FOOTER -->
    <!-- ================================================
    Scripts
    ================================================ -->
    <!-- jQuery Library -->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"]?>/vendors/jquery-3.2.1.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"]?>/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"]?>/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"]?>/js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"]?>/js/custom-script.js"></script>
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/js.php"></script>
    
    
    

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

