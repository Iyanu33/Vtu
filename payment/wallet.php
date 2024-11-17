<?php include "../include/checklogin.php"; ?>
<?php include "../include/ini_set.php"; ?>
 <?php include "../include/data_config.php"; ?>
 <?php include "../include/filter.php"; ?>
 <?php include '../account/userinfojson.php';?>
 <?php include "../dashboard/include/header.php"; ?>
<?php  $userInfo = userInfo($loginUser,$conn); $GLOBALS["user"] = $userInfo = json_decode($userInfo,true); ?>
<?php  if(!empty($_GET["id"])){ include "recharge_processor.php"; $transactionId = xcape($conn, $_GET["id"]); $transaction = payService($conn, $transactionId,$user["referBy"],true); if($transaction===true){ alertSuccess($LANG["transaction_successful"]); }else{ alertDanger($LANG["transaction_failed"]); } } ?>





 <title><?php echo $LANG["transaction"] ;?></title>
  <section style="width:100% !important" id="content">
          <div class="container flexbox">
            <div class="section row "  >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 custom-form-control ">
                    <div id="payCard" class="card-panel   hoverable ">
                   
                       <?php if($transaction===true){ ?>
                        <div class="alert alert-success text-center">
                            <h5> <?php echo strtoupper($LANG["transaction_successful"]) ;?></h5>
                         </div>
                       <?php }else{?>
                        <div class="alert alert-danger">
                            <h5 class="text-center title"> <?php echo strtoupper($LANG["transaction_failed"]) ;?></h5>
                            <ul>
                               <?php foreach ($transaction as $error) {?>
                                <li><i class="material-icons left small">error</i><?php echo $LANG[$error];?></li>
                               <?php }?>
                            </ul>
                         </div>
                       <?php }?>
                        <a href="../transactions/view.php?id=<?php echo $transactionId;?>" class="btn waves-effect waves-green right"><?php echo $LANG["continue"];?></a>
                        <span class="clearfix"></span>
                    </div>
                  </div>
            </div>
          </div>
  </section>

</div>
</div>
<?php include "../dashboard/include/footer.php"; ?>