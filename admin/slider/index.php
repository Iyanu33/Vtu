<?php include '../../include/ini_set.php';?>
<?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["slider"]);
     
?>
<script>
 function confirmAction(event,msg=""){
	 if(msg == ""){
	   var msg = "Cormfirm this action";
	 }
	 var r =  confirm(msg);
	 if(!r){
	   event.preventDefault()
	 }
	}
</script>
		
		 
		  

		 <title><?php echo $LANG["home_slider"];?></title>
		 
		 <section id="content">
    
          <div class="container">
            <div class="section" >
			 <div class="row col s6 m12 l6 ">
                <p class="caption"> <?php echo $LANG["home_slider"];?> </p>
                 <div class="divider"></div>
                  <!-- Form with placeholder -->
              
                    <div class="card-panel  hoverable ">
		
<section class="container">
			   
	<div class="row flex-items-sm-center">
	
	<table border='1' class="table">
 <?php

		  $sql = "SELECT active, title, src, description, id FROM slider ORDER BY slide_order,reg_date ASC";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $title =   $row["title"];
				   $active = '<span class="text-success">'.ucfirst($LANG["active"]).'</span>';
				   if($row["active"]!=1){
					  $active = '<span class="text-danger">'.ucfirst($LANG["disabled"]).'</span>'; 
				   }
				   $id =   $row["id"];
				   $src =   $row["src"];
				   $token =   base64_encode($row["src"]);
				   $description =   $row["description"];
					echo "<tr>
					      <td rowspan='2'><img src=\"../../uploads/$src\" class=\"img-fluid img-thumbnail h-25\"></td>
					      <td>$title</td>
					      <td>$active</td>
					      <td><a  class=\"btn btn-success  py-0\" href=\"edit.php?id=$id\">{$LANG["edit"]}</a></td>
					     <td><button class=\"btn btn-danger btn-sm py-0\"  onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_slider.php?id=$id&token=$token')\">{$LANG['delete']}</button></td>
						  </tr>
						 <tr>
						 <td colspan=\"4\">$description</td>
						 </tr>";
					 
				}
			}else{
				openAlert($LANG["no_record_found"]);
			}
		?>
	</table>	 

</div>
</section>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>



 <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["upload_new_slider"]) ?>">
    <a href="new.php" class="btn-floating btn-large">
      <i class="large material-icons">cloud_upload</i>
    </a>
  </div>

<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		
		
		