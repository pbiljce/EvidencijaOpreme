<?php
    session_start();
    require 'Connection.class.php'; 
    require 'Database.class.php';
    require 'Users.class.php';

    $message = "";
    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $us = new Users();
        $users = $us->selectAll("users");
        
        if(!empty($users)){
            foreach($users as $u){
                if(password_verify($password, $u['pass']) && $u['username']==$username){
                    $_SESSION['username'] = $username;
                    $_SESSION['users_role'] = $u['users_role'];
                    echo "<script>window.location.href='index.php';</script>";
                }else {
                    $message = "Neispravno korisničko ime ili lozinka.";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet"> 
    <title>Login</title>
</head>
<body>
    <div class="loginContainer">
        <form action="" method="POST">
            <div class="login-form">
                <div class="login-header">
                    <h1>Elektronska evidencija računarske opreme</h1>
                    <p class="line"></p>
                </div>
                <div class="login-input">
                    <input type="text" name="username" placeholder="Korisničko ime" required oninvalid="this.setCustomValidity('Unos korisničkog imena je obavezan')" onchange="this.setCustomValidity('')">
                    <img src="images/user.png" alt="Korisnik">
                    <input type="password" name="password" placeholder="Korisnička lozinka" required oninvalid="this.setCustomValidity('Unos korisničke lozinke je obavezan')" onchange="this.setCustomValidity('')">
                    <img src="images/lock.png" alt="Lozinka">
                    <input type="submit" class="loginbutton" name="login" value="Prijava">
                </div>
                <div class="loginMessage"><?=$message?></div>
            </div>
        </form>
    </div>
</body>
</html>