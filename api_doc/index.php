<?php include '../include/ini_set.php';?>
<?php include '../include/header.php';?>
<?php 
if($webConfig["enableAPI"]==0){?>
<script>swal("API Services is currently disabled",{
    button:false,
    title:"Out of Service",
    closeOnEsc: false, 
    closeOnClickOutside:false
}) ;</script>
 <?php
    exit;
}
 ?>
<title>API Documentation </title>
<script>
$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".nav-pills", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $("#myScrollspy a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});
</script>


<style>
.navbar-fixed-left {

position: fixed;
height: 100%;
}



.navbar-fixed-left .navbar-nav > li {
float: none;  /* Cancel default li float: left */
width: 139px;
}

.navbar-fixed-left + .container {
padding-left: 160px;
list-style-type:none !important;
}

/* On using dropdown menu (To right shift popuped) */
.navbar-fixed-left .navbar-nav > li > .dropdown-menu {
margin-top: -50px;
margin-left: 140px;
}
.read div{
padding-top:60;

}
.read .grey{
padding-top:5px;
}




@media only screen and (max-width: 600px) {
.navbar-fixed-left{
display:none;
}


.nav-pills  .nav-stacked .navbar-fixed-left{
		position: auto !important;
		height: auto;
  }
 .nav-item{
  display:inline-block !important;
  }
  
.navbar-fixed-left .navbar-nav > li {
float: none;  /* Cancel default li float: left */
width: 100%;
}

.navbar-fixed-left + .container {
padding-left: auto;
list-style-type:none !important;
}

/* On using dropdown menu (To right shift popuped) */
.navbar-fixed-left .navbar-nav > li > .dropdown-menu {
margin-top: 0;
margin-left: 0;
}
  
  
  
  
  
}



</style>

<div class="container-fluid">
<div class="row">  
<div class="col-sm-3">  
  <ul id="myScrollspy" class="nav-pills  nav-stacked navbar-fixed-left navbar-collapse" style="list-style-type:none";>
  <br/>
    <li class="nav-item"><a class="nav-link active" href="#introduction">Introduction</a></li>
    <li class="nav-item" ><a class="nav-link" href="#authentication">Authentication</a></li>
    <li class="nav-item" ><a class="nav-link" href="#category">Category</a></li>
    <li class="nav-item" ><a class="nav-link"  href="#sub-category">Subcategory</a></li>
    <li class="nav-item" ><a class="nav-link" href="#service">Service</a></li>
    <li class="nav-item" ><a class="nav-link" href="#field">Fields</a></li>
    <li class="nav-item" ><a class="nav-link" href="#plans">Plan</a></li>
    <li class="nav-item" ><a class="nav-link" href="#variation">Variation</a></li>
    <li class="nav-item" ><a class="nav-link"  href="#pay">Making Payment</a></li>
    <li class="nav-item" ><a class="nav-link"  href="#payment-verify">Payment Verification</a></li>
    <li class="nav-item" ><a class="nav-link" href="#balance">Get Balance</a></li>
    <li class="nav-item" ><a class="nav-link" href="#error">Response Code</a></li>
  </ul>  
</div>  
<div class="col-sm-8 read">
    <div id="introduction">
      <h5>Introduction</h5>
 <p>
<?php echo $webConfig["webName"];?> API:- is one of the best and simple VTU online/mobile recharge api, with our API you can  easily integrate Bill Payment, Airtime Purchase, TV Subscription e.t.c, on your website
but before you do anything, you should create a free <?php echo $webConfig["webName"];?> Account account. Then  
we will provide you with API Keys that you can use to make API calls.
<br/>
<br/>
<a class="btn btn-success mr-sm-5" href="../../../../account/register.php"> GET API FOR FREE </a>
    </div>   

	<div id="authentication">
      <h5>Authentication</h5>
 <p>
Authenticate your API calls by including your API KEY in the Authorization header of every request for purchase and subscription. 
You can manage your API keys from the dashboard. Your API KEY should be kept secret, If for any reason you believe your secret key has been
compromised or you wish to reset them, you can do so from the dashboard.
But you don't need authentication to access some part of our API. You can simply make GET Request to query Data. 
</p>
    </div>
    <div id="category" >
      <h5>Category</h5>
      
      <p>Use this request to get the list of all Category in our platform.</p>
	  <h5>Endpoints - Category</h5>
	  <div class="grey rounded text-white">
		  <strong>GET:</strong>  <?php echo $webConfig["webLink"]?>/api/category
		</div>
		<pre>
		<div class="grey rounded" style="color:white !important">
        [
            {
                "displayName": "Electricity Bill",
                "name": "electricity"
            },
            {
                "displayName": "Mobile VTU",
                "name": "mobile_vtu"
            }
        ]
	   </div>
	   </pre>
    </div>
	
    <div id="sub-category">
      <h5>Subcategory</h5>
      <p>A valid response of this request will get the list of all services in a particular Category.</p>
	  <h5>Example and Response: Services under Airtime Purchase</h5>
	  <div class="grey rounded text-white">
		  <strong>GET:</strong>  <?php echo $webConfig["webLink"]?>/api/sub-category?category=mobile_vtu
		</div>
		<pre>
		<div class="grey rounded" style="color:white !important">
[
    {
        "displayName": "MTN VTU",
        "name": "mtn_vtu",
        "image": "\/\/vtu.com\/uploads\/service\/xxxxx.jpg",
        "max": "5000000000",
        "min": "5",
        "fee": "100",
        "planName": "plan", //ignored when not available
        "feePercentage": true,
        "feeCapped": "3"
    }
]
	   </div>
	   </pre>
    </div>  
	
	<div id="service" >
      <h5>Service</h5>
      <p>Request the details of a particular Service including  Name, Logo, Amount, Convenience Fee, Product Type, Minimum and Maximum Amount Allowed, it helps in billing customer and payment validation during transactions,
         with this, you don't necessary need to get all the details of the service from the User End you can dynamically query each service from your Back end.</p>
	  <h5>Example and Response: Services under Airtime Purchase</h5>
	  <div class="grey rounded text-white">
		  <strong>GET:</strong> <?php echo $webConfig["webLink"]?>/api/service?service=mtn_vtu
		</div>
		<pre>
		<div class="grey rounded" style="color:white !important">
    {
        "displayName": "MTN VTU",
        "name": "mtn_vtu",
        "image": "\/\/vtu.com\/uploads\/service\/xxxxxx.jpg",
        "planName": "plan", //ignored when not available
        "max": "5000000000", 
        "min": "5",
        "fee": "100",
        "feePercentage": true,
        "feeCapped": "3"
    }
	   </div>
	   </pre>
    </div>
	
    <div id="field" >
   <h5>Fields</h5>
        <p class="text-justify">This request helps to get the list of available field on a particular service. </p>
	  <h5>Example and Response: fields under 9Mobile</h5>
	  <div class="grey rounded text-white">
		  <strong>GET:</strong>  <?php echo $webConfig["webLink"]?>/api/fields?service=9mobile
		</div>
		<pre>
		<div class="grey rounded" style="color:white !important">
 {
    "service": "9mobile",
    "field": [
        {
            "displayName": "Amount",
            "name": "amount",
            "type": "number",
            "description": "",
            "regExp": "[0-9]+",
            "required": true
        },
        {
            "displayName": "Email",
            "name": "email",
            "type": "email",
            "description": "",
            "regExp": "",
            "required": false
        },
        {
            "displayName": "Phone",
            "name": "phone",
            "type": "text",
            "description": "This is the description",
            "regExp": "[0-9]+",
            "required": true
        },
        {
            "displayName": "Recharge Time",
            "name": "Date",
            "type": "date",
            "description": "",
            "regExp": "",
            "required": false
        }
    ]
}
	   </div>
	   </pre>
	   
	   
    </div>
    
    
    
    <div id="plans" >
   <h5>Plans</h5>
        <p class="text-justify">This request helps to get the list of available plans on a particular service. We are using the Variation for Plan in some case (<i> Variation is a change or slight difference in condition, amount, or level, typically within certain limits </i>)</p>
	  <h5>Example and Response: Plans under Glo Data Subscription</h5>
	  <div class="grey rounded text-white">
		  <strong>GET:</strong>  <?php echo $webConfig["webLink"]?>/api/plans?service=glo-data
		</div>
		<pre>
		<div class="grey rounded" style="color:white !important">
{
    "service": "Glo Data",
    "PlanName": "plan",
    "fixedPrice": true,
    "plans": [
        {
            "displayName": "10000 mb for USD10",
            "value": "10000-mb",
            "price": "100"
        },
        {
            "displayName": "1month unlimited for 30USD",
            "value": "1mon-unlimited",
            "price": "30"
        },
        {
            "displayName": "1 year unlimited for 200USD",
            "value": "1yr-unlimited",
            "price": "200"
        }
    ]
}
	   </div>
	   </pre>
	   
	   
    </div>     
	
	
	<div id="variation" >
   <h5>Variation Detail</h5>
      <p>Query the details of a particular variation including Amount, Variation Name and value, it helps in billing customer, display information Dynamic before/after Payment</p>
	  <h5>Example and Response: gotv as a service and gotv-plus as a plan.</h5>
	  <div class="grey rounded text-white">
		  <strong>GET:</strong>  <?php echo $webConfig["webLink"]?>/api/variation?service=gotv&value=gotv-plus
		</div>
		<pre>
		<div class="grey rounded" style="color:white !important">
{
    "service": "GoTV",
    "PlanName": "gotv-plan",
    "fixedPrice": true,
    "plans": [
        {
            "displayName": "gotv Plus",
            "value": "gotv-plus",
            "price": "100"
        }
    ]
}
	   </div>
	</pre>
    </div>
	   
	
	<div id="pay" >
      <h5>Making Payment</h5>
	  <p>For testing payment use: <?php echo $webConfig["webLink"]?>/api/testpay</p>
	  
        <p class="text-justify">
		There two types of payment, the payment for FIX Service (TV Subscription, Data Plan) 
		which has a fixed amount and plan and the payment for Flexible services like Airtime Purchase.
		</p>
		<p class="text-justify">
		You don't need to know the type of payment for each service, you can dynamically request a service details like Name,
		Minimum and Maximum Amount Allowed and the type as well with our API. 
		The good news is that our system successfully detect your payment type automatically.
		</p>
		
		<p class="text-justify">
		  Parameter for each type of payment are describe below.
		</p>
		
		 <h6>Flexible Payment</h6>
		<p class="text-justify">
		  Flexible payment is the payment for service like Airtime Purchase and bellow are the parameter for Flexible payment.
		</p>
		
		<?php include "payflexi.php";?>
		
		</h5>
	  <h6>Request Flexible Payment (POST REQUEST)</h6>
		<pre>
		<div class="grey rounded" style="color:white !important">
	

    $host = '<?php echo $webConfig["webLink"]?>/pay';
	$refer= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$api =  'ap_xxxxxxxxxxxxxxxxxxx'; //Your API Key
	$data = array(
	'serviceID'=> "gotv", //Merchants or Operator ID ( gotv, airtel, dstv, glo-data etc)
	'plan'=> "gotv-plus", //The plan Subscribing for (gotv-plus, gotv-value etc)
	'amount' =>  1900, // (Required) Amount to pay 
	'customerID' => 111111, // (e.g Dstv SmartCard Number) (Optional).
	'phone' => "0703xxxxxxxxxx", //without country code
	'email' => "name@example.com", //string
	'requestID' => time()+mt_rand() // unique for every transaction
	);  
	$curl       = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $host,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_ENCODING => "",
	CURLOPT_POSTFIELDS => $data,
	CURLOPT_REFERER => $refer,
	CURLOPT_HTTPHEADER => array("Authorization: Bearer $api"),
	CURLOPT_FOLLOWLOCATION=> true,
	CURLOPT_MAXREDIRS => 10,   
	CURLOPT_POSTREDIR => 3,   
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	));
	$r =  curl_exec($curl); 
	curl_close($curl);
	print_r(json_decode($r,true));



	 
	   </div>
	   </pre>
	   
	   
		 <h6>FIX Payment</h6>
		<p class="text-justify">
		  Flexible payment is the payment for service like Airtime Purchase and bellow are the parameter for Flexible payment.
		</p>
		
		<?php include "payfix.php";?>
		
		</h5>
	  <h6>Request Flexible Payment (POST REQUEST)</h6>
		<pre>
		<div class="grey rounded" style="color:white !important">

    $host = '<?php echo $webConfig["webLink"]?>/api/pay';
	$refer= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$api =  'ap_xxxxxxxxxxxxxxxxxxxx'; //Your API Key
	$data = array(
	'serviceID'=> "mtn", //Merchants or Operator ID ( gotv, airtel, dstv, glo-data etc)
	'phone' => "0703xxxxxxxxxx", //integer
	'email' => "name@example.com", //string 
	'amount' =>  1000, // (Required) Amount to pay 
	'requestID' => time()+mt_rand() // unique for every transaction
	);  
	$curl       = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $host,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_ENCODING => "",
	CURLOPT_POSTFIELDS => $data,
	CURLOPT_REFERER => $refer,
	CURLOPT_HTTPHEADER => array("Authorization: Bearer $api"),
	CURLOPT_FOLLOWLOCATION=> true,
	CURLOPT_MAXREDIRS => 10,   
	CURLOPT_POSTREDIR => 3,   
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	));
	$r =  curl_exec($curl); 
	curl_close($curl);
	print_r(json_decode($r,true));


<pre>


	 
	   </div>
	   </pre>
	   
	   
	   <pre>
	   <h6>Response Both Flexible and FIX</h6>
	   <p>The response for Flexible and Fix look similar, just that some Array or json key are left blank if not applicable to the service</p>
		<div class="grey rounded" style="color:white !important">
Array
(
    [code] => 200
    [status] => TRANSACTION_SUCCESSFUL
    [description] => TRANSACTION_SUCCESSFUL
    [content] => Array
        (
            [transactionID] => 189584034893843
            [requestID] => 897439437848
            [amount] => 2
            [phone] => 0703xxxxxxxxxxx
            [serviceID] => mtn
            [email] => name@example.com
            [customerID] => 
            [plan] => 
            [image] => <?php echo $webConfig["webLink"]?>/uploads/XXXXXXXX.jpg
            [convinience_fee] => 0
            [productType] => flexible
            [serviceName] => MTN Airtime VTU
            [status] => TRANSACTION_SUCCESSFUL
            [code] => 000
            [description] => TRANSACTION_SUCCESSFUL
            [date] => 2019-03-22T11:16:05+01:00
        )

    [gateway] => Array
        (
            [referrer] => <?php echo $webConfig["webLink"]?>/xxxxxxxx.html
            [host] => recharge.lajela.com
            [ip] => 185.2.168.39
        )

)

	   </div>
</pre>
	   
	   
</div>  
	
	
<div id="payment-verify" >
   <h5>Payment Verification</h5>
      <p>This is actually useful after  Payment, it helps to verify the status of payment, 
	  (if the payment was successfully or not due to unforeseen circumstance).
	  </p>
	  <p>Use this link to verify testing payment https://<?php echo $webConfig["webLink"]?>/api/testverfy</p>
	  
	  <h5>Example and Response: GoTV Payment.</h5>
	  <pre>
	  <div class="grey rounded text-white">
	$host = 'https://<?php echo $webConfig["webLink"]?>/api/verify';
	$api =  'API KEY'; //Your API Key
	$data = array(
	'requestID' => 8755965695964845 // For the transaction
	);  
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $host,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_ENCODING => "",
	CURLOPT_POSTFIELDS => $data,
	CURLOPT_HTTPHEADER => array("Authorization: Bearer $api"),
	CURLOPT_FOLLOWLOCATION=> true,
	CURLOPT_MAXREDIRS => 10,   
	CURLOPT_POSTREDIR => 3,   
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	));
	$response =  curl_exec($curl); 
	print_r(json_decode($response,true));
		</div>
	</pre>
	<h6>Response</h6>
		<pre>
		<div class="grey rounded" style="color:white !important">
Array
(
    [code] => 402
    [status] => TRANSACTION_FAILED
    [description] => INSUFFICIENT_BALANCE
    [content] => Array
        (
            [transactionID] => 8585405894594
            [requestID] => 3414793352
            [amount] => 2
            [phone] => 090xxxxxxxxxxx
            [serviceID] => gotv
            [email] => user@example.com
            [customerID] => 7017725579
            [plan] => gotv-plus
            [image] => <?php echo $webConfig["webLink"]?>/images/products/200X200/Gotv-Payment.jpg
            [convinience_fee] => 100
            [productType] => fix
            [serviceName] => Gotv Payment
            [status] => TRANSACTION_FAILED
            [code] => 016
            [description] => INSUFFICIENT_BALANCE
            [date] => 2019-03-22T11:16:05+01:00
        )

    [gateway] => Array
        (
            [referrer] => <?php echo $webConfig["webLink"]?>/xxxxxxxx.html
            [host] => recharge.lajela.com
            [ip] => 185.2.168.39
        )

)

	   </div>
</pre>
</div>	
<div id="balance" >
   <h5>Available Balance on Your Account</h5>
      
      <p>Get Your Available Balance.</p>
	  <h5>Example and Response:  Available balance</h5>
		
		  <pre>
		<div class="grey rounded" style="color:white !important">
	  
		$host = '<?php echo $webConfig["webLink"]?>/api/balance';
		$data = array(
		  'api' => 'ap_xxxxxxxxxxxxxxxxxxx' // API KEY
		);
		$curl       = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $host,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_USERPWD => $username.":" .$password,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $data,
		));
		echo curl_exec($curl);
			
		
	  
	   </div>
	</pre>
		
<pre> 
<div class="grey rounded" style="color:white !important">
  {
  "response_description": "000",
  "content": {
  "balance": "841"
   }
   }
  }	  
		  
</div>
</pre>
</div>
	
	

	
	
<div id="error" >
<h5>Response Code</h5>
<p>Bellow are list of Response Code and their respective meaning.</p><pre>
	<div class="grey no-margin no-padding rounded" style="color:white !important">
	'200':'TRANSACTION_SUCCESSFUL',
	'204':'REQUIRED_CONTENT_NOT_SENT', 
	'206':'INVALID_CONTENT',
        '401':'AUTHORIZATION_FAILED', 
        '402':'ERROR_IN_PAYMENT',
        '404':'CONTENT_NOT_FOUND',
	'405':'REQUEST_METHOD_NOT_IN_POST' 
        '406':'NOT_ALLOWED', 
        '502':'GATEWAY_ERROR'
	</div>
</pre>
</div>
</div>
</div>
</div>
</div>
</body>
</html>



<?php include "../include/footer.php";?>