<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Employees.class.php';

    if(isset($_POST["obligateEquipEmp"])){
        if(!empty($_POST['equipEmpChecked'])){
            $emplo = new Employees();
            $id = $_POST["empid"];
            $equipEmpChecked = $_POST["equipEmpChecked"];
            $employee = $emplo->selectById('employees_list','employees_id',$id);
            $obligationList = $emplo->selectAll('equipemployee_list',' WHERE employees_id=' . $id . ' AND equipment_id IN (' . $equipEmpChecked . ')');

            require('../tFPDF/tfpdf.php');
            $pdf = new tFPDF();
            $pdf->AddPage();
            $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
            $pdf->SetFont('DejaVu','',14);

            foreach($employee as $row){
                $pdf->Cell(10,10,'Ime: ');
                $pdf->Cell(20,10,$row['firstname']);
                $pdf->Ln();
                $pdf->Cell(20,10,'Prezime: ');
                $pdf->Cell(20,10,$row['lastname']);
                $pdf->Ln();
                $pdf->Cell(52,10,'Organizaciona jedinica: ');
                $pdf->Cell(20,10,$row['organization']);
                $pdf->Ln();
            }
            $w = $pdf->GetStringWidth($row['firstname'])+6;
            //$pdf->SetX((210-$w)/2);
            // Colors of frame, background and text
            $pdf->SetDrawColor(0,0,0);
            //$pdf->SetFillColor(230,230,0);
            //$pdf->SetTextColor(220,50,50);
            // Thickness of frame (1 mm)
            $pdf->SetLineWidth(0.3);
            // Title

            // Line break
            $pdf->Ln(30);
            $pdf->Cell(0,9,'REVERS ZADUŽENJA',0,0,'C');
            $pdf->Ln(30);
            $pdf->Cell(50,10,'Tip opreme',0,0,'C');
            $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
            $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
            $pdf->Cell(50,10,'Serijski broj',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(0,0,'','B',0,'C',false);
            $pdf->Ln();
            foreach($obligationList as $row){
                $pdf->Cell(50,10,$row['equiptype'],0,0,'C');
                $pdf->Cell(50,10,$row['equipproducer'],0,0,'C');
                $pdf->Cell(50,10,$row['inventory'],0,0,'C');
                $pdf->Cell(50,10,$row['serialnumber'],0,0,'C');
                $pdf->Ln();
            }
            $pdf->Ln(60);
            $pdf->Cell(70,10,'Opremu predao',0,0,'L');
            $pdf->Cell(110,10,'Opremu zadužio',0,0,'R');
            $pdf->Ln();
            $pdf->Cell(70,10,'_________________',0,0,'L');
            $pdf->Cell(110,10,'_________________',0,0,'R');
            $pdf->Output();
        }
        else {
            echo "<script>alert('Morate označiti opremu za koju hoćete da štampate revers zaduženja.')</script>";
        }
    }elseif(isset($_POST["obligateEquipE"])){
        if(!empty($_POST['equipEmpChecked'])){
            $emplo = new Employees();
            $id = $_POST["empid"];
            $equipEmpChecked = $_POST["equipEmpChecked"];
            $employee = $emplo->selectById('employees_list','employees_id',$id);
            $obligationList = $emplo->selectAll('equipemployee_list',' WHERE employees_id=' . $id . ' AND equipment_id IN (' . $equipEmpChecked . ')');
    
    
            $equipCheck = explode(',',$equipEmpChecked);
            foreach($equipCheck as $checked){
                $emplo->obligate('employeeequip_obligation',$id,$checked);
            }

            require('../tFPDF/tfpdf.php');
            $pdf = new tFPDF();
            $pdf->AddPage();
            $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
            
            $pdf->SetFont('DejaVu','',14);
            
            
            
            foreach($employee as $row){
                $pdf->Cell(10,10,'Ime: ');
                $pdf->Cell(20,10,$row['firstname']);
                $pdf->Ln();
                $pdf->Cell(20,10,'Prezime: ');
                $pdf->Cell(20,10,$row['lastname']);
                $pdf->Ln();
                $pdf->Cell(52,10,'Organizaciona jedinica: ');
                $pdf->Cell(20,10,$row['organization']);
                $pdf->Ln();
            }
            $w = $pdf->GetStringWidth($row['firstname'])+6;
            //$pdf->SetX((210-$w)/2);
            // Colors of frame, background and text
            $pdf->SetDrawColor(0,0,0);
            //$pdf->SetFillColor(230,230,0);
            //$pdf->SetTextColor(220,50,50);
            // Thickness of frame (1 mm)
            $pdf->SetLineWidth(0.3);
            // Title
            
            // Line break
            $pdf->Ln(30);
            $pdf->Cell(0,9,'REVERS RAZDUŽENJA',0,0,'C');
            $pdf->Ln(30);
            $pdf->Cell(50,10,'Tip opreme',0,0,'C');
            $pdf->Cell(50,10,'Proizvođač opreme',0,0,'C');
            $pdf->Cell(50,10,'Inventurni broj',0,0,'C');
            $pdf->Cell(50,10,'Serijski broj',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(0,0,'','B',0,'C',false);
            $pdf->Ln();
            foreach($obligationList as $row){
                $pdf->Cell(50,10,$row['equiptype'],0,0,'C');
                $pdf->Cell(50,10,$row['equipproducer'],0,0,'C');
                $pdf->Cell(50,10,$row['inventory'],0,0,'C');
                $pdf->Cell(50,10,$row['serialnumber'],0,0,'C');
                $pdf->Ln();
            }
            $pdf->Ln(60);
            $pdf->Cell(70,10,'Opremu preuzeo',0,0,'L');
            $pdf->Cell(110,10,'Opremu razdužio',0,0,'R');
            $pdf->Ln();
            $pdf->Cell(70,10,'_________________',0,0,'L');
            $pdf->Cell(110,10,'_________________',0,0,'R');
            $pdf->Output();
            $pdf->Output();
        }
        else {
            echo "<script>alert('Morate označiti opremu koju hoćete da razdužite i štampate revers razduženja.')</script>";
        }
        }
?>