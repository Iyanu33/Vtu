<?php include "../include/ini_set.php"?>
<?php include '../include/checklogin.php';?> 
<?php include 'include/header.php';?>
<?php include '../include/data_config.php';?>
<?php include '../include/filter.php';?>
<?php include '../include/webconfig.php';?>


<?php if($webConfig["referralEnable"]!=1 && $webConfig["discountEnable"]!=1 && $webConfig["enableAPI"]!=1){
     javaScriptRedirect("index.php");
}
?>
<?php 

$sql = "SELECT refer_code,api,widget FROM users WHERE id ='$loginUser'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	  $referCode = $row["refer_code"];
          $api =  trim($row["api"]);
	  $widget = 	trim($row["widget"]);
          $bonus = $row["bonus"];
	}  
} else {
    $infoNotFound=true;
}
?>



<?php
$sql = "SELECT id FROM users WHERE refer_by='$referCode'";
$result = $conn->query($sql);
$agents =  $result->num_rows;
?>





<style>

.dashboard-title {
     font-size:25px;
	 font-weight: bold;
}
.dashboard-image{
		height:140px;
		width:140px;
}
.dashboard-text-container{
		left: 120px;
}

@media only screen and (max-width: 600px) {
    .dashboard-title {
        font-size:10px
		
	}
	
	.dashboard-image{
		height:80px;
		width:80px;
	}
	.dashboard-text-container{
		left: 60px;
}
	
}
</style>




  <title><?php echo $LANG["key_settings"] ;?></title>
  <section style="width:100% !important" id="content">
          <div class="container">
            <div class="section row">
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 ">
                    <div class="card-panel   hoverable ">
                   
				

 
 <div style="text-align:center !important" class="row flex-items mcenter justify-content-center pl m5">
 



 <div  class="col m9 pt-3 text-left row"> 
 <?php if($webConfig["enableAPI"]==1){?>    

<span class="col s12 m2 "><?php echo $LANG["api_key"];?> </span> 

<div class="col m6" >
    <input  class="form-control" readonly="readonly" id="api" value="<?php echo $api?>" />


</div>
 <?php } ?>

  <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1){?>
<div>
 <span class="col m2" >
 <button class="btn btn-secondary" type="button" onclick="copyKey('api','<?php echo $LANG["api_key"];?>')" >
<?php echo $LANG["copy"];?>
  </button>
 </span> 
 
 <span class="col m2" >
 <button class="btn btn-success" type="button" onclick="keyRest('api')"><?php echo $LANG["reset"];?> </button>
 </span>
 
 </div>
 	
 </div> 
 
 <div  class="col m9 pt-3 text-left row"> 
<span class="col m2 "><?php echo $LANG["widget_key"];?> </span> 

<div class="col m6" >
<input  class="form-control" rows="1" id="widget" readonly="readonly" value="<?php echo $widget ?>">


</div>

<div>
 <span class="col m2" >
 <button class="btn btn-secondary" type="button" onclick="copyKey('widget')" >
<?php echo $LANG["copy"];?>
  </button>
 </span> 
 
 <span class="col m4 l2" >
 <button class="btn btn-success" type="button" onclick="keyRest('widget','<?php echo $LANG["widget_key"];?>')"><?php echo $LANG["reset"];?> </button>
 </span>
 
 </div>
  
 </div>
 
 
 
 
 
  <div  class="col m9 pt-3 text-left row"> 
<span class="col m2 "><?php echo $LANG["referral_link"];?></span> 

<div class="col m6" >
<input  class="form-control" rows="1" id="link" readonly="readonly" value="//<?php echo $webConfig["webLink"]?>/refer.php?r=<?php echo $referCode?>">


</div>

<div>
 <span class="col m2" >
 <button class="btn btn-secondary" type="button" onclick="copyKey('link')" >
<?php echo $LANG["copy"];?>
  </button>
 </span> 
 
 <span class="col m2" >
 <button class="btn btn-success" type="button" onclick="keyRest('link','<?php echo $LANG["referral_link"];?>')"><?php echo $LANG["reset"];?></button>
 </span>
 
 </div>
 	
 </div>
     <div class="col s6">
         <a href="banner.php" target="banner"?><button class="btn btn-success" type="button" ><?php echo $LANG["banners"]?></button></a>
     </div>
     <div class="col s6">
         <a href="../api_doc/" target="api"?><button class="btn btn-success" type="button" ><?php echo $LANG["api_documentations"]?></button></a>
     </div>
     
    <?php } ?>	 
     
 </div>
                    </div>
                  </div>
 
 
            </div>
          </div>
 


<script>
function keyRest(k,keyName) {
ajaxConfirm(keyName+": <?php echo trim($LANG["the_key_will_be_reset_please_make_sure_you_update_the_key_any_where_your_using_it_after_resetting"])?>","reset.php?key="+k);
}
</script>
 

<script>
function copyKey(k) {
  var copyText = document.getElementById(k);
  copyText.select();
  document.execCommand("copy");
  Materialize.toast("<?php echo $LANG["copied"];?>",1000);
}

</script>

 
	
</div>



                    </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>
<?php include 'include/footer.php';?>