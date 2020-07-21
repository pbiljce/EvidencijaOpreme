<?php
    require 'Connection.class.php'; 
    require 'Database.class.php'; 
    require 'Organization.class.php';
    require 'Employees.class.php';
    require 'Office.class.php';
    
    $org = new Organization();
    $organization = $org->selectAll('organization');

    $off = new Office();
    $office = $off->selectAll('office');

    $emp = new Employees();
    $employees = $emp->selectAll('employees');
?>
<div>
    <div class="section-one-left">
        <form action="pdf/EquipmentOrganization.php" target="_blank" method="POST">
            <p class="section-title light">Izvještaji o zaduženoj opremi po organizacionim jedinicama</p>
            <select name="org_id" id="org_id">
                <option value="" disabled selected>Odaberite organizacionu jedinicu</option>
                <?php foreach ($organization as $row): ?>
                    <option value="<?=$row["organization_id"]?>"><?=$row["organization"]?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" class="button blue" name="orgReport" value="Izvještaj po organizacionim jedinicama">
        </form>        
    </div>
    <div class="section-one-left">
        <form action="pdf/EquipmentOffice.php" target="_blank" method="POST">
            <p class="section-title light">Izvještaji o zaduženoj opremi po kancelarijama</p>
            <select name="office_id" id="office_id">
                <option value="" disabled selected>Odaberite kancelariju</option>
                <?php foreach ($office as $row): ?>
                    <option value="<?=$row["office_id"]?>"><?=$row["office"]?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" class="button blue" name="officeReport" value="Izvještaj po kancelarijama">
        </form>
    </div>
    <div class="section-one-left">
        <form action="pdf/EquipmentEmployee.php" target="_blank" method="POST">
            <p class="section-title light">Izvještaji o zaduženoj opremi po zaposlenim</p>
            <select name="employees_id" id="employees_id">
                <option value="" disabled selected>Odaberite zaposlenog</option>
                <?php foreach ($employees as $row): ?>
                    <option value="<?=$row["employees_id"]?>"><?=$row["firstname"] . " " . $row["lastname"]?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" class="button blue" name="empReport" value="Izvještaj po zaposlenim">
    </form>
    </div>
    <div class="free">
        <p class="section-title light">Izvještaj o slobodnoj opremi</p>
        <a href="pdf/EquipmentFree.php" target="_blank" class="button blue">Izvještaj o slobodnoj opremi</a>
    </div>
</div>