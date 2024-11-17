<?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>
 
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["update_access"]);
     
?>
<title><?php echo $LANG["update_wizard"]; ?></title>
   <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["update_wizard"]; ?> </p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel"> 
<div class="container-fluid">
<div class="row flex-items-sm-center justify-content-center">
<div class="col s12">
  <h3><i class="fa fa-refresh text-success fa-spin" ></i>  <?php echo $LANG['welcome_to_lajela_update_wizard'];?> <i class="fa fa-refresh text-success fa-spin" ></i> </h3>
  <ul>
<?php echo $LANG["update_message"] ?> 
 <ul>
   
   
   <a class="btn btn-success" href="check.php"> <i class="fa fa-code"></i> <?php echo $LANG["check_website_update"]; ?></a>  
   <a class="btn btn-primary right" href="dcheck.php"> <i class="fa fa-database"></i> <?php echo  $LANG["check_database_update"]; ?></a>  
</div>
</div>




                     </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
        </section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>


</body>
</html>
