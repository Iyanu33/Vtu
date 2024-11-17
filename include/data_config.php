<?php include_once 'ini_set.php';?>
<?php
	$pre="";
	for($i=0; $i < 20;$i++){
		if(file_exists($pre."lajela_provtu_installation")){
		    if(!empty($pre)){
		        $pre = $pre."/";
		    }
			echo "<script>location.href='$pre"."lajela_provtu_installation/'</script>";
			exit;
		}else{
	  $pre="../".$pre;
		}
	}
	echo "<h1>Web Site Not Installed, Go to www.yoursite.com/lajela_provtu_installation to install</h1>";
exit;
?>