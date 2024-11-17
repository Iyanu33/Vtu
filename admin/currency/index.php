 <?php include "../../include/ini_set.php"; ?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>  

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["currency"]);
?>

   <?php 
		$serviceNumber = $conn->query("SELECT api FROM service")->num_rows;
		$categoryNumber = $conn->query("SELECT id FROM category")->num_rows;
		$formNumber = $conn->query("SELECT id FROM form")->num_rows;
		$plansNumber = $conn->query("SELECT id FROM plans")->num_rows;
	?>
 
 <title><?php echo $LANG["currency"]?></title>
 

 
 
  <section id="content">
          <!--start container-->
          <div class="container">
           
            
			
			
			
			
			
			 <div class="card-panel  hoverable ">
   
   <table class="bordered highlight table-responsible">
        <thead>
          <tr>
              <th> <?php echo $LANG["display_name"]?></th>
              <th> <?php echo $LANG["status"]?></th>
               <th> <?php echo $LANG["rate_to_system_currency"]?></th>
			   <th> <?php echo $LANG["currency_code"]?></th>
              <th> <?php echo $LANG["currency_symbol"]?></th>
        
              <th rowspan="5"> <?php echo $LANG["actions"]?></th>
          </tr>
        </thead>
        <tbody>   
		
		<?php	
		$service =  $serviceValue["id"];
			$sql = "SELECT * FROM currency ORDER BY name ASC";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				// output data of each row
			  while($row = $result->fetch_assoc()) {
			  $id = $row["id"];
			  $displayName = $row["name"];
			  $rate = $row["rate"];
			  $symbol = htmlspecialchars_decode($row["symbol"]);
			  $code = $row["code"];
			  $active = $row["active"]==1?ucfirst($LANG["active"]):ucfirst($LANG["disabled"]);
			  
	echo "<tr>
            <td>$displayName</td>
            <td>$active</td>
            <td>$rate</td>
            <td>$code</td>
            <td>$symbol</td>
            <td>
			  <td><a class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["edit"])."\" href=\"edit.php?id=$id\"><i class=\"material-icons right\">edit</i></a></td>
			   <td><button onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_currency.php?id=$id')\"  class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["delete"])."\" ><i class=\"material-icons right\">delete</i></button>
			
			</td>

          </tr>
			";
			
			  }
			}
		?>
			
			
		</tbody>
      </table>
            	
		</div>	 


			
			
<div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_currency"]) ?>">
    <a href="new.php" class="btn-floating btn-large red">
      <i class="large material-icons">add</i>
    </a>
  </div>
			
			
            
            <!--work collections end-->
            
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--end container-->
        </section>
		    <!-- END MAIN -->
			
			</div>
		</div>
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>
		