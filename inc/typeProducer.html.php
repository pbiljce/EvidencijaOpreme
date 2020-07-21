<?php
    require 'Connection.class.php'; 
    require 'Database.class.php'; 
    require 'Type.class.php';
    require 'Producer.class.php';
    
    $ty = new Type();
    $type = $ty->selectAll('equiptype');

    $pro = new Producer();
    $producer = $pro->selectAll('equipproducer');
    
    if(isset($_POST['saveEquipType'])){
        $ty->insert("equiptype","equiptype","'" . $_POST["equiptype"]."'");
        echo "<script>window.location.href='index.php?page=typeProducer';</script>";
    }

    //Ažuriranje podataka o tipu opreme
    if(isset($_POST["updateType"])){
        $ty->update("equiptype",["equiptype" => $_POST['equiptype']],$_POST['equiptype_id']);
        echo "<script>window.location.href='index.php?page=typeProducer';</script>";
    }

    if(isset($_POST['saveEquipProducer'])){
        $pro->insert("equipproducer","equipproducer","'" . $_POST["equipproducer"]."'");
        echo "<script>window.location.href='index.php?page=typeProducer';</script>";
    }

    //Ažuriranje podataka o proizvođaču opreme
    if(isset($_POST["updateProducer"])){
        $pro->update("equipproducer",["equipproducer" => $_POST['equipproducer']],$_POST['equipproducer_id']);
        echo "<script>window.location.href='index.php?page=typeProducer';</script>";
    }

?>
<div>
<div class="tab">
    <input type="checkbox" id="equiptype" class="checkTab">
    <label class="tabLabel" for="equiptype">Pregled, izmjena, unos i brisanje tipa opreme</label>
    <div class="tabContent">
        <div class="section-one-left">
            <form action="" method="POST">
                <div class="form-header">Unos podataka o tipu opreme</div>
                <input type="text" name="equiptype" placeholder="Tip opreme" required oninvalid="this.setCustomValidity('Unos tipa opreme je obavezan')" onchange="this.setCustomValidity('')">
                <input type="submit" class="button blue" value="Sačuvaj" name="saveEquipType">
            </form>     
        </div>
        <div class="section-one-left">
            <div class="form-header">Unešeni podaci o tipu opreme</div>
            <div class="table equiptype">
                <table id="myTable">
                    <tr>
                        <th>Redni broj</th>
                        <th>Tip opreme</th>
                        <th></th>
                    </tr>
                    <?php 
                    $i = 0;
                    foreach($type as $row){ ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$row["equiptype"]?></td>
                            <td>
                                <button class="button" onclick="Change(<?=$row['equiptype_id']?>,'equipTypeChange','inc/typeChange.html.php')">Izmjena podatka o tipu opreme</button>
                                <button class="button red" onclick="Del(<?=$row['equiptype_id']?>,'equipTypeDelete','message','index.php?page=typeProducer','inc/typeDelete.html.php')">Brisanje podataka o tipu opreme</button>
                                
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="tab">
    <input type="checkbox" id="equipproducer" class="checkTab">
    <label class="tabLabel" for="equipproducer">Pregled, izmjena, unos i brisanje proizvođača opreme</label>
    <div class="tabContent">
        <div class="section-one-left">
            <form action="" method="POST">
                <div class="form-header">Unos podataka o proizvođaču opreme</div>
                <input type="text" name="equipproducer" placeholder="Proizvođač opreme" required oninvalid="this.setCustomValidity('Unos proizvođača opreme je obavezan')" onchange="this.setCustomValidity('')">
                <input type="submit" class="button blue" value="Sačuvaj" name="saveEquipProducer">
            </form>     
        </div>
        <div class="section-one-left">
            <div class="form-header">Unešeni podaci o proizvođaču opreme</div>
            <div class="table equipproducer">
                <table id="myTable">
                    <tr>
                        <th>Redni broj</th>
                        <th>Proizvođač opreme</th>
                        <th></th>
                    </tr>
                    <?php 
                    $i = 0;
                    foreach($producer as $row){ ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$row["equipproducer"]?></td>
                            <td>
                                <button class="button" onclick="Change(<?=$row['equipproducer_id']?>,'equipProducerChange','inc/producerChange.html.php')">Izmjena podatka o proizvođaču opreme</button>
                                <button class="button red" onclick="Del(<?=$row['equipproducer_id']?>,'equipProducerDelete','messageProducer','index.php?page=typeProducer','inc/producerDelete.html.php')">Brisanje podataka o proizvođaču opreme</button>
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Div za prikazivanje modala za izmjenu podataka o tipu opreme -->
<div id="equipTypeChange"></div>

<!-- Div za prikazivanje modala za brisanje podataka o tipu opremi -->
<div id="equipTypeDelete"></div>

<!-- Div za prikazivanje modala za izmjenu podataka o proizvođaču opreme -->
<div id="equipProducerChange"></div>

<!-- Div za prikazivanje modala za brisanje podataka o proizvođaču opremi -->
<div id="equipProducerDelete"></div>

<div id="message"></div>

<div id="messageProducer"></div>


