<?php session_start();?>
<?php include '../include/ini_set.php';?>
<?php 
include "setupinfo.php";
if($setupInfo["database"]==1){
	echo "<script>location.href='admin.php'</script>";
	exit;
}
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <link rel="icon" href="../uploads/2020/8/12/171317843.jpg"/>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<title>VTU Creator Database Installer</title>
<body style="background: rgba(9,64,72,0.5)">

<style>
.text-upper{
text-transform: uppercase;
}
</style>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$readyToGo = true;
$dbServerName = $_POST["serverName"];
$dbUserName =  $_POST["userName"];
$dbPassword =  $_POST["password"];
$dbName =    $_POST["databaseName"];
$confirmPassword=  $_POST["confirmPassword"];
$webLink =  $_POST["link"];

if($dbPassword != $confirmPassword){
    $readyToGo  = false;
    $confirmPasswordError = '<strong class="text-danger right"><small>Passwords do not matched</small></strong>';
}
if(empty($dbServerName)){
   $readyToGo  = false;
   $serverNameError = '<strong class="text-danger right"><small>Server Name is Empty</small></strong>';
}

if(empty($dbUserName)){
   $readyToGo  = false;
   $userNameError = '<strong class="text-danger right"><small>User Name is Empty</small></strong>';
}


if(empty($dbUserName)){
   $readyToGo  = false;
   $linkError = '<strong class="text-danger right"><small>Web URL is Empty</small></strong>';
}

if(empty($dbName)){
   $readyToGo  = false;
   $dbNameError = '<strong class="text-danger right"><small>Database Name is Empty</small></strong>';
}
if($readyToGo===true){
$dbConFille = "<?php
date_default_timezone_set(\"Africa/Lagos\");
\$dbServerName = '$dbServerName';
\$dbUserName = '$dbUserName';
\$dbPassword = '$dbPassword';
\$dbName = \"$dbName\";
\$conn=mysqli_connect(\"\$dbServerName\",\"\$dbUserName\",\"\$dbPassword\",\"\$dbName\");
// Check connection
if (mysqli_connect_errno()) {
echo \"Failed to connect to MySQL: \" . mysqli_connect_error();
}
?>"
.'<?php
 if(session_status()== PHP_SESSION_NONE){
     session_start();
 }
 if(empty($webConfig["LANG"]) && !empty($_SESSION["LANG"])){
     $webConfig["LANG"] = $_SESSION["LANG"];
 }elseif(empty($webConfig["LANG"]) && !empty($_COOKIE["LANG"])){
     $webConfig["LANG"] = $_COOKIE["LANG"];
 }elseif(empty($webConfig["LANG"])){
        $result = $conn->query("SELECT value FROM web_config WHERE array_key = \'webLang\' LIMIT 1");
        if ($result->num_rows > 0) {
        $webConfig["LANG"] = $result->fetch_assoc()["value"];
      }  else {
          $webConfig["LANG"] = "en";
        
   }
}
 
?>';
$dbservername = $dbServerName;
$dbusername = $dbUserName;
$dbpassword = $dbPassword;
$dbname = $dbName;

$conn=mysqli_connect("$dbservername","$dbusername","$dbpassword","$dbname");

// Check connection
if (mysqli_connect_errno()) {
 $outputMessage = '<div class="alert alert-danger alert-dismissable">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  Failed to connect to MySQL:  '. mysqli_connect_error().'
					</div>';

}else{
    file_put_contents("../include/data_config.php",$dbConFille);
    include "sql.php";
	
$sql = "SELECT  id FROM web_config LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $setupInfo["database"] = 1;
	$setupDatabase = $setupInfo["database"];
	$setupAdmin = $setupInfo["admin"];
	$setupKey = $setupInfo["key"];

	$formSetup = "<?php
	\$setupInfo[\"database\"]=$setupDatabase;
	\$setupInfo[\"admin\"]=$setupAdmin;
	\$setupInfo[\"key\"]=$setupKey;
	?>";

	file_put_contents('setupinfo.php',$formSetup);
	
   echo "<script>location.href='admin.php'</script>"; 
   
   $LINK = mysqli_real_escape_string($conn, $webLink);
$conn->query("UPDATE web_config SET value='$LINK' WHERE array_key='webLink'");

   
}else{
   $outputMessage = '<div class="alert alert-danger alert-dismissable">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  Unknown Error Occurred Database could not be Installed.
					</div>';
}
    $conn->close($conn);

}
}
}
?>
<?php 
if(empty($_SESSION["webLink"]) && !empty($_GET["link"])){
$_SESSION["webLink"] = preg_replace("/\/lajela_provtu_installation.+/","",$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);          
}?>
		<section class="container">
			<div class="row flex-items-sm-center justify-content-center">
			 
				<div class="col-sm-5 py-3 mt-5 bg-white text-dark border border-info">
					<div class="col-sm-12 text-info"><h5> Lajela Pro VTU Database Installer </h5></div>
					<hr/>
				<div class="col-sm-12"> <?php echo $outputMessage;?>
				</div>
					<form class="row flex-items-sm-center justify-content-center  px-3 overflow-hidden " method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
							
					<div class="row w-100 col-sm-12" id="student">
						<div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Host Name</label>
							<input type="text" placeholder="localhost" value='<?php echo $dbServerName;?>' class="form-control form-control-sm" name="serverName" id="serverName"  required>
						    <?php echo $serverNameError;?>
						  </div>
						  
						  <div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Database Name</label>
							<input type="text"  placeholder="Created Database" value='<?php echo $dbName;?>' class="form-control form-control-sm" name="databaseName" id="databaseName"  required>
						      <?php echo $dbNameError;?>
						  </div>

						  <div class="col-sm-12 form-group">
							<label for="" class="form-control-label">User Name</label>
							<input  placeholder="Database User" type="text" value='<?php echo $dbUserName;?>' class="form-control form-control-sm" name="userName" id="userName"  required>
						       <?php echo $userNameError;?>
						  </div>
						
						<div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Password</label>
							<input  placeholder="Password" type="password" value='<?php echo $dbPassword;?>' class="form-control form-control-sm" name="password" >
						   <input type="hidden" name="link" />
						  
						</div>	

                                              <div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Confirm</label>
							<input  placeholder="Confirm Password"  type="password" value='<?php echo $confirmPassword;?>' class="form-control form-control-sm" name="confirmPassword" >
						    <?php echo $confirmPasswordError;?>
						  
						</div>								

                                              <div class="col-sm-12 form-group">
                                                  <label for="" class="form-control-label">File URL without "http(s)// and www."<br/> example.com or example.com/recharge</label>
							<input  placeholder="file url"  type="text" value='<?php echo $_SESSION["webLink"];?>' class="form-control form-control-sm" name="link" >
						    <?php echo $linkError;?>
						  
						</div>								
						
						  
						<div class="col-sm-12 form-group">
						<button class="btn btn-md btn-info float-right text-upper">Install Database</button>
						   
						  
						</div>	
						
					</div>
							
					</form>
				</div>
			</div>
		</section>
</div>