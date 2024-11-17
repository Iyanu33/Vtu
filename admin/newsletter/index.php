  <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["news_letter"]);   
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
		 

 <title><?php echo $LANG["configuration"]; ?> |  <?php echo $LANG["newsletter"]; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["configuration"]; ?> |  <?php echo $LANG["newsletter"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
		
             <section class="container">
			   
	<div class="row flex-items-sm-center">
	
	<table class="table">
 <?php

		  $sql = "SELECT subject, content,id,reg_date,status,num,sent_date FROM news_letter";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $title =   $row["subject"];
				   $date  = date("c",$row["reg_date"]);
				   $date =   time_elapsed_string($date);
				   $id =   $row["id"];
				   $num = $row["num"];
				   $content =   htmlspecialchars_decode($row["content"]);
				 
				   $content = trim(strip_tags($content)); 
				  // $content = preg_replace("/\[(.*?)\]\s*(.*?)\s*\[\/(.*?)\]/", "[$1]$2[/$3]", $content);
                  $content = preg_replace('/&nbsp;/', ' ', $content);
				  $content = preg_replace('/\s\s/', ' ', $content);
				  if(strlen($content)>20){
					$ellipse = "...";
				  }
			      $content = trim(substr(trim($content),0,20)).$ellipse;
				   $edit = "<td><a class=\"btn btn-primary btn-sm py-0\" href=\"create.php?id=$id\">{$LANG['edit']}</a></td>";
                                   $send = "<td><button type=\"button\" class=\"btn btn-primary right\"  onclick=\"ajaxConfirm('".$LANG["sending_it_out_now"]."','send.php?id=$id')\" > {$LANG["send"]} </button></td>"; 
				   if($row["status"]=="sent"){
					$edit = '<td>'.time_elapsed_string(date("c",$row["sent_date"])).'</td>';
					$send = "<td title=\"{$LANG['newsletter_sent_to']} $num (".strip_tags($edit).") \"><button  class=\"disabled btn btn-success btn-sm py-0\" >{$LANG['sent']}($num)</button></td>"; 
		     	    }
					echo "<tr>
					      <td>$title</td>
					      <td>$content</td>
					      <td>$date</td>
					      <td>$status</td>
					      $send 
					      $edit 
					      <td><button class=\"btn btn-info btn-sm py-0\" onclick=\"previewNewsletter('$id')\">{$LANG['preview']}</button></td>
					      <td><button class=\"btn btn-danger btn-sm py-0\"  onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_newsletter.php?id=$id')\">{$LANG['delete']}</button></td>
					     </tr>";
					
				}
			}else{
				openAlert($LANG["no_record_found"]);
			}
		?>
	</table>	 

</div>
</section>


		
		
		            </div>
		            </div>
		          </div>
                </div>
              </div>
        </section>
       <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_message"]) ?>">
    <a href="new.php" class="btn-floating btn-large">
      <i class="large material-icons">email</i>
    </a>
  </div>
    <!-- END MAIN -->
	<?php include "../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>