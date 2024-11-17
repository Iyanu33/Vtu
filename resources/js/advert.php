<?php header('Content-type: text/javascript');?>
<?php
include '../../include/data_config.php';
$webLink = $conn->query("SELECT value FROM web_config WHERE array_key='webLink'")->fetch_assoc()["value"];
?>
var ad = {lococation:"side",width:"100%",height:"100%",random:true,display:function(){document.write('<a  href="//<?php echo $webLink;?>/ad_click.php?widget='+this.widget+'" target="_blank"> <img  src="//<?php echo $webLink;?>/banner.php?type='+this.lococation+'" width="'+this.width+'"  height="'+this.height+'"></a>')}}