<?php
include '../include/ini_set.php';
include '../include/data_config.php';
?>
<?php include '../include/webconfig.php';?>
<?php include "../language/{$webConfig["LANG"]}.php";?>
<?php 

	$webName = $webConfig["webName"];
	$replyTo = $webConfig["replyTo"];
	$webLink  = $_SERVER["SERVER_NAME"];
	if(!empty($webConfig["webLink"])){  
		$webLink = $webConfig["webLink"];
	}
?>
<?php
$id= $_GET['id'];
$id = preg_replace("/[^0-9]/", "", "$id");
$sql = "SELECT id,service_id,amount,phone,email,status,fee,reg_date FROM api_transaction WHERE id ='$id'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $amount = $row["amount"];
        $phone = $row["phone"];
        $serviceId = $row["service_id"];
        $email = $row["email"];
        $status = $row["status"];
        $fee = $row["fee"];
        $regDate = $row["reg_date"];
		//echo  $paymentCode;
		
    }
}
?>
<?php 

$sql = "SELECT display_name, image FROM service WHERE id='$serviceId' OR name = '$serviceId'";

     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
             // output data of each row
             $serviceValue = $result->fetch_assoc();
     }else{
             $serviceValue["notFound"] = true;
     }
             //print_r($serviceValue);
			
?>
<?php

/*
* Database to pdf.....                                              
* @author Prof.Michael                    
* 09084190126
*/


?>
<?php

require('../fpdf181/fpdf.php');
$pdf = new FPDF('L','mm','A5');
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

$logo = "../uploads/service/".$serviceValue["image"];
$barcode = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$webLink.'/api_transaction/view.php?id='.$id;



$y = $pdf->GetY();

$ph = $pdf->GetPageHeight();
$pw = $pdf->GetPageWidth();
$date = date("l, jS F Y  @ h:ma (T) ",$regDate);
$pdf->SetDrawColor(34,139,34);

$pdf->SetAutoPageBreak(false);


///////////////////////////////////////////
$pdf->SetFont('Arial','B',18);
$y = $pdf->GetY();
$pdf->MultiCell(170,8, $LANG["payment_receipt"],0,'C');
$pdf->SetFont('Arial','',5);
$pdf->SetY($y-1);
$pdf->Image($barcode,null,null,40,40,'PNG');

$pdf->Image($logo,$pw-70,10,60,33);
$pdf->SetXY(5,$y-1.5);
$pdf->Cell(50,5,  strtoupper($LANG["scan_barcode_to_confirm"]) ,0,1,"C");
$pdf->Rect(13.5,12,33,34);
$pdf->SetXY(-70,$y+32);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(60, 8,  strtoupper("$bene") ,"","C");




$pdf->SetY(47);
$y = $pdf->GetY();
$pdf->SetFillColor(34,139,34);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8, strtoupper($LANG["transaction_details"]),"L,B,T,R",1,"L",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);

$pdf->Cell(40,8, strtoupper($LANG["transaction_id"]),"L,B,R",0,"L");
$pdf->Cell(0,8,$id,"R,B,T",1,"L");

$pdf->Cell(40,8, strtoupper($LANG["service"]),"L,B,R",0,"L");
$pdf->Cell(0,8,$serviceValue["display_name"],"R,B,T",1,"L");


$pdf->Cell(40,8, strtoupper($LANG["phone"]),"L,B,R",0,"L");
$pdf->Cell(0,8,$phone,"R,B",1,"L");
$pdf->Cell(40,8, strtoupper($LANG["email"]),"L,R,B",0,"L");
$pdf->Cell(0,8,$email,"R,B",1,"L");
$pdf->Cell(40,8, strtoupper($LANG["status"]),"L,B,R",0,"L");
$pdf->Cell(0,8,strtoupper($LANG[$status]),"R,B",1,"L");
$pdf->Cell(40,8, strtoupper($LANG["date"]),"L,R,B",0,"L");
$pdf->Cell(0,8,$date,"R,B",1,"L");
$pdf->Cell(40,8, strtoupper($LANG["amount"]),"L,R,B",0,"L");
$pdf->Cell(0,8,$webConfig["currency"]["code"].$amount,"R,B",1,"L");
$pdf->Cell(40,8, strtoupper($LANG["fee"]),"L,R,B",0,"L");
$pdf->Cell(0,8,$webConfig["currency"]["code"].$fee,"R,B",1,"L");

$pdf->SetX(100);
$pdf->MultiCell(100,5,"\n$webName www.$webLink",0,'R');
$pdf->SetTitle("Receipt-$id");
////////////////////////////////////////

$pdf->output();
?>