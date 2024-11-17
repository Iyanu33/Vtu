<?php
      function mailNoti($sendService,$payAmount,$id,$date,$name,$lit){
	if(empty($name)){
            $name = $GLOBALS["LANG"]["customer"];
        }
        $date = date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$date);
        $message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong> '.$GLOBALS["LANG"]["hey"].' '.$name.',</strong> </p>
        <p>'.$GLOBALS["LANG"]["your_transaction_was_successful_view_the_transaction_details_below"].'</p>'." 
	<p>{$GLOBALS["LANG"]["amount"]}: {$GLOBALS["webConfig"]["currency"]["code"]}$payAmount </p>
	<p>{$GLOBALS["LANG"]["transaction_id"]}: $id.</p>
	<p>{$GLOBALS["LANG"]["service"]}: $sendService.</p>
	<p>{$GLOBALS["LANG"]["date"]}: $date</p>
	<p><center>$lit</center></p>
	<p>{$GLOBALS["LANG"]["kind_regards"]}</p>
	</div>
	</center>
	"; 
        return $message;
 }