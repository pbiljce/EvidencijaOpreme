<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Office.class.php';

    if(isset($_POST["id"])){
        $id = (int)$_POST["id"];
        $of = new Office();
        $office = $of->selectById('office','office_id',$id);
    }
?>

<!-- Modal za izmjenu podataka o proizvođaču opreme-->
<div class="modal" id="modaloffice" style="display:block">
    <div class="modal-content modsize">
        <div class="modal-header">
            <p class="section-title bottom">Izmjena podataka o broju kancelarije</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
            <form action="" method="POST">
                <input type="text" name="office" value="<?=$office[0]['office']?>">
                <input type="submit" class="button blue" value="Sačuvaj" name="updateOffice">
                <input type="hidden" name="office_id" value="<?=$office[0]['office_id']?>">
                <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('officeChange')">
            </form>
            </div>
        </div>
    </div>
</div>