<?php include "../include/ini_set.php"?>
<?php include "../include/header.php"?>
<?php include "../include/filter.php"?>
 <?php include '../include/data_config.php';?>
<?php include '../include/webconfig.php';?>
 <?php include '../include/pagination.php'; $page = new pagination($conn);?>


<title><?php echo $LANG["service"];?></title>




 <section class="container">
        <br/>
     <div id="content">
 
    <?php 
    
$i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM service WHERE active='1' ")->num_rows;
$page->searchForm($action);
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];
    
    $sql = "SELECT id,image,display_name FROM service WHERE active='1'  ORDER BY hit ASC LIMIT $start,$stop";
    $result = $conn->query($sql);
    if($result->num_rows > 0){?>       
             
      <div class="col s12">
        <div class="card-panel hoverable">  
    
        <div class="row"> 

        
            <?php
           while ($row = $result->fetch_assoc()) {?>



            <div style="cursor: pointer" onclick="openLink('buy.php?id=<?php echo $row["id"]?>')" class="col  s12 m3 l2 tooltipped" data-position="bottom" data-tooltip="<?php echo ucfirst($row["display_name"]) ?> ">
                    <div class="card py-sm-5  hoverable">
                                
                     <div class="col s3 m12 left-align">
                         <img class="h-sm-30" style="height: 90px; width: 100%" src="../uploads/service/<?php echo $row["image"] ?>"/>		  
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
  <?php $page->getPage($currentPage, $totalQuery)?>
</section>
</div>
</div>



<?php include "../include/footer.php"?>