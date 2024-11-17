 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/webconfig.php';?>
 <?php include '../include/header.php';?>
<?php include '../../account/userinfojson.php';?>



<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["payment"]);
?>


<title><?php echo $LANG["payment_notification"]; ?></title>

  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h4><?php echo $LANG["payment_notification"]; ?> </h4>	  
              <div class="divider"></div>
              <div class="flexbox">
                  <!-- Form with placeholder -->
                  <div class="row custom-form-control">
                    <div class="card-panel hoverable">

<div class="container">
<div class="row flex-items-sm-center justify-content-center">
<div class="col s12" id="response"></div>
<div class="col s12">
<table>
<?php 
$id = xcape($conn,$_GET["id"]);

$sql = "SELECT * FROM payout_request WHERE id='$id' LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
	$id = $row["id"];
	$name = $row["name"];

	$date = date("d-m-Y @ g:ia ",$row["reg_date"]);
	
	$ref = $row["ref"];
	$remark = $row["remark"];
	$owner = $row["user"];
	$amount = $row["amount"];
	$setDate =  date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$row["settled_date"]);
	$admin = adminInfo($row["admin"],$conn)["name"];
        
        if (empty(trim($admin))) {
            $admin = "Computer";
        }

        $admin = "<tr><td>{$LANG["settled_by"]}:</td><td>$admin</td></tr>";    
	$setDate = "<tr><td>{$LANG["settled_on"]}:</td><td>$setDate</td></tr>";
	$u =  userInfo($owner,$conn);
    $u = json_decode($u,true);
	$owner = $u["name"];
	$ownerId = $u["id"];
	$phone = $u["phone"];
	$email = $u["email"];
         $settled = $row["settled"]==1?"yes":"no";
         $finalBalance =  $row["amount"]-$row["fee"];
   if($settled!="yes"){
	  $setDate = $admin = "";
	    	$btn = "<button  onclick=\"ajaxConfirm('".ucfirst($LANG["ensure_that_you_credit_the_user_account_before_marking_this_transaction_as_settled"])."','settlprocessing.php?id=$id')\"  class=\"btn right btn-primary\">".$LANG["mark_transaction_as_ettled"].'</button>';
			$text = $LANG["credit_user_account_first"];
	       $text =  "<p class=\"alert alert-danger\"> $text </p>";
	}
        echo "<tr><td>{$LANG["transaction_id"]}:</td><td>$id</td></tr>";
        echo !empty($row["bank_name"])?"<tr><td>{$LANG["bank_name"]}</td><td>{$row["bank_name"]}</td></tr>":'';
	echo !empty($row["account_number"])?"<tr><td>{$LANG["account_number"]}</td><td>{$row["account_number"]}</td></tr>":'';
	echo !empty($row["account_name"])?"<tr><td>{$LANG["account_name"]}</td><td>{$row["account_name"]}</td></tr>":'';
	echo !empty($row["account_type"])?"<tr><td>{$LANG["account_type"]}</td><td>{$row["account_type"]}</td></tr>":'';
        echo !empty(trim($row["custom_1"]))?"<tr><td>{$webConfig["payoutCustom1"]}</td><td>{$row["custom_1"]}</td></tr>":'';
        echo !empty(trim($row["custom_2"]))?"<tr><td>{$webConfig["payoutCustom2"]}</td><td>{$row["custom_2"]}</td></tr>":'';
	echo "<tr><td>{$LANG["amount"]}:</td><td>$amount</td></tr>";
	echo "<tr><td>{$LANG["fee"]}:</td><td>{$row["fee"]}</td></tr>";
	echo "<tr><td>{$LANG["final_balance"]}:</td><td>$finalBalance</td></tr>";
	echo "<tr><td>{$LANG["user_name"]}:</td><td>$owner</td></tr>";
	echo "<tr><td>{$LANG["date"]}:</td><td>$date</td></tr>";
        echo "<tr><td>{$LANG["settled"]}</td><td>{$LANG[$settled]}</td></tr>";
	echo "$setDate  $admin ";
	echo $text; 
	}
}else{
     echo ($LANG['no_transaction_found']);
    openAlert($LANG['no_transaction_found']);
}
?>
</table>
    <div><?php echo $btn?></div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
          
        </section>



 <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>">
     <a href="index.php" class="btn-floating btn-large">
      <i class="large material-icons">home</i>
    </a>
  </div>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>

