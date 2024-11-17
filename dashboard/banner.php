<?php include "../include/ini_set.php"?>
<?php include '../include/checklogin.php';?> 
<?php include 'include/header.php';?>
<?php include '../include/data_config.php';?>
<?php include '../include/filter.php';?>
<?php include '../include/webconfig.php';?>

<?php if($webConfig["referralEnable"]!=1 && $webConfig["discountEnable"]!=1){
     javaScriptRedirect("index.php");
}
?>

  <title><?php echo $LANG["advert_banner"] ;?></title>
  <section style="width:100% !important" id="content">
          <div class="container">
            <div class="section row">
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 ">
                    <div class="card-panel   hoverable ">
                   

 
 
 
 
 <section class="container">
     <h1><?php echo $LANG["advert_banner"];?></h1>
 
     <div class="text-justify"><?php echo $LANG["advert_banner_introduction"];?></div>


<!---<?php echo strtoupper($webConfig["webName"]); ?> ADS START-->
<a href="#" target="_blank"><img  src="//<?php echo $webConfig["webLink"]; ?>/banner.php?type=long" width="100%"  height="100"/> </a>
<!---<?php echo strtoupper($webConfig["webName"]); ?> ADS STOP-->

 
<?php echo $LANG["advert_banner_javascript_doc"];?>
<textarea data-position="down" data-tooltip="<?php echo ucfirst($LANG["click_to_copy"]) ?>" class="tooltipped form-control" rows="10" readonly onclick="copyKey(this)">
<!---<?php echo strtoupper($webConfig["webName"]); ?> ADS START-->
<script src="//<?php echo $webConfig["webLink"]; ?>/resources/js/advert.php"> </script>
<script>
ad.widget="<?php echo $user["widget"];?>"; 
ad.lococation="long";
ad.display();
</script>
<!---<?php echo strtoupper($webConfig["webName"]); ?> ADS STOP-->
</textarea>


<script src="//<?php echo $webConfig["webLink"]; ?>/resources/js/advert.php"> </script>

<?php echo $LANG["advert_banner_html_doc"];?>

<textarea data-position="down" data-tooltip="<?php echo ucfirst($LANG["click_to_copy"]) ?>" class="tooltipped form-control" rows="5" readonly onclick="copyKey(this)">
<!---<?php echo strtoupper($webConfig["webName"]); ?> ADS START-->
<a href="//<?php echo $webConfig["webLink"]; ?>/ad_click.php?widget=<?php echo $user["widget"];?>" target="_blank"><img  src="//<?php echo $webConfig["webLink"]; ?>/banners/long" width="100%"  height="100"/> </a>
<!---<?php echo strtoupper($webConfig["webName"]); ?> ADS STOP-->
</textarea>

</section>
<script>
function copyKey(copyText) {
  copyText.select();
  document.execCommand("copy");
   Materialize.toast("<?php echo $LANG["copied"];?>",1000);
}
</script>
<br/>





              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
</section>
<?php include 'include/footer.php';?>