<?php session_start();?>
<?php include '../include/ini_set.php';?>
<?php include '../include/data_config.php';?>
<?php include '../include/webconfig.php';?>
<?php include '../include/filter.php';?>

  <?php 
  
include "setupinfo.php";
if($setupInfo["admin"]==1){
	echo "<script>location.href='../admin/login.php'</script>";
	exit;
}
?>
 <link rel="icon" href="../uploads/2020/8/12/171317843.jpg"/>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<body style="background: rgba(9,64,72,0.2)">

<style>
.text-upper{
text-transform: uppercase;
}
</style>

<?php 

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = xcape($conn, $_POST['username']);
	$name = xcape($conn, $_POST['name']);
	$email = xcape($conn, $_POST['email']);
	$phone = xcape($conn, $_POST['phone']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);	
	$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
	$regDate = time(); 
	$prc = 1;
	$id = md5(mt_rand());
	

	
	if($confirmPassword != $password){
	   $confirmPasswordError ='<strong class="text-danger float-right"><small>Password do not match</small></strong>';
	   $prc=0;
	 } if(empty($name)){
	 $nameError ='<strong class="text-danger float-right"><small>Please provide the Full Name</small></strong>';
	 $prc = 0;
	 }if(empty($username)){
	 $userNameError='<strong class="text-danger float-right"><small>Please provide the User Name</small></strong>';
	 $prc=0;
	 } if(empty($email)){
	 $emailError ='<strong class="text-danger float-right"><small>Email is empty</small></strong>';
	 $prc=0;
	 }if(empty($password)){
	 $passwordError ='<strong class="text-danger float-right"><small>Password is empty</small></strong>';
	 $prc=0;
	 } if(empty($confirmPassword)){
	 $confirmPasswordError ='<strong class="text-danger float-right"><small> Confirm Password is empty</small></strong>';
	 $prc=0;
	 } if (empty($phone)){
	 $phoneError ='<strong class="text-danger float-right"><small> Please Provide the phone number</small></strong>';
	 $prc=0;
	 }
	
	 
	 if(preg_match('/\W+/',$username)){
		 $prc= 0;
		 $userNameError ='<strong class="text-danger float-right"><small> Unaccepted character user A-Z,0-9 and  _</small></strong>';
	 }
	 
	 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$prc= 0;
		    $emailError ='<strong class="text-danger float-right"><small> Invalid Email</small></strong>';
		}
	
	 if($prc ==1){
	   $sql = "UPDATE admin SET
	    id =  '$id',
		name = '$name',	
		email = '$email',	
		phone = '$phone',
		password = '$hashPassword',
		reg_date = '$regDate',
		user_name = '$username', 
		last_update = '$regDate'
		WHERE user_name = 'admin' OR id = '6a5ada64b9fced4f781d56a3936ec02c';
   ";	 
  
  if(!$conn->query($sql)){
	  echo $conn->error;
  }
  
}
}
	
  
 ?>
  <?php 

function rrmdir($dir){
if(is_dir($dir)){
$objects=scandir($dir);
foreach($objects as $object){
if($object!="."&& $object!=".."){
if(is_dir($dir."/".$object))
rrmdir($dir."/".$object);
else
unlink($dir."/".$object);
}
}
rmdir($dir);
}
}
    
	
$sql = "SELECT  id FROM admin WHERE id='$id' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
	$setupDatabase = $setupInfo["database"];
	$setupAdmin = 1;
	$setupKey = $setupInfo["key"];
    $_SESSION['admin'] = $id;
	$formSetup = "<?php
	\$setupInfo[\"database\"]=$setupDatabase;
	\$setupInfo[\"admin\"]=$setupAdmin;
	\$setupInfo[\"key\"]=$setupKey;
	?>";

	file_put_contents('setupinfo.php',$formSetup);
	if($_POST["deleteFolder"]==1){
		rrmdir("../lajela_provtu_installation");
	}
   $_SESSION["admin"] = $id;
   $_SESSION["admin_password"] = md5($hashPassword);
   echo "<script>location.href='../admin/'</script>"; 
  }
 
?>
  
 


 <title>Create Admin</title>


		
		<section class="container">
			
					<form class="row  flex-items-sm-center justify-content-center overflow-hidden py-3" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
							
					<div class="col-sm-4 row bg-white rounded">
					<div class="col s12 form-group">
					    <?php echo $output; ?>
						</div>
                       		<div class="col-sm-12 form-group">
							<h6 ><?php echo strtoupper("Admin SET UP");?>:</h6>
							<hr color="#fff"/>
							</div>
                       		<div class="col-sm-12 form-group">
							<label for="" class="form-control-label">User Name</label>
							<input type="text" value='<?php echo $username;?>' class="form-control form-control-sm" name="username" id="username" required>
							
						    <?php echo $userNameError;?>
						  
						</div>	
						
						<input value="<?php echo $do_to;?>" type="hidden" class="form-control" name="do_to" >
						
						
						<div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Full Name</label>
							<input type="text" value='<?php echo $name;?>' class="form-control form-control-sm" name="name" id="name"  required>
						   
						   <?php echo $nameError;?>
						
						</div>
			
						<div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Phone</label>
					  		<input type="tel"   value='<?php echo $phone;?>' class="form-control form-control-sm" name="phone" id="phone" required >
							 <?php echo $phoneError;?>
						</div>
						
						<div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Email</label>
					  		<input type="email" value='<?php echo $email;?>'  class="form-control form-control-sm" name="email" id="email"  required>
							 <?php echo $emailError;?>
						</div>
						
						
						
						<div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Password</label>
							<input type="password" value='<?php echo $password;?>' class="form-control form-control-sm" name="password" required>
						     <?php echo $passwordError;?>
						  
						</div>	

                        <div class="col-sm-12 form-group">
							<label for="" class="form-control-label">Confirm</label>
							<input type="password" value='<?php echo $confirmPassword;?>' class="form-control form-control-sm" name="confirmPassword" required>
						    <?php echo $confirmPasswordError;?>
						  
						</div>
  	
								
								
						<div class="col-sm-12 form-group text-success">
						<input name="deleteFolder" checked type ="checkbox" value="1">Delete Installation Folder When Done
						</div>
						<div class="col-sm-12 form-group">
							<button class="btn btn-md btn-success float-right">Create Admin</button>
						   
						  
						</div>	
						
						   
					</div>
						
						    
						
						
					</form>
			
		</section>