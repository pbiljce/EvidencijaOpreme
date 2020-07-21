<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Producer.class.php';
    require '../Equipment.class.php';

    $prod = new Producer();

    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $equi = new Equipment();
        $equipment = $equi->selectAll('equipment');
        $i = 0;
        foreach($equipment as $eq){
            if($eq['equipproducer_id']==$id){
                $i++;
            }
        }
        if($i==0){
            $prod->del('equipproducer',$id);  
            echo "Podaci su obrisani.";
        }else {
            echo "Podaci nisu obrisani, jer postoji unešena oprema koja ima ovog proizvođača opreme.";
        }
    }
?>
