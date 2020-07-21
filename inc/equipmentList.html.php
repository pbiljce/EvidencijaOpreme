<?php
require '../Connection.class.php'; 
require '../Database.class.php'; 
require '../Equipment.class.php';

if(isset($_POST['pn'])){
    $perPage = $_POST['perPage'];
    $total = $_POST['total'];
    $pn = $_POST['pn'];
    $search = $_POST['search'];
    $eq = new Equipment();
    $limit = 'LIMIT ' .($pn - 1) * $perPage .',' .$perPage;
    $result = $eq->selectWhereLimit('equipment_list',"WHERE inventory LIKE '%$search%' OR serialnumber LIKE '%$search%'",$limit);
}

?>

<div class="table equtable">
    <table>
        <tr>
            <th>Redni broj</th>
            <th>Tip opreme</th>
            <th>Proizvođač opreme</th>
            <th>Inventurni broj</th>
            <th>Serijski broj</th>
            <th>Status opreme</th>
            <th>Ime osobe</th>
            <th>Prezime osobe</th>
            <th>Datum zaduženja</th>
            <th></th>
        </tr>
        <?php 
            if($pn == 1){
                $i = 0;
            }else {
                $i = ($pn-1) * $perPage;
            }
            foreach($result as $row){ ?>
            <tr>
                <td><?=++$i?></td>
                <td><?=$row["equiptype"]?></td>
                <td><?=$row["equipproducer"]?></td>
                <td><?=$row["inventory"]?></td>
                <td><?=$row["serialnumber"]?></td>
                <td><?=$row["equipstatus"]?></td>
                <td><?=$row["firstname"]?></td>
                <td><?=$row["lastname"]?></td>
                <td><?=$row["datecreated"]?></td>
                <td>
                    <button class="button" onclick="Change(<?=$row['equipment_id']?>,'equipChange','inc/equipmentChange.html.php')">Izmjena podataka o opremi</button>
                    <button class="button red" onclick="Del(<?=$row['equipment_id']?>,'equipDelete','message','index.php?page=equipment','inc/equipmentDelete.html.php')">Brisanje podataka</button>
                </td>
            </tr>
        <?php }?>
    </table>
</div>



