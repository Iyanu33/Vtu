<?php

class pagination {
    protected  $conn;
    function __construct($conn) {
        $conn = "";
        $this->conn = $conn;
    }
    function perPage(){
        return 12;
    }
    function searchForm($action,$q=""){
        if(empty($action)){
            $action="search.php";
        }
    echo '<form class="col s12 row" action="'.$action.'">
            <div class="col s8 m10 l11">
              <input type="search" required value="'.$q.'" placeholder="'. $GLOBALS['LANG']['search_here_id_email_amount_phone'].'" name="q" class="form-control mb-2 mr-sm-2 col-6" id="search">
            </div>
            <div class="col m2 l1 s4">
              <button type="submit" class="btn  right btn-flat mb-2"><i class="material-icons">search</i></a></button>
             
            </div>
             <div class="clearfix"></div>
        </form>';
    }
    function getData($currentPage,$totalQuery) {
        $perPage = $this->perPage();
         $currentPage =  preg_replace('/\D/', '', $currentPage);
         $perpage =  preg_replace('/\D/', '', $perPage);
         $totalQuery =  preg_replace('/\D/', '', $totalQuery);
          if(empty($currentPage)){
            $currentPage = 1;
            }
            $totalFetch = ($currentPage+$perPage)-1;
            if($currentPage==1){
                   $totalFetch  = 0;
            }

          if(ceil($totalQuery/$perPage)==$currentPage && $totalFetch > $perPage){
                  $totalFetch++;
          }

          if($totalFetch >= $totalQuery && $totalFetch > $perPage ){
                 $totalFetch  = $totalFetch-$perPage;
          }
          $data["start"] = $totalFetch;
          $data["stop"] =  $perPage;
        return $data;
    }
    function getPage($currentPage,$totalQuery,$q="") {
        if(!empty($q)){
            $fq =$q;
            $q = "q=$q&";
        }
        $perPage = $this->perPage();
         $currentPage =  preg_replace('/\D/', '', $currentPage);
         $perpage =  preg_replace('/\D/', '', $perPage);
         $totalQuery =  preg_replace('/\D/', '', $totalQuery);
?>         
<?php if(ceil($totalQuery/$perPage) > 1){ ?>
<div class="col s12">
<br/>
<ul class="pagination">
		
	   <?php 
		  if(empty($currentPage)){
		  $currentPage = 1;
		  }
		  $currentPage =  preg_replace('/\D/', '', $currentPage);
		  $previous =  "?{$q}page=".($currentPage -1);
		  $next =  $currentPage + 1;
	   
	   $active = 'active';
	   $disabled = '';
	   if($currentPage<=1){
		$previous = "javaScript:void(0)";
	   $disabled = 'disabled" style="cursor:not-allowed !important';
	   }
	     echo '<li class="wave-effect '.$disabled.' "><a href="'.$previous.'"><i class="material-icons">chevron_left</i></a></li>';
		  $totalPage = $currentPage+25;
		  $endPage = $currentPage+25;
		  $startPage = $currentPage-(ceil($totalQuery/25));
		  if(ceil($totalQuery/$perPage)-$currentPage <= $totalPage) {
		   $totalPage = ceil($totalQuery/$perPage);
		  }
		  
		  if(  ceil($totalQuery/$perPage) -$currentPage  < 25) {
		    $endPage =  ceil($totalQuery/$perPage);
			$startPage = $currentPage-(ceil($totalQuery/25));
		  }
	       for($i = $startPage; $i <= $endPage; $i++){
		   $active = '';
		   if($i == $currentPage){
		     $active = 'active';
		}
			if($i >=1){
		  echo'<li class="wave-effect '.$active.'"><a href="?'.$q.'page='.$i.'">'.$i.'</a></li>';
		  }
		   }
		    $disabled = '';
			$next = "?{$q}page=".$next;
		    if($currentPage == ceil($totalQuery/$perPage)){
			 $disabled = 'disabled" style="cursor:not-allowed !important';
			 $next = "javaScript:void(0)";
			}
		
		  echo '<li class="wave-effect '.$disabled.'"> <a href="'.$next.'"><i class="material-icons">chevron_right</i></a></li>';
		 
		  
		  ?>
	</ul>	  
		 
<p class="range-field">
<form id="pageForm">
 <?php if(!empty($fq)){?>
    <input type="hidden" value="<?php echo $fq;?>" name="q"/>
 <?php }?>
<input name="page" min="1" value="<?php echo $currentPage ?>" type="range" max="<?php echo ceil($totalQuery/$perPage); ?>" onchange="pageForm.submit()" />
</form>
</p>

<script></script> 
        
        

</div>
<?php  }
    }
}
?>