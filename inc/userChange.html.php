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
            <p class="section-title bottom">Izmjena podataka o korisniku</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
            <form action="" method="POST">
                <input type="text" name="firstname" value="<?=$users[0]['users_firstname']?>">
                <input type="text" name="lastname" value="<?=$users[0]['users_lastname']?>">
                <input type="text" name="username" value="<?=$users[0]['username']?>">
                <select name="role" id="role">
                    <?php 
                        if($users[0]['users_role'] == 1){
                            echo "<option value='1' selected>Administrator</option><option value='2'>Korisnik</option>";
                        }
                        elseif ($users[0]['users_role'] == 2){
                            echo "<option value='2' selected>Korisnik</option><option value='1'>Administrator</option>";
                        } 
                    ?>
                </select>
                <input type="submit" class="button blue" value="Sačuvaj" name="updateUser">
                <input type="hidden" name="users_id" value="<?=$users[0]['users_id']?>">
                <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('userChange')">
            </form>
            </div>
        </div>
    </div>
</div>