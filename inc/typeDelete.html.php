<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Type.class.php';
    require '../Equipment.class.php';

    $typ = new Type();

    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $equi = new Equipment();
        $equipment = $equi->selectAll('equipment');
        $i = 0;
        foreach($equipment as $eq){
            if($eq['equiptype_id']==$id){
                $i++;
            }
        }
        if($i==0){
            $typ->del('equiptype',$id);  
            echo "Podaci su obrisani.";
        }else {
            echo "Podaci nisu obrisani, jer postoji unešena oprema koja ima ovaj tip.";
        }
    }
?>
