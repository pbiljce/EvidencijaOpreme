<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Type.class.php';

    if(isset($_POST["id"])){
        $id = (int)$_POST["id"];
        $typ = new Type();
        $type = $typ->selectById('equiptype','equiptype_id',$id);
    }
?>

<!-- Modal za izmjenu podataka o tipu opreme-->
<div class="modal" id="modaltype" style="display:block">
    <div class="modal-content modsize">
        <div class="modal-header">
            <p class="section-title bottom">Izmjena podataka o tipu opreme</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
            <form action="" method="POST">
                <input type="text" name="equiptype" value="<?=$type[0]['equiptype']?>">
                <input type="submit" class="button blue" value="Sačuvaj" name="updateType">
                <input type="hidden" name="equiptype_id" value="<?=$type[0]['equiptype_id']?>">
                <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('equipTypeChange')">
            </form>
            </div>
        </div>
    </div>
</div>