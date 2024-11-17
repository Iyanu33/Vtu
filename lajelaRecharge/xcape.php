<?php 
if(!function_exists("xcape")){
 function xcape($conn,$str){
	 return addslashes(mysqli_real_escape_string($conn,$str));
 }
}
?>