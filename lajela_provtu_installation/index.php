<?php session_start();?>
<?php include '../include/ini_set.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>VTU Creator Installation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../uploads/2020/8/12/171317843.jpg"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body style="background:rgba(0,0,0,.5)">
  
<?php 
$_SESSION["webLink"] = preg_replace("/\/lajela_provtu_installation.+/","",$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);      
?>
  
  
<div class="container">
<div class="row flex-items-sm-center justify-content-center ">
<div class="col-sm-9 card mt-5 pt-4">
  <h2>Welcome VTU Creator Installation</h2>
  <ol>
 
	  <li>Create New MysQL Database
	  <li>Create Database User and give necessary privileges like  CREATE, DELETE, SELECT, DROP, INSERT etc.
	  <li>Follow the instruction to install on your Server</li>
  
  </ol>   
<h4>For Installation Issue Please Take Note:</h4>

 <ul>
 
	  <li>Database is located on 'lajela_provtu_installation' folder
	  <li>Your can manually Edit Database connectivity at include/data_config.php.
	 
  
  </ul>   
 
  <hr/>
  <div>
   <a class="btn btn-info float-left"  target="_blank" href="//provtu.lajala.com/terms.php">LICENSE AGREEMENT</a>  
   <a class="btn btn-success float-right" href="start.php?link=<?php echo base64_encode($_SESSION["webLink"])?>">GOT IT </a>  
   </div>
   <br/>
   </div>
  
</div>
</div>
</div>
</body>
</html>