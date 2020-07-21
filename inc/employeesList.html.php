<?php
    require '../Connection.class.php'; 
    require '../Database.class.php'; 
    require '../Employees.class.php';

    if(isset($_POST['pn'])){
        $perPage = $_POST['perPage'];
        $total = $_POST['total'];
        $pn = $_POST['pn'];
        $search = $_POST['search'];
        $em = new Employees();
        $limit = 'LIMIT ' .($pn - 1) * $perPage .',' .$perPage;
        $result = $em->selectWhereLimit('employees_list',"WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%'",$limit);
    }
?>
    <div class="table emptable">
    <table>
        <tr>
            <th>Redni broj</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Email</th>
            <th>Broj telefona</th>
            <th>Broj kancelarije</th>
            <th>Organizaciona jedinica</th>
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
                <td><?=$row["firstname"]?></td>
                <td><?=$row["lastname"]?></td>
                <td><?=$row["email"]?></td>
                <td><?=$row["phone"]?></td>
                <td><?=$row["office"]?></td>
                <td><?=$row["organization"]?></td>
                <td>
                    <button class="button" onclick="Change(<?=$row['employees_id']?>,'modChange','inc/employeeChange.html.php')">Izmjena podataka</button>
                    <button class="button blue" onclick="equipEmployee(<?=$row['employees_id']?>)">Zaduživanje/Razduživanje opreme</button>
                    <button class="button red" onclick="Del(<?=$row['employees_id']?>,'modDelete','message','index.php?page=employees','inc/employeeDelete.html.php')">Brisanje podataka</button>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>


