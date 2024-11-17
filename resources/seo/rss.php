<?php echo '<?xml version="1.0" encoding="UTF-8" ?>';?>						
<?php 

echo '
<rss version="2.0" xmlns:atom="https://www.w3.org/2005/Atom">
<atom:link href="https://www.lajela./resources/seo/feeds" rel="self" type="application/rss+xml" />
<channel>
';
?>



<?php
ini_set('memory_limit', '-1');

header("Content-type:application/xml");

header("Content-Disposition: inline; filename='sitemap.xml'");
?>

<?php include '../../include/data_config.php';?>

<?php
	$sql = "SELECT * FROM allcategory ORDER BY RAND()";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
		   while($row = $result->fetch_assoc()) {
			$id = $row["id"];
			$media = file_get_contents("https://www.lajela.com/dashboard/productjson.php?id=$id");
			$media =  json_decode($media,true);
			$price = $media["price"];
			$price =  number_format($price,2);
			$title = $media["title"];
			$link =  $media[subCategory].'/'.$media[link];
			//print_r($media);
			$photos = explode(",", $media['image']['link']);
			$firstPhoto = $photos[0];   
			$lastmod = date("Y-m-d");
	  echo '
	       <item>
			<title>'.$media[fullTitle].'</title>
			<link>https://www.lajela.com/'.$link.'</link>
			<description>
			<![CDATA[';
			if(!empty($firstPhoto)){ echo '<img src=https://www.lajela.com/uploads/'.$firstPhoto.'" width="30px" height="30px"/>';}
			echo $filetext.']]></description>
			</item>
			';  
 }
}
?>
</channel>
</rss>

