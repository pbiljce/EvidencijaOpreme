<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Office.class.php';
    require '../Employees.class.php';

    $office = new Office();

    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $emp = new Employees();
        $employees = $emp->selectAll('employees');
        $i = 0;
        foreach($employees as $em){
            if($em['office_id']==$id){
                $i++;
            }
        }
        if($i==0){
            $office->del('office',$id);  
            echo "Podaci su obrisani.";
        }else {
            echo "Podaci nisu obrisani, jer postoji unešen zaposleni koji ima ovaj broj kancelarije.";
        }
    }
?>
