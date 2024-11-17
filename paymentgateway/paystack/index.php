
<?php
 function paymentData($data,$user,$gateway,$btn){
$output = '
 
<script>
  function payWithPaystack(){
 	
    var payAmount =  "'.$data["payAmount"]*(100).'";
    var payEmail = "'.$user["email"].'";
    var payCurrency = "'.$gateway["currency"]["code"].'";
     var handler = PaystackPop.setup({
      key: "'.$gateway["custom_1"].'",
      currency: payCurrency,
      email: payEmail,
      amount: payAmount,
    //  label: "Optional string that replaces customer email",
      metadata: {
         custom_fields: [
            {
                transactionId: "'.$data["id"].'",
                salt: "'.md5($data["payAmount"]*(100).$gateway["encrypt_key"]).'"
            }
         ] 
      },
      callback: function(response){
        location.href="../paymentgateway/paystack/callback.php?'.$data["type"].'='.$data["id"].'&ref="+ response.reference; 
      },
      onClose: function(){
          //alert"window closed");
      }
    });
    handler.openIframe();
  }
</script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
document.getElementById("payNowButton").addEventListener("click",payWithPaystack);
</script>

';
return $btn.$output;
 }
?>
