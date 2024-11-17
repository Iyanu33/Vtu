  <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["feedback"]);
     
?>
 
 
  <?php
 
	function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
 
		 
 <?php


   $id = xcape($conn,$_GET["id"]);
   $sql = "SELECT * FROM feedback WHERE id = '$id'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	   $content =   $row["message"]; 
	    $firstName = $row["firstname"];
	    $lastName = $row["lastname"];
	    $phone = $row["phone"];
	    $email = $row["email"];
	    $ip = $row["ip"];
	   $date  = date("c",$row["reg_date"]);
	  $date =   time_elapsed_string($date);
  
	}
}

?>

 <title><?php echo $LANG['feedback']; ?> </title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG['feedback']; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">

	<div class="container">	   
	<div class="row flex-items-sm-center">
	<div class="col-12 py-2">
	
<table class="table" border="1">
<tr>
    <td>
	    <?php echo $LANG['first_name']; ?>
	</td>
    <td>
	    <?php echo $firstName?>
    </td> 
	
	
</tr>
<tr>
	<td>
	 <?php echo $LANG['last_name']; ?>
	</td>
	


	
    <td>
	    <?php echo $lastName?>
    </td> 
	
</tr>
<tr>
	<td>
	   <?php echo $LANG['phone']; ?>
	</td>
    <td>
	    <?php echo $phone?>
    </td> 
	
</tr>
<tr>

<td>
	   <?php echo $LANG['email']; ?>
	</td>
    <td>
	    <?php echo $email?>
    </td>
	
</tr>

<tr>

	<td>
	 <?php echo $LANG['date']; ?>
	</td>
    <td>
	    <?php echo $date?>
    </td>
</tr>
<tr>

<td>
	  <?php echo $LANG['ip_address']; ?>
	</td>
    <td>
	    <?php echo $ip?>
    </td>
</tr>
<tr>
<td colspan="3">
 <center> <?php echo $LANG['message_body']; ?></center>
</td>
</tr>

<tr>
<td colspan="3">
    <?php echo $content?>
</td>
</tr>
</table>

</div>
</div>
 </div>
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