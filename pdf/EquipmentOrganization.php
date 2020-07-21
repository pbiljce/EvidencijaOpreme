<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Employees.class.php';
    require '../Organization.class.php';

    if(isset($_POST["orgReport"]) && !empty($_POST["org_id"])){
        $emp = new Employees();
        $orgId = $_POST["org_id"];
        $equipOrg = $emp->selectById('equipemployee_list','organization_id',$orgId);
        $org = new Organization();
        $organization = $org->selectById('organization','organization_id',$orgId);
       
        require('../tFPDF/tfpdf.php');
        $pdf = new tFPDF();
        $pdf->AddPage('L');
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->SetFont('','B','16');
        $pdf->Cell(0,9,'Lista opreme zadužene po organizacionim jedinicama',0,0,'C');
        $pdf->SetFont('','','12');
        $pdf->Ln(20);
        foreach($organization as $row){
        $pdf->SetFont('','B');
        $pdf->Cell(0,9,'Organizaciona jedinica: ' . $row['organization'],0,0,'C');
        $pdf->SetFont('','');
        }
        $pdf->Ln(15);
        $pdf->Cell(45,10,'Ime',0,0,'C');
        $pdf->Cell(45,10,'Prezime',0,0,'C');
        $pdf->Cell(45,10,'Broj kancelarije',0,0,'C');
        $pdf->Cell(50,10,'Tip opreme',0,0,'C');
        $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
        $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
        $pdf->Cell(50,10,'Serijski broj',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,0,'','B',0,'C',false);
        $pdf->Ln();
        foreach($equipOrg as $row){
            $pdf->Cell(45,10,$row['firstname'],0,0,'C');
            $pdf->Cell(45,10,$row['lastname'],0,0,'C');
            $pdf->Cell(45,10,$row['office'],0,0,'C');
            $pdf->Cell(50,10,$row['equiptype'],0,0,'C');
            $pdf->Cell(50,10,$row['equipproducer'],0,0,'C');
            $pdf->Cell(50,10,$row['inventory'],0,0,'C');
            $pdf->Cell(50,10,$row['serialnumber'],0,0,'C');
            $pdf->Ln();
        }
        $pdf->Output();
    }else {
        $org = new Organization();
        $orgNumber = $org->selectCount('organization','organization_id');
        $totalOrg = $orgNumber[0]['Total'];
        $emp = new Employees();
       
        require('../tFPDF/tfpdf.php');
        $pdf = new tFPDF();
        $pdf->AddPage('L');
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->SetFont('','B','16');
        $pdf->Cell(0,9,'Lista opreme zadužene po organizacionim jedinicama',0,0,'C');
        $pdf->SetFont('','','12');
        $pdf->Ln(20);
        for($i = 1; $i <= $totalOrg; $i++){
            $organization = $org->selectById('organization','organization_id',$i);
            foreach($organization as $r){
                $pdf->SetFont('','B');
                $pdf->Cell(0,9,'Organizaciona jedinica: ' . $r['organization'],0,0,'C');
                $pdf->SetFont('','');
                $pdf->Ln(15);
                $pdf->Cell(45,10,'Ime',0,0,'C');
                $pdf->Cell(45,10,'Prezime',0,0,'C');
                $pdf->Cell(45,10,'Broj kancelarije',0,0,'C');
                $pdf->Cell(50,10,'Tip opreme',0,0,'C');
                $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
                $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
                $pdf->Cell(50,10,'Serijski broj',0,0,'C');
                $pdf->Ln();
                $pdf->Cell(0,0,'','B',0,'C',false);
                $pdf->Ln();
                $equipOrg = $emp->selectById('equipemployee_list','organization_id',$i);
                foreach($equipOrg as $row){
                    $pdf->Cell(45,10,$row['firstname'],0,0,'C');
                    $pdf->Cell(45,10,$row['lastname'],0,0,'C');
                    $pdf->Cell(45,10,$row['office'],0,0,'C');
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