<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Organization.class.php';
    require '../Employees.class.php';

    $organization = new Organization();

    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $emp = new Employees();
        $employees = $emp->selectAll('employees');
        $i = 0;
        foreach($employees as $em){
            if($em['organization_id']==$id){
                $i++;
            }
        }
        if($i==0){
            $organization->del('organization',$id);  
            echo "Podaci su obrisani.";
        }else {
            echo "Podaci nisu obrisani, jer postoji unešen zaposleni koji ima ovu organizacionu jedinicu.";
        }
    }
?>
