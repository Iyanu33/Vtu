<?php include "../include/ini_set.php"; ?>
<?php include '../include/checklogin.php';?> 
<?php include '../include/filter.php';?> 
<?php include "../dashboard/include/header.php"; ?>
<?php include "../include/data_config.php"; ?>
<?php include "function/login.php"; ?>
<?php include "function/value.php"; ?>
<?php include "function/link.php"; ?>
<title>Generate Bank Account</title>
<?php if($active == '1'){?>
<?php  $user = $conn->query("SELECT email, name FROM users WHERE id='$loginUser'")->fetch_assoc(); $kyc = $conn->query("SELECT first_name, last_name, middle_name, bvn, verified, account_number FROM reserved_account WHERE owner = '$loginUser'")->fetch_assoc(); $customerName = "{$kyc["first_name"]} {$kyc["middle_name"]} {$kyc["last_name"]}"; $bvn = $kyc["bvn"]; $email = $user["email"]; if($noKYC == '1' && empty(trim($customerName))){ $customerName = $user["name"]; $id = md5(mt_rand().time()); $conn->query("INSERT INTO reserved_account (id,owner) VALUES('$id','$loginUser')"); } $accountName = xcape($conn, $_POST["accountName"]); $ref = md5(mt_rand().time()); $token = monifyLogin($apiKey, $secreteKey,$monnifyLink); if(($kyc["verified"]== '1' || $noKYC == '1') && $kyc["account_number"]=='' && !empty($_POST["accountName"])){ $api = $token["responseBody"]["accessToken"]; $host = "$monnifyLink/bank-transfer/reserved-accounts"; $data = array( "accountReference"=> "$ref", "accountName"=> "$accountName", "currencyCode"=> "NGN", "contractCode"=> "$contractCode", "customerEmail"=> "$email", "customerName"=> "$customerName" ); if(!empty($bvn)){ $data["customerBvn"] = $bvn; } $data = json_encode($data); $curl = curl_init(); curl_setopt_array($curl, array( CURLOPT_URL => $host, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_ENCODING => "", CURLOPT_POSTFIELDS => $data, CURLOPT_HTTPHEADER => array("Authorization: Bearer $api","Content-Type: application/json"), CURLOPT_FOLLOWLOCATION=> true, CURLOPT_MAXREDIRS => 10, CURLOPT_POSTREDIR => 3, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "POST", )); $r = curl_exec($curl); curl_close($curl); $r = json_decode($r,true); $response = $r["responseBody"]; if($r["responseMessage"]=="success" && $r["requestSuccessful"]===true){ $accountName = ""; $sql = "UPDATE reserved_account SET 
                     account_name = '{$response["accountName"]}',
                     account_number = '{$response['accountNumber']}',
                     bank_name =  '{$response["bankName"]}',
                     bank_code =  '{$response["bankCode"]}',
                     ref =  '{$response["accountReference"]}'
                      WHERE owner='$loginUser'
                     "; $conn->query($sql); } else { $responseFailed = TRUE; } } ?>
 <div class="col s12">
        <div class="flexbox">
       <div class="custom-form-control">
           <div class="card-panel">
             <?php if($r["requestSuccessful"]===true){?>
               
               
            <div class="name-header Bold" >Bank Name</div>
            <div><?php echo $response["bankName"]?></div>
            <div class="name-header Bold" >Account Name</div>
            <?php echo $response["accountName"]?>
            <div class="name-header bold" >Account Number</div>
            <div> <?php echo $response["accountNumber"]?> </div>
            <a class="btn" href="index.php">Continue</a>
               
             <?php }else{ ?>
               <?php if($responseFailed === TRUE){?>
               <div class="alert alert-danger">Account Could Not be Generated</div>
              <?php } ?>
               <?php if(!empty($kyc["account_number"])){?>
               <div class="alert alert-danger">You cannot have two accounts</div>
               <?php }else{ ?>
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                   <div class="row">
                    <div class="input-field col s12">
                        <input id="accountName" required name="accountName" type="text" value="<?php echo $accountName ?>">
                            <label for="accountName">Account Name</label>
                       </div>
                   <div class="col s12">
                      <center> <button  class="btn right waves-effect waves-light" type="submit"> Generate </button></center>
                   </div>
                   </div>
               </form>
             <?php } } ?>
           </div>
 </div>
 </div>
 </div>
<?php }else{ alertDanger("Reserve Account Disabled on this system"); } ?>
 </div>
 </div>
 <?php include "../dashboard/include/footer.php"; ?>