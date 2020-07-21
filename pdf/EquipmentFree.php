<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Equipment.class.php';

    $equ = new Equipment();
    $equipFree = $equ->selectById('equipment_list','equipstatus_id',1);
    
    require('../tFPDF/tfpdf.php');
    $pdf = new tFPDF();
    $pdf->AddPage();
    $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
    $pdf->SetFont('DejaVu','',14);

    $pdf->SetFont('','B','16');
    $pdf->Cell(0,9,'Lista slobodne opreme',0,0,'C');
    $pdf->SetFont('','','12');
    $pdf->Ln(20);
    $pdf->Cell(50,10,'Tip opreme',0,0,'C');
    $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
    $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
    $pdf->Cell(50,10,'Serijski broj',0,0,'C');
    $pdf->Ln();
    $pdf->Cell(0,0,'','B',0,'C',false);
    $pdf->Ln();
    foreach($equipFree as $row){
        $pdf->Cell(50,10,$row['equiptype'],0,0,'C');
        $pdf->Cell(50,10,$row['equipproducer'],0,0,'C');
        $pdf->Cell(50,10,$row['inventory'],0,0,'C');
        $pdf->Cell(50,10,$row['serialnumber'],0,0,'C');
        $pdf->Ln();
    }
    $pdf->Output();
?>