<?php
    require 'Connection.class.php'; 
    require 'Database.class.php'; 
    require 'Office.class.php';
    require 'Organization.class.php';
    
    $off = new Office();
    $office = $off->selectAll('office');

    $org = new Organization();
    $organization = $org->selectAll('organization');
    
    if(isset($_POST['saveOffice'])){
        $off->insert("office","office","'" . $_POST["office"]."'");
        echo "<script>window.location.href='index.php?page=officeOrganization';</script>";
    }

    //Ažuriranje podataka o tipu opreme
    if(isset($_POST["updateOffice"])){
        $off->update("office",["office" => $_POST['office']],$_POST['office_id']);
        echo "<script>window.location.href='index.php?page=officeOrganization';</script>";
    }

    if(isset($_POST['saveOrganization'])){
        $org->insert("organization","organization","'" . $_POST["organization"]."'");
        echo "<script>window.location.href='index.php?page=officeOrganization';</script>";
    }

    //Ažuriranje podataka o proizvođaču opreme
    if(isset($_POST["updateOrganization"])){
        $org->update("organization",["organization" => $_POST['organization']],$_POST['organization_id']);
        echo "<script>window.location.href='index.php?page=officeOrganization';</script>";
    }
?>
<div>
<div class="tab">
    <input type="checkbox" id="office" class="checkTab">
    <label class="tabLabel" for="office">Pregled, izmjena, unos i brisanje broja kancelarije</label>
    <div class="tabContent">
        <div class="section-one-left">
            <form action="" method="POST">
                <div class="form-header">Unos podataka o kancelariji</div>
                <input type="text" name="office" placeholder="Broj kancelarije" required oninvalid="this.setCustomValidity('Unos broja kancelarije je obavezan')" onchange="this.setCustomValidity('')">
                <input type="submit" class="button blue" value="Sačuvaj" name="saveOffice">
            </form>     
        </div>
        <div class="section-one-left">
            <div class="form-header">Unešeni podaci o kancelarijama</div>
            <div class="table office">
                <table id="myTable">
                    <tr>
                        <th>Redni broj</th>
                        <th>Broj kancelarije</th>
                        <th></th>
                    </tr>
                    <?php 
                    $i = 0;
                    foreach($office as $row){ ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$row["office"]?></td>
                            <td>
                                <button class="button" onclick="Change(<?=$row['office_id']?>,'officeChange','inc/officeChange.html.php')">Izmjena podatka o broju kancelarije</button>
                                <button class="button red" onclick="Del(<?=$row['office_id']?>,'officeDelete','message','index.php?page=officeOrganization','inc/officeDelete.html.php')">Brisanje podataka o broju kancelarije</button>
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="tab">
    <input type="checkbox" id="organization" class="checkTab">
    <label class="tabLabel" for="organization">Pregled, izmjena, unos i brisanje organizacione jedinice</label>
    <div class="tabContent">
        <div class="section-one-left">
            <form action="" method="POST">
                <div class="form-header">Unos podataka o organizacionoj jedinici</div>
                <input type="text" name="organization" placeholder="Organizaciona jedinica" required oninvalid="this.setCustomValidity('Unos organizacione jedinice je obavezan')" onchange="this.setCustomValidity('')">
                <input type="submit" class="button blue" value="Sačuvaj" name="saveOrganization">
            </form>     
        </div>
        <div class="section-one-left">
            <div class="form-header">Unešeni podaci o organizacionim jedinicama</div>
            <div class="table organization">
                <table id="myTable">
                    <tr>
                        <th>Redni broj</th>
                        <th>Organizaciona jedinica</th>
                        <th></th>
                    </tr>
                    <?php 
                    $i = 0;
                    foreach($organization as $row){ ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$row["organization"]?></td>
                            <td>
                                <button class="button" onclick="Change(<?=$row['organization_id']?>,'organizationChange','inc/organizationChange.html.php')">Izmjena podatka o organizacionoj jedinici</button>
                                <button class="button red" onclick="Del(<?=$row['organization_id']?>,'organizationDelete','messageOrganization','index.php?page=officeOrganization','inc/organizationDelete.html.php')">Brisanje podataka o organizacionoj jedinici</button>
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Div za prikazivanje modala za izmjenu podataka o broju kancelarije -->
<div id="officeChange"></div>

<!-- Div za prikazivanje modala za brisanje podataka o broju kancelarije -->
<div id="officeDelete"></div>

<!-- Div za prikazivanje modala za izmjenu podataka o organizacionoj jedinici -->
<div id="organizationChange"></div>

<!-- Div za prikazivanje modala za brisanje podataka o organizacionoj jedinici -->
<div id="organizationDelete"></div>

<div id="message"></div>

<div id="messageOrganization"></div>


