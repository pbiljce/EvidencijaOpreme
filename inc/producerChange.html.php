<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Producer.class.php';

    if(isset($_POST["id"])){
        $id = (int)$_POST["id"];
        $pro = new Producer();
        $producer = $pro->selectById('equipproducer','equipproducer_id',$id);
    }
?>

<!-- Modal za izmjenu podataka o proizvođaču opreme-->
<div class="modal" id="modalproducer" style="display:block">
    <div class="modal-content modsize">
        <div class="modal-header">
            <p class="section-title bottom">Izmjena podataka o proizvođaču opreme</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
            <form action="" method="POST">
                <input type="text" name="equipproducer" value="<?=$producer[0]['equipproducer']?>">
                <input type="submit" class="button blue" value="Sačuvaj" name="updateProducer">
                <input type="hidden" name="equipproducer_id" value="<?=$producer[0]['equipproducer_id']?>">
                <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('equipProducerChange')">
            </form>
            </div>
        </div>
    </div>
</div>