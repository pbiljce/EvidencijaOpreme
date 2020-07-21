<?php
    require '../Connection.class.php';
    require '../Database.class.php';
    require '../Equipment.class.php';
    require '../Producer.class.php';
    require '../Type.class.php';

    $prod = new Producer();
    $pro = $prod->selectAll('equipproducer');

    $typ = new Type();
    $ty = $typ->selectAll('equiptype');

    if(isset($_POST["id"])){
        $id = (int)$_POST["id"];
        $eq = new Equipment();
        $equ = $eq->selectById('equipment_list','equipment_id',$id);

        $selpro= "";
        $produceroption = "";
        foreach($pro as $pr){
            $producerid = $pr["equipproducer_id"];
            $producer = $pr["equipproducer"];
            if($equ[0]['equipproducer'] == $pr['equipproducer']){
                $selpro = "selected";
            }else{
                $selpro = "";
            }
            $produceroption .= "<option $selpro value=\"$producerid\">$producer</option>\n";
        }

        $seltype= "";
        $typeoption = "";
        foreach($ty as $t){
            $typeid = $t["equiptype_id"];
            $type = $t["equiptype"];
            if($equ[0]['equiptype'] == $t['equiptype']){
                $seltype = "selected";
            }else{
                $seltype = "";
            }
            $typeoption .= "<option $seltype value=\"$typeid\">$type</option>\n";
        }
    }
?>

<!-- Modal za izmjenu podataka o opremi-->
<div class="modal" id="modalequip" style="display:block">
    <div class="modal-content modsize">
        <div class="modal-header">
            <p class="section-title bottom">Izmjena podataka o opremi</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
                <form action="" method="POST">
                    <select required name="type_id" id="type_id">
                        <?php echo $typeoption; ?>
                    </select>
                    <select required name="producer_id" id="producer_id">
                    <?php echo $produceroption; ?>
                    </select>
                    <input type="text" name="inventoryNumber" placeholder="Inventurni broj" value="<?=$equ[0]['inventory']?>"> 
                    <input type="text" name="serialNumber" placeholder="Serijski broj" value="<?=$equ[0]['serialnumber']?>">
                    <input type="submit" class="button blue" value="Sačuvaj" name="equpdate">
                    <input type="hidden" name="equipid" value="<?=$equ[0]['equipment_id']?>">
                    <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('equipChange')">
                </form>
            </div>
        </div>
    </div>
</div>
