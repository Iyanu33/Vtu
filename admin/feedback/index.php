  <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 
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
 	

<script>
function previewNewsletter(id) {
  window.open("preview.php?id="+id, "_blank", "toolbar=no,scrollbars=no,resizable=yes,status=no");
}
</script>		
		 

		 <title><?php echo $LANG["configuration"]; ?> | <?php echo $LANG["new_feedback"]; ?></title>
		
<section class="container">
  <section id="content">
        
        
          <div class="container">
		   <p class="caption"><?php echo $LANG['feedback']; ?> | <?php echo $LANG["configuration"]; ?> </p>
              <div class="divider"></div>
			  
            <div class="section ">
             
             
                  <!-- Form with placeholder -->
                  <div class="col s12">
                    <div class="card-panel hoverable">			   
	<div class="row flex-items-sm-center px-3">
	<table class="table">
   <?php

		  $sql = "SELECT * FROM feedback";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $date  = date("c",$row["reg_date"]);
				   $date =   time_elapsed_string($date);
				   $id =   $row["id"];
				    $message = $row["message"];
				   if(strlen($message) > 100){
					   $el="...";
				   }
				   $message = substr($message,0,100);
				   $name = $row["firstname"];
				  
					echo "<tr>
					      <td>$name</td>
					      <td>$message$el</td>
					      <td>$date</td>
					      <td><a class=\"btn btn-info btn-sm py-0\"  href=\"view.php?id=$id\" >{$LANG["view"]}</a></td>
				          <td><button class=\"btn btn-danger btn-sm py-0\"  onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_feedback.php?id=$id')\">{$LANG['delete']}</button></td>
					     </tr>";
					
				}
			}else{
				openAlert($LANG["no_feedback_found"]);
			}
		?>
	</table>	 

</div>
</section>

	              </div>
	            </div>
                </div>
              </div>
        </section>
      
    <!-- END MAIN -->
	<?php include "../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
		
		