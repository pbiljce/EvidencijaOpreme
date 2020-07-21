<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Employees.class.php';
    require '../Equipment.class.php';

    //Instanciranje klase "Employees"
    $emp = new Employees();

    //Instanciranje klase "Equipment"
    $equi = new Equipment();
    
    //Pozivanje metode "selectAll" klase "Database" koja vraća listu opreme čiji je status "Slobodna" i smještanje rezultata u promjenljivu "$freeEquip"
    $freeEquip = $equi->selectAll('equipment_list','WHERE equipstatus_id=1');   

    //Ukoliko je postavljen ID korisnika, poziva se metoda "SelectById" klase "Database" koja vraća listu opreme koju je korisnik zadužio
    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $userEquip = $emp->selectById('equipemployee_list','employees_id',$id);  

        //Pozivanje metode "selectAll" klase "Database" koja vraća ime i prezime odabranog korisnika
        $employee = $emp->selectById('employees','employees_id',$id);
        foreach($employee as $em){
            $employeeFName = $em['firstname'];
            $employeeLName = $em['lastname'];
        }
        $employeeName = $employeeFName . " " . $employeeLName;
    }
?>

<!-- Modal za zaduživanje/razduživanje opreme-->
<div class="modal" id="modalequipment" style="display:block">
<span class="close" onclick="Cancel('modalequipment')">&times;</span>
    <div class="modal-content">
        <div class="modal-header">
            <p class="section-title bottom">Zaduživanje/Razduživanje opreme</p>
        </div>
        <div class="modal-body">
        <p>KORISNIK:<?=$employeeName?></p>
        <p class="section-title bottom">Lista slobodne opreme</p>
        <form action="#" method="POST">
            <input type="text" name="search" class="search" id="myInput" onkeyup="QuickSearch()" placeholder="Brza pretraga opreme po svim kolonama">
        </form>
        <div class="table equipemp">
                <table id="myTable">
                    <tr>
                        <th>Redni broj</th>
                        <th>Tip opreme</th>
                        <th>Proizvođač opreme</th>
                        <th>Inventurni broj</th>
                        <th>Serijski broj</th>
                        <th></th>
                    </tr>
                    <?php 
                    $j = 0;             
                    foreach($freeEquip as $equiprow){?>
                        <tr>
                            <td><?=++$j?></td>
                            <td><?=$equiprow["equiptype"]?></td>
                            <td><?=$equiprow["equipproducer"]?></td>
                            <td><?=$equiprow["inventory"]?></td>
                            <td><?=$equiprow["serialnumber"]?></td>
                            <td><input type="checkbox" name='checkEquip' value=<?=$equiprow['equipment_id']?> id=<?=$equiprow['equipment_id']?>></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <form class="buttons" action="#" method="post">
                    <input name="equipChecked" id="equipChecked" type="hidden">
                    <input name="empid" value=<?=$id?> id="empID" type="hidden">
                    <input type="submit" name="obligation" class="button blue" onclick="Obligate()" value="Zaduži zaposlenog odabranom opremom">
                </form>
            </div>
        </div>
        <br>
            <p class="section-title bottom">Lista opreme koju je zaposleni zadužio</p>
            <div class="table">
            <form action="pdf/Revers.php" target="_blank" method="POST">
                <table>
                    <tr>
                        <th>Redni broj</th>
                        <th>Tip opreme</th>
                        <th>Proizvođač opreme</th>
                        <th>Inventurni broj</th>
                        <th>Serijski broj</th>
                        <th></th>
                    </tr>
                    <?php 
                    $i = 0;        
                    foreach($userEquip as $equipemp){?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$equipemp["equiptype"]?></td>
                            <td><?=$equipemp["equipproducer"]?></td>
                            <td><?=$equipemp["inventory"]?></td>
                            <td><?=$equipemp["serialnumber"]?></td>
                            <td><input type="checkbox" name='checkEmpEquip' value=<?=$equipemp['equipment_id']?> id=<?=$equipemp['equipment_id']?>></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <div class="buttons">
                    <input type="submit" name="obligateEquipE" class="button red" onclick="ObligateEquipEmp()" value="Razduži opremu i štampaj revers">
                    <input name="empid" value=<?=$id?> id="empID" type="hidden">
                    <input name="equipEmpChecked" id="equipEmpChecked" type="hidden">
                    <input type="submit" name="obligateEquipEmp" class="button blue" onclick="ObligateEquipEmp()" value="Štampaj revers zaduženja">
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
