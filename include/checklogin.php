<?php
   session_start();
   
   function includeDBLogin($file){
	if(file_exists($file)){
		return $file;	
	}else if(file_exists("../$file")){
			return "../$file";
	}else if(file_exists("../../$file")){
		return "../../$file";
	}else if(file_exists("../../../$file")){
		return "../../../$file";
	}else if(file_exists("../../../../$file")){
		return "../../../../$file";
	}
}
   
   
   function loginJavaScriptExitLocationDirect($url){
       echo "<script>location.href='$url'</script>";
   }
     if(empty($_SESSION["webLink"])){
       include_once 'data_config.php';
      $_SESSION["webLink"] = $conn->query("SELECT value FROM web_config WHERE array_key='webLink'")->fetch_assoc()["value"];
   }
        $ts = includeDBLogin($_SERVER["REQUEST_URI"]);
        $ts = base64_encode($ts);
    if(!isset($_SESSION['login_user'])){
 
      loginJavaScriptExitLocationDirect("//{$_SESSION["webLink"]}/account/login.php?do_to=$ts");
	    exit;
   }else{ 
        $loginUser = $_SESSION["login_user"];
            include_once 'data_config.php';
          $sql = "SELECT id FROM users  WHERE  id = '$loginUser' AND status='block' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			unset($_SESSION["login_user"]);
			loginJavaScriptExitLocationDirect("//{$_SESSION["webLink"]}/account/login.php?do_to=$ts");
	        exit;
		}else{
		
		$sql = "SELECT password FROM users  WHERE  id = '$loginUser'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				
			 while($row = $result->fetch_assoc()) {
		        if($_SESSION["user_password"]!=md5($row["password"])){
                           loginJavaScriptExitLocationDirect("//{$_SESSION["webLink"]}/account/logout.php");
	        exit;
                        }
		}
	}
}
               $date = time();
   
		$sql = "UPDATE users SET last_seen='$date' WHERE id='$loginUser'";
		$conn->query($sql);
		$conn->close();
   
   }
  ?>   