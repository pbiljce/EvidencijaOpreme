<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Users.class.php';

    if(isset($_POST["id"])){
        $id = (int)$_POST["id"];
        $user = new Users();
        $users = $user->selectById('users','users_id',$id);
    }
?>

<!-- Modal za izmjenu podataka o korisniku-->
<div class="modal" id="modaltype" style="display:block">
    <div class="modal-content modsize">
        <div class="modal-header">
            <p class="section-title bottom">Izmjena korisničke lozinke</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
            <form action="" method="POST">
                <!-- <input type="text" name="password" value="<?=$users[0]['pass']?>"> -->
                <input type="password" name="password" value="<?=$users[0]['pass']?>">
                <input type="submit" class="button blue" value="Sačuvaj" name="updateUserPassword">
                <input type="hidden" name="users_id" value="<?=$users[0]['users_id']?>">
                <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('userChange')">
            </form>
            </div>
        </div>
    </div>
</div>