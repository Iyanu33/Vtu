<? echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<?php
ini_set('memory_limit', '-1');

header("Content-type:application/xml");

header("Content-Disposition: inline; filename='sitemap.xml'");
?>

<?php include '../../include/data_config.php';?>


<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
 <url>

		  <loc>https://www.lajela.com</loc>

		  <lastmod><?php echo date("Y-m-d")?></lastmod>

		  <changefreq>always</changefreq>

</url>

 <url>

		  <loc>https://www.lajela.com/news</loc>

		  <lastmod><?php echo date("Y-m-d")?></lastmod>

		  <changefreq>always</changefreq>

</url>



<?php
	$sql = "SELECT * FROM allcategory ORDER BY reg_date DESC LIMIT 1140";
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
	  echo "
	  <url>

		  <loc>https://www.lajela.com/$link</loc>

		  <lastmod>$lastmod</lastmod>

		  <changefreq>always</changefreq>

	   </url>
	   
	   ";
		   }
	}
?>

<?php
	$sql = "SELECT * FROM allcategory GROUP BY category ORDER BY RAND()";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
		   while($row = $result->fetch_assoc()) {
			$category = $row["category"]; 
			$lastmod = date("Y-m-d");
	  echo "
	  <url>

		  <loc>https://www.lajela.com/category/$category</loc>

		  <lastmod>$lastmod</lastmod>

		  <changefreq>always</changefreq>

	   </url>
	   
	   ";
		   }
	}
?>

<?php
	$sql = "SELECT * FROM allcategory GROUP BY sub_category ORDER BY RAND()";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
		   while($row = $result->fetch_assoc()) {
			$category = $row["sub_category"]; 
			$lastmod = date("Y-m-d");
	  echo "
	  <url>

		  <loc>https://www.lajela.com/$category</loc>

		  <lastmod>$lastmod</lastmod>

		  <changefreq>always</changefreq>

	   </url>
	   
	   ";
		   }
	}
?>
</urlset> 

