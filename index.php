<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo "<script>window.location.href='login.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <script src="js/script.js"></script> 
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/Chart.min.js"></script>
    <link href="css/Chart.min.css" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet"> 
    <title>Elektronska evidencija računarske opreme</title>
</head>
<body>
    <div id="wrapper">
        <!-- HEADER START-->
        <?php require 'inc/header.html.php'; ?>
        <!-- HEADER END-->

        <!-- MAIN START-->
        <?php
            if(isset($_GET['page']) && !empty($_GET['page']) && file_exists("inc/" . $_GET['page'] . ".html.php")){
                require 'inc/' . $_GET['page'] . '.html.php';
            }
            else {
                require 'inc/employees.html.php';
            }
        ?>     
        <!-- MAIN END-->

        <!-- FOOTER START-->
        <?php require 'inc/footer.html.php'; ?>
        <!-- FOOTER END-->
    </div>

</body>
</html>