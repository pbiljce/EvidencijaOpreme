<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Equipment.class.php';

    //Instanciranje klase "Equipment"
    $equi = new Equipment();

    //Proslijeđivanje ID opreme, te brisanje podataka 
    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $equipment = $equi->selectAll('equipemployee');
        $i = 0;
        foreach($equipment as $eq){
            if($eq['equipment_id']==$id){
                $i++;
            }
        }
        if($i==0){
            $equi->del('equipment',$id);  
            echo "Podaci su obrisani.";
        }else {
            echo "Podaci nisu obrisani. Morate prvo razdužiti korisnika zaduženom opremom.";
        }
    }
?>
