        <?php include '../include/checklogin.php';?>
		<?php include '../include/header.php';?>
		 <?php include '../../include/data_config.php';?>
		 <?php include '../../include/filter.php';?>
		 <?php 
		include '../include/admininfo.php';
		$adminInfo = adminInfo($loginAdmin,$conn);
		//print_r($adminInfo);
		 checkAccess($adminInfo["news_letter"]);
			 
		?>
		 
<?php
				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$prc = 1;
	$title = xcape($conn, $_POST['title']);
	$id= md5(time()+mt_rand());
     if(empty($title)){
         alertDanger($LANG["title_is_empty"]);
		$prc = 0;
	 }
	$regDate = time(); 


	
	 if($prc ==1){
$sql = "INSERT INTO news_letter (
		id,
		subject, 
		reg_date)
VALUES ('$id',
		'$title', 
		'$regDate'
		)";

	 if ($conn->query($sql) === TRUE) {
	 echo "<script>location.href='create.php?id=$id'</script>";
	 } else {
             alertDanger($LANG["operation_failed"]);
			// echo "Error: " . $sql . "<br>" . $conn->error;
	}
    }
	}
	$conn->close();
	
	?>
		
		 
 <title><?php echo $LANG["configuration"];?> | <?php echo $LANG["create_new_newsletter"];?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["configuration"];?> | <?php echo $LANG["create_new_newsletter"];?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
		


<div class="row flex-items-sm-center justify-content-center">  

		    <form class="row  py-2" method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
			<div class="col s12 input-field">
			<input id="title" class="form-control" value="<?php echo htmlspecialchars_decode($title) ;?>" required name="title" type="text"/> 
			<label><?php echo $LANG['subject'];?> </label>
					</div>		
			<div class="col s12 form-group">
			<input  type="submit" class="btn btn-primary right" value="<?php echo $LANG['next']; ?>"  /> 
			</div>
			
				
				
		</form>

</section>


		
		            </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>
       <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>">
    <a href="index.php" class="btn-floating btn-large">
      <i class="large material-icons">home</i>
    </a>
  </div>
    <!-- END MAIN -->
	<?php include "../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>