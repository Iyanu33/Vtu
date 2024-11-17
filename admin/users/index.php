  <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/pagination.php'; $page = new pagination($conn);?>

 
 
 
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["users"]);
?>
 
 

		
		
		 
		 
 <title><?php echo $LANG["registered_user"]; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"> <?php echo $LANG["registered_user"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
		
<section class="container">
			   
	<div class="row flex-items-sm-center">
	<table class="table-striped">
 <?php

  $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM users")->num_rows;
$page->searchForm($action);
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

 
		  $sql = "SELECT id, name FROM users ORDER BY name LIMIT $start,$stop";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $name =   $row["name"];
				   $id =   $row["id"];
					echo "<tr>
					      <td>$sn</td>
					      <td>$name</td>
					      <td><a class=\" py-0\" href=\"login.php?id=$id\">{$LANG['login']}</a></td>
					      <td><a class=\" py-0\" href=\"../editbalance.php?id=$id\">{$LANG['edit_balance']}</a></td>
					      <td><a class=\" py-0\" href=\"../blockuser.php?id=$id\">{$LANG['block_unblock']}</a></td>
					      <td><a class=\" py-0\" href=\"view.php?id=$id\">{$LANG['view']}</a></td>
                                              </tr>";
					 
				}
			}else{
                            openAlert($LANG["no_record_found"]);
			}
		?>
	</table>	 

</div>
     <?php $page->getPage($currentPage, $totalQuery)?>
</section>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>


  <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="phone.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["phone"]) ?>" class="btn-floating tooltipped"><i class="material-icons">phone</i></a></li>
      <li><a href="email.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["email"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">email</i></a></li>
    </ul>
  </div>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		
		
		