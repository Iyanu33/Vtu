 <?php include "../include/ini_set.php"; ?>
<?php include '../include/checklogin.php';?> 
 <?php include "include/header.php"; ?>
 <?php include "../include/data_config.php"; ?>
<title><?php echo $LANG['dashboard']; ?></title>
            
        <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>            
            
	<?php 
	
	$success = $failed = $pending = $reversed = 0;
	$success = $conn->query("SELECT id FROM recharge WHERE status='success'")->num_rows;
	$failed = $conn->query("SELECT id FROM recharge WHERE status='failed'")->num_rows;
	$pending = $conn->query("SELECT id FROM recharge WHERE status='pending'")->num_rows;
        $reversed = $conn->query("SELECT id FROM recharge WHERE status='reversed'")->num_rows;
	
echo "
     <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['{$LANG['status']}', '{$LANG['number']}'],
          ['{$LANG['successful']}',  $success],
          ['{$LANG['pending']}',   $failed],
          ['{$LANG['failed']}',  $pending],
          ['{$LANG['reversed']}',  $reversed]
        ]);

        var options = {
         	  colors: ['green','gold','red','blue'],
		  is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('transactionChart'));

        chart.draw(data, options);
      }
    </script>";
 
 
 ?>




	 
	 
<?php 
    $totalTransaction = $conn->query("SELECT COUNT(id) AS total FROM recharge WHERE user='$loginUser'")->fetch_assoc()["total"];
    $APITransaction = $conn->query("SELECT COUNT(id) AS total FROM api_transaction WHERE user='$loginUser'")->fetch_assoc()["total"];
  ?>



 





  <section id="content">
          <!--start container-->
          <div class="container">
            <!--card stats start-->
                <div id="card-stats">
              <div class="row mt-1">
                  <div class="col s12 m6 l3 tooltipped" data-position="bottom" data-tooltip="<?php echo ucfirst($LANG["all_transactions"]) ?> <?php echo $allTransactions ?>">
                  <div class="card  gradient-45deg-light-blue-cyan  min-height-100 white-text hoverable">
                   <div class="padding-4">
                      <div class="col s4 m4 left-align">
		        <i class="material-icons background-round mt-5">shopping_cart</i>
			</div>
                      <div class="col s8 m8 right-align">	 
                          <h4 class="no-margin"><?php echo kFormat($totalTransaction);?></h4>
                      </div>
		     <div class="col s12">
                        
                        <p><?php echo $LANG["transactions"];?></p>
                      </div>
                    </div>
                  </div>
                </div>
                     <?php if($webConfig["enableAPI"]==1){?>
                <div class="col s12 m6 l3 tooltipped" data-position="bottom" data-tooltip="<?php echo ucfirst($LANG["api_transactions"]) ?> <?php echo $APITransactions ?>">
                  <div class="card gradient-45deg-purple-deep-orange min-height-100 white-text hoverable">
                    <div class="padding-4">
                      <div class="col s4 m4 left-align">
					   <i class="material-icons background-round mt-5">http</i>
					  </div>
                      <div class="col s8 m8 right-align">
					 
                          <h4 class="no-margin"><?php echo kFormat($APITransaction);?></h4>
                      </div>
					   <div class="col s12">
                        
                        <p><?php echo $LANG["api_transactions"];?></p>
                      </div>
                    </div>
                  </div>
                </div>
                     <?php } ?>
                <div class="col s12 m6 l3 tooltipped" data-position="bottom" data-tooltip="<?php echo ucfirst($LANG["account_balance"]) ?> <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo number_format($user['credit'],2) ?>">
                  <div class="card  gradient-45deg-amber-amber  min-height-100 white-text hoverable">
                   <div class="padding-4">
                      <div class="col s4 m4 left-align">
                          <i class="material-icons background-round mt-5">account_balance</i>	</div>
                      <div class="col s8 m8 right-align">
			  <h4 class="no-margin"><?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $user['kbalance'];?></h4>
                      </div>
					   <div class="col s12">
                        
                        <p><?php echo $LANG["account_balance"];?></p>
                      </div>
                    </div>
                  </div>
                </div>
                   <?php if($webConfig["referralEnable"]==1 || $webConfig["discountEnable"]==1){?>  
                <div class="col s12 m6 l3 tooltipped" data-position="bottom" data-tooltip="<?php echo ucfirst($LANG["earning_balance"]) ?> <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo number_format($user['earn'],2) ?>">
                  <div class="card  gradient-45deg-green-teal  min-height-100 white-text hoverable">
                    <div class="padding-4">
                      <div class="col s7 m7 left-align">
			<i class="material-icons background-round mt-5">card_giftcard</i>
		      </div>
                      <div class="col s5 m5 right-align">
					 
                          <h4 class="no-margin"><?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $user['kearn'];?></h4>
                      </div>
			<div class="col s12">
                        
                        <p><?php echo $LANG["earning_balance"];?></p>
                      </div>
                    </div>
                  </div>
                </div>
                   <?php } ?>
              </div>
            </div>
             

            
           
<?php 
	
	$success = $failed = $pending = $reversed = 0;
	$success = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='success' AND user='$loginUser'")->fetch_assoc()["total"];
	$failed = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='failed' AND user='$loginUser'")->fetch_assoc()["total"];
	$pending = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='pending' AND user='$loginUser'")->fetch_assoc()["total"];
        $reversed = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='reversed' AND user='$loginUser'")->fetch_assoc()["total"];
	
echo "
     <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['{$LANG['status']}', '{$LANG['number']}'],
          ['{$LANG['successful']}',  $success],
          ['{$LANG['pending']}',   $pending],
          ['{$LANG['failed']}',  $failed],
          ['{$LANG['reversed']}',  $reversed]
        ]);

        var options = {
		  colors: ['green','#00FF00','red','blue'],
		  is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('transactionChart'));

        chart.draw(data, options);
      }
    </script>";
 
 
 ?>

 
            
            
            
            <!--work collections start-->
            <div id="work-collections">
              <div class="row">
                  
                
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                           <h6><?php echo $LANG["transactions"];?></a></h6>
                         </div>
                       <div  style="height: 300px !important; width: 100% important" id="transactionChart"></div>
                  </div>
                    
                  </div>  
                    
                    
                    
                    
                    <?php
                        $sql = "SELECT id, display_name FROM service ";

                        $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                        // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $serviceValue[$row['id']]=$row['display_name'];		
                                        }
                                  }else{
                                        $serviceValue["notFound"] = true;
                                  }
                                //print_r($serviceValue);
                        ?>
                    
                    
            
                  
               
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                           <h5><?php echo $LANG["transactions"];?> <a class="right" href="../transactions/"><?php echo $LANG["view_all"];?></a></h5>
                         </div>
                           <table class="table">
                          <tr>
                                  <th><?php echo $LANG["service"];?></th>
                                  <th><?php echo $LANG["amount"];?></th>
                                  <th colspan="2"><?php echo $LANG["status"];?></th>
                          </tr>
                          <?php
                          $i=1;
                          $sql = "SELECT id, amount, status,service_id FROM recharge WHERE user = '$loginUser' ORDER BY reg_date DESC LIMIT 5 ";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                                   $totalQuery = $result->num_rows;
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {


                                  $actionLink = '<td><center><a target="_blank" href="../transactions/view.php?id='.$row["id"].'"><i class="material-icons">visibility</i></a> </center></td>';
                                  if($row["status"]=="pending"){
                                          $actionLink = '<td><center><a target="_blank" href="../buy/confirm.php?id='.$row["id"].'"><i class="material-icons">add_shopping_cart</i></a> </center></td>';
                                  }




                                  echo '<tr style="font-size:small">';
                                  echo '<td>'.$serviceValue[$row["service_id"]].'</td>';
                                  echo '<td>'.$row["amount"].'</td>';
                                  echo '<td>'.$LANG[$row["status"]].'</td>';
                                  echo  $actionLink;
                                  echo "</tr>";
                          } 
                          }
                          ?>
                          </table>
                  </div>
                </div>
                  
                  
           <?php if($webConfig["enableAPI"]==1){?>      
                    
            <?php 

                    $success = $faild = $pending = $reversed = 0;
                    $success = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='success'AND user='$loginUser'")->fetch_assoc()["total"];
                    $faild = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='failed' AND user='$loginUser'")->fetch_assoc()["total"];
                    $pending = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='initiated' AND user='$loginUser'")->fetch_assoc()["total"];
                    $reversed = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='reversed' AND user='$loginUser'")->fetch_assoc()["total"];
	
            echo "
                 <script type='text/javascript'>
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['{$LANG['status']}', '{$LANG['number']}'],
                      ['{$LANG['successful']}',  $success],
                      ['{$LANG['initiated']}',   $pending],
                      ['{$LANG['failed']}',  $faild],
                      ['{$LANG['reversed']}',  $reversed]
                    ]);

                    var options = {
                      
                              colors: ['green','#00FF00','red','blue'],
                              is3D: true
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('apiTransactionChart'));

                    chart.draw(data, options);
                  }
                </script>";


             ?>


                    
                    
             
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                           <h6><?php echo $LANG["api_transactions"];?></a></h6>
                         </div>
                       <div style="height: 300px !important; width: 100% important" id="apiTransactionChart"></div>
                  </div>
                </div>  
                  
                  
                  
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                           <h5><?php echo $LANG["api_transactions"];?> <a class="right" href="../api_transactions/"><?php echo $LANG["view_all"];?></a></h5>
                         </div>
                           <table class="table">
                          <tr>
                                  <th><?php echo $LANG["service"];?></th>
                                  <th><?php echo $LANG["amount"];?></th>
                                  <th colspan="2"><?php echo $LANG["status"];?></th>
                          </tr>
                          <?php
                          $i=1;
                          $sql = "SELECT id, amount, status,service_id FROM api_transaction WHERE user='$loginUser' ORDER BY reg_date DESC LIMIT 5 ";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                                   $totalQuery = $result->num_rows;
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {


                                  $actionLink = '<td><center><a target="_blank" href="../api_transactions/view.php?id='.$row["id"].'"> <i class="material-icons">visibility</i> </a> </center></td>';
                                  




                                  echo '<tr style="font-size:small">';
                              echo '<td>'.$serviceValue[$row["service_id"]].'</td>';
                                  echo '<td>'.$row["amount"].'</td>';
                                  echo '<td>'.$LANG[$row["status"]].'</td>';
                                  echo  $actionLink;
                                  echo "</tr>";
                          } 
                          }
                          ?>
                          </table>
                  </div>
                </div>
               <?php }?>
            <!--work collections end-->
            
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--end container-->
        </section>
		    <!-- END MAIN -->
</div>
</div>
<?php include "include/footer.php"; ?>
 