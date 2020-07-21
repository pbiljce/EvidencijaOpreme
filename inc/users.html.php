<?php
    require 'Connection.class.php'; 
    require 'Database.class.php'; 
    require 'Users.class.php';
    
    $us = new Users();
    $users = $us->selectAll('users');

    if(isset($_POST['saveUser'])){
        $hashed_password = password_hash($_POST["pass"], PASSWORD_DEFAULT);
        $us->insert("users","users_firstname,users_lastname,username,pass,users_role","'" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $_POST["username"] . "','" . $hashed_password . "','" . $_POST["role"] ."'");
        echo "<script>window.location.href='index.php?page=users';</script>";
    }

    //Ažuriranje podataka o korisniku
    if(isset($_POST["updateUser"])){
        $us->update("users",["users_firstname" => $_POST['firstname'],"users_lastname" => $_POST['lastname'],"username" => $_POST['username'],"users_role" => $_POST["role"]],$_POST['users_id']);
        echo "<script>window.location.href='index.php?page=users';</script>";
    }

    if(isset($_POST["updateUserPassword"])){
        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $us->update("users",["pass" => $hashed_password],$_POST['users_id']);
    }
?>

<div class="section-one-left">
    <form action="" method="POST">
        <div class="form-header">Unos podataka o novom korisniku</div>
        <input type="text" name="firstname" placeholder="Ime korisnika" required oninvalid="this.setCustomValidity('Unos imena korisnika je obavezan')" onchange="this.setCustomValidity('')">
        <input type="text" name="lastname" placeholder="Prezime korisnika" required oninvalid="this.setCustomValidity('Unos prezimena korisnika je obavezan')" onchange="this.setCustomValidity('')">
        <input type="text" name="username" placeholder="Korisničko ime" required oninvalid="this.setCustomValidity('Unos korisničkog imena je obavezan')" onchange="this.setCustomValidity('')">
        <input type="password" name="pass" placeholder="Korisnička lozinka" required oninvalid="this.setCustomValidity('Unos korisničke lozinke je obavezan')" onchange="this.setCustomValidity('')">
        <select required name="role" id="role" oninvalid="this.setCustomValidity('Odabir korisničke grupe je obavezan')" onchange="this.setCustomValidity('')">
            <option value="" disabled selected>Odaberite grupu kojoj korisnik pripada</option>
            <option value="1">Administrator</option>
            <option value="2">Korisnik</option>
        </select>
        <input type="submit" class="button blue" value="Sačuvaj" name="saveUser">
    </form>     
</div>
<div class="section-two">
    <p class="section-title middle">Lista korisnika</p>
    <div class="table users">
        <table>
            <tr>
                <th>Redni broj</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Korisničko ime</th>
                <th>Grupa kojoj korisnik pripada</th>
                <th></th>
            </tr>
            <?php 
            $i = 0;
            foreach($users as $row){ ?>
                <tr>
                    <td><?=++$i?></td>
                    <td><?=$row["users_firstname"]?></td>
                    <td><?=$row["users_lastname"]?></td>
                    <td><?=$row["username"]?></td>
                    <td><?php echo ($row["users_role"] == 1) ? 'Administrator':'Korisnik'; ?></td>
                    <td>
                        <button class="button" onclick="Change(<?=$row['users_id']?>,'userChange','inc/userChange.html.php')">Izmjena podatka o korisniku</button>
                        <button class="button blue" onclick="Change(<?=$row['users_id']?>,'userChangePassword','inc/userChangePassword.html.php')">Promjena lozinke</button>
                        <button class="button red" onclick="Del(<?=$row['users_id']?>,'userDelete','message','index.php?page=users','inc/userDelete.html.php')">Brisanje podataka o korisniku</button>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>

<div id="userChange"></div>

<div id="userChangePassword"></div>

<div id="userDelete"></div>

<div id="message"></div>