<?php  if(empty($_SESSION['visitor'])){ 
    function _getRealIpAddr_(){ 
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
           $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        } 
        return $ip; 

        } $ip = _getRealIpAddr_();
        $time = time(); 
        $_SESSION['visitor'] = 1; 
        $sql = "INSERT INTO visitor (time, ip) VALUES ('$time', '$ip')";
        $conn->query($sql); 
                
}