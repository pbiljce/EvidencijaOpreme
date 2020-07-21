<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Employees.class.php';

    if(isset($_POST["empReport"]) && !empty($_POST["employees_id"])){
        $emp = new Employees();
        $employeeId = $_POST["employees_id"];
        $equipEmp = $emp->selectById('equipemployee_list','employees_id',$employeeId);
        $employee = $emp->selectById('employees','employees_id',$employeeId);
       
        require('../tFPDF/tfpdf.php');
        $pdf = new tFPDF();
        $pdf->AddPage('L');
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->SetFont('','B','16');
        $pdf->Cell(0,9,'Lista opreme zadužene po zaposlenom',0,0,'C');
        $pdf->SetFont('','','12');
        $pdf->Ln(20);
        foreach($employee as $row){
        $pdf->SetFont('','B');
        $pdf->Cell(0,9,'Zaposleni: ' . $row['firstname'] . " " . $row['lastname'],0,0,'C');
        $pdf->SetFont('','');
        }
        $pdf->Ln(15);
        $pdf->Cell(45,10,'Kancelarija',0,0,'C');
        $pdf->Cell(45,10,'Organizacija',0,0,'C');
        $pdf->Cell(50,10,'Tip opreme',0,0,'C');
        $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
        $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
        $pdf->Cell(50,10,'Serijski broj',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,0,'','B',0,'C',false);
        $pdf->Ln();
        foreach($equipEmp as $row){
            $pdf->Cell(45,10,$row['office'],0,0,'C');
            $pdf->Cell(45,10,$row['organization'],0,0,'C');
            $pdf->Cell(50,10,$row['equiptype'],0,0,'C');
            $pdf->Cell(50,10,$row['equipproducer'],0,0,'C');
            $pdf->Cell(50,10,$row['inventory'],0,0,'C');
            $pdf->Cell(50,10,$row['serialnumber'],0,0,'C');
            $pdf->Ln();
        }
        $pdf->Output();
    }else {
        $emp = new Employees();
        $empNumber = $emp->selectCount('employees','employees_id');
        $totalEmp= $empNumber[0]['Total'];

       
        require('../tFPDF/tfpdf.php');
        $pdf = new tFPDF();
        $pdf->AddPage('L');
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->SetFont('','B','16');
        $pdf->Cell(0,9,'Lista opreme zadužene po zaposlenom',0,0,'C');
        $pdf->SetFont('','','12');
        $pdf->Ln(20);
        for($i = 1; $i <= $totalEmp; $i++){
            $employee = $emp->selectById('employees','employees_id',$i);
            foreach($employee as $r){
                $pdf->SetFont('','B');
                $pdf->Cell(0,9,'Zaposleni: ' . $r['firstname'] . " " . $r['lastname'],0,0,'C');
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
                $equipEmp = $emp->selectById('equipemployee_list','employees_id',$i);
                foreach($equipEmp as $row){
                    $pdf->Cell(45,10,$row['office'],0,0,'C');
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