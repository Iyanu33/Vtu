<?php include "include/ini_set.php"?>

    <?php include "include/header.php"?>
 <?php include 'include/data_config.php';?>
<?php include 'include/webconfig.php';?>
<title><?php echo $webConfig["homePageTitle"];?></title>
<style>
.slider .slides li img {
  height: 100% !important;
  width: 100% !important;
  background-size: 100% 400px !important;
  background-position: left !important;
  background-repeat: no-repeat !important;
}
.slider .slides li .caption{
    background: rgba(0,0,0,.7);
}


</style>
<div class="<?php if($webConfig["mobileSlider"]!=1){echo "hide-on-small-only";}?>">

<?php 
$sql = "SELECT title,src,align,description FROM slider WHERE active='1' ORDER BY slide_order ASC";
$result = $conn->query($sql);
if($result->num_rows > 0){?>
  <div class="slider">
   <ul class="slides">
 <?php
while ($row = $result->fetch_assoc()) {?>


      <li>
          <img   src="uploads/<?php echo $row["src"]?>"> <!-- random image -->
        <div class="caption <?php echo htmlspecialchars_decode($row["align"])?>">
          <h4><?php echo htmlspecialchars_decode($row["title"])?></h4>
          <p><?php echo htmlspecialchars_decode($row["description"])?></p>
        </div>
      </li>
         

<?php
}?>
   </ul>
  </div>
<?php
}
?>

  

</div>



 <section class="container">
        
        
 
    <?php 
    $sql = "SELECT image,display_name,id FROM service WHERE active='1' ORDER BY hit ASC";
    $result = $conn->query($sql);
    if($result->num_rows > 0){?>       
             
      <div class="col s12">
        <div class="card-panel hoverable">  
    
        <div class="row"> 

        
            <?php
           while ($row = $result->fetch_assoc()) {?>



            <div style="cursor: pointer" onclick="openLink('service/buy.php?id=<?php echo $row["id"]?>')" class="col  s12 m3 l2 tooltipped" data-position="bottom" data-tooltip="<?php echo ucfirst($row["display_name"]) ?> ">
                    <div class="card py-sm-5  hoverable">
                                
                     <div class="col s3 m12 left-align">
                         <img class="h-sm-30" style="height: 90px; width: 100%" src="uploads/service/<?php echo $row["image"] ?>"/>		  
	              </div>
                      <div class="col s7 m12 center-align left-on-sm-only ">
                          <h6><?php echo $row["display_name"];?></h6>
                      </div>
                      
                       <div class="col s2 m12 right-align hide-on-med-and-up">
                           <i class="material-icons right blue-text text-darken-1">keyboard_arrow_right</i>		  
	              </div>
                 </div>
                </div>

                                    
<?php
}
?>
     
        
</div>
</div>
</div>
                  
<?php
}
?>
</section>
</div>
</div>

<script>
	
  $(document).ready(function(){
    $('.slider').slider();
  });
</script>

<?php include "include/footer.php"?>