<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Employees.class.php';
    require '../Equipment.class.php';

    //Instanciranje klase "Employees"
    $emp = new Employees();

    //Proslijeđivanje ID korisnika, te brisanje njegovih podataka

    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $employees = $emp->selectAll('equipemployee');
        $i = 0;
        foreach($employees as $em){
            if($em['employees_id']==$id){
                $i++;
            }
        }
        if($i==0){
            $emp->del('employees',$id); 
            echo "Podaci su obrisani.";
        }else {
            echo "Podaci nisu obrisani. Morate prvo razdužiti korisnika zaduženom opremom.";
        }
    }
?>
