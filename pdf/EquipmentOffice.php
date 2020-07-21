<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Employees.class.php';
    require '../Office.class.php';

    if(isset($_POST["officeReport"]) && !empty($_POST["office_id"])){
        $emp = new Employees();
        $officeId = $_POST["office_id"];
        $equipOff = $emp->selectById('equipemployee_list','office_id',$officeId);
        $off = new Office();
        $office = $off->selectById('office','office_id',$officeId);
       
        require('../tFPDF/tfpdf.php');
        $pdf = new tFPDF();
        $pdf->AddPage('L');
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->SetFont('','B','16');
        $pdf->Cell(0,9,'Lista opreme zadužene po kancelarijama',0,0,'C');
        $pdf->SetFont('','','12');
        $pdf->Ln(20);
        foreach($office as $row){
        $pdf->SetFont('','B');
        $pdf->Cell(0,9,'Kancelarija: ' . $row['office'],0,0,'C');
        $pdf->SetFont('','');
        }
        $pdf->Ln(15);
        $pdf->Cell(45,10,'Ime',0,0,'C');
        $pdf->Cell(45,10,'Prezime',0,0,'C');
        $pdf->Cell(45,10,'Organizacija',0,0,'C');
        $pdf->Cell(50,10,'Tip opreme',0,0,'C');
        $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
        $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
        $pdf->Cell(50,10,'Serijski broj',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,0,'','B',0,'C',false);
        $pdf->Ln();
        foreach($equipOff as $row){
            $pdf->Cell(45,10,$row['firstname'],0,0,'C');
            $pdf->Cell(45,10,$row['lastname'],0,0,'C');
            $pdf->Cell(45,10,$row['organization'],0,0,'C');
            $pdf->Cell(50,10,$row['equiptype'],0,0,'C');
            $pdf->Cell(50,10,$row['equipproducer'],0,0,'C');
            $pdf->Cell(50,10,$row['inventory'],0,0,'C');
            $pdf->Cell(50,10,$row['serialnumber'],0,0,'C');
            $pdf->Ln();
        }
        $pdf->Output();
    }else {
        $off = new Office();
        $offNumber = $off->selectCount('office','office_id');
        $totalOff= $offNumber[0]['Total'];
        $emp = new Employees();
       
        require('../tFPDF/tfpdf.php');
        $pdf = new tFPDF();
        $pdf->AddPage('L');
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->SetFont('','B','16');
        $pdf->Cell(0,9,'Lista opreme zadužene po kancelarijama',0,0,'C');
        $pdf->SetFont('','','12');
        $pdf->Ln(20);
        for($i = 1; $i <= $totalOff; $i++){
            $office = $off->selectById('office','office_id',$i);
            foreach($office as $r){
                $pdf->SetFont('','B');
                $pdf->Cell(0,9,'Kancelarija: ' . $r['office'],0,0,'C');
                $pdf->SetFont('','');
                $pdf->Ln(15);
                $pdf->Cell(45,10,'Ime',0,0,'C');
                $pdf->Cell(45,10,'Prezime',0,0,'C');
                $pdf->Cell(45,10,'Organizacija',0,0,'C');
                $pdf->Cell(50,10,'Tip opreme',0,0,'C');
                $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
                $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
                $pdf->Cell(50,10,'Serijski broj',0,0,'C');
                $pdf->Ln();
                $pdf->Cell(0,0,'','B',0,'C',false);
                $pdf->Ln();
                $equipOff = $emp->selectById('equipemployee_list','office_id',$i);
                foreach($equipOff as $row){
                    $pdf->Cell(45,10,$row['firstname'],0,0,'C');
                    $pdf->Cell(45,10,$row['lastname'],0,0,'C');
                    $pdf->Cell(45,10,$row['organization'],0,0,'C');
                    $pdf->Cell(50,10,$row['equiptype'],0,0,'C');
                    $pdf->Cell(50,10,$row['equipproducer'],0,0,'C');
                    $pdf->Cell(50,10,$row['inventory'],0,0,'C');
                    $pdf->Cell(50,10,$row['serialnumber'],0,0,'C');
                    $pdf->Ln();
                }
            }
            $pdf->Ln(15);
        }
        $pdf->Output();
    }
?>