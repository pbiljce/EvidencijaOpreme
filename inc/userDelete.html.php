<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Users.class.php';

    $u = new Users();

    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $u->del('users',$id);  
        echo "Podaci su obrisani.";
    }
?>
