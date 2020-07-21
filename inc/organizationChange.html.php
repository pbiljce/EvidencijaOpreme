<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Organization.class.php';

    if(isset($_POST["id"])){
        $id = (int)$_POST["id"];
        $org = new Organization();
        $organization = $org->selectById('organization','organization_id',$id);
    }
?>

<!-- Modal za izmjenu podataka o proizvođaču opreme-->
<div class="modal" id="modalorganization" style="display:block">
    <div class="modal-content modsize">
        <div class="modal-header">
            <p class="section-title bottom">Izmjena podataka o organizacionoj jedinici</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
            <form action="" method="POST">
                <input type="text" name="organization" value="<?=$organization[0]['organization']?>">
                <input type="submit" class="button blue" value="Sačuvaj" name="updateOrganization">
                <input type="hidden" name="organization_id" value="<?=$organization[0]['organization_id']?>">
                <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('organizationChange')">
            </form>
            </div>
        </div>
    </div>
</div>