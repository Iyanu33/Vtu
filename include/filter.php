<?php 
    function xcape($conn, $var){ 
	   $var = mysqli_real_escape_string($conn,$var);
	  return  htmlspecialchars($var);
	}
	function checkName(){
		return '/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';
	}
function javaScriptRedirect($url,$newTab=false){
    if($newTab===true){
       echo "<script>window.open(\"$url\");</script>";
    }else {
    echo "<script>location.href=\"$url\";</script>";
    }
    exit;
}
function javaScriptPushState($url,$full=false){
    if($full===true){
    echo "<script>
    history.pushState(null, '', '$url');
    </script>";
    }else{
    echo "<script>
    history.pushState(null, '', location.href+'$url');
    </script>";
    }
}
?>