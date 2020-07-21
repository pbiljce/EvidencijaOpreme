<?php
    //Instanciranje klase "Equipment"
    $equip = new Equipment();
    //$equipm = $equip->selectAll('equipment_list');

    define("EQUROW_PER_PAGE",10);
    $search = "";
    if(isset($_POST["equipmentSearch"])){
        $search = $_POST["equSearch"];
    }
        
    //Pozivanje metode "selectAll" klase "Database" koja vraća listu opreme i smješta rezultata u promjenljivu "$equList"
    $equList = $equip->selectAll('equipment_list',"WHERE inventory LIKE '%$search%' OR serialnumber LIKE '%$search%'");

    $totalNumber = $equip->selectCount('equipment','equipment_id',"WHERE inventory LIKE '%$search%' OR serialnumber LIKE '%$search%'");//Ukupan broj opreme 
    $total = ceil($totalNumber[0]['Total']/EQUROW_PER_PAGE);//Ukupan broj strana

    //Ažuriranje podataka o opremi
    if(isset($_POST["equpdate"])){
        $equip->update("equipment",["equiptype_id" => $_POST['type_id'],"equipproducer_id" => $_POST['producer_id'],"inventory" => $_POST['inventoryNumber'],"serialnumber" => $_POST['serialNumber']],$_POST['equipid']);
        echo "<script>window.location.href='index.php?page=equipment';</script>";
    }
?>

<section class="section-two">
    <p class="section-title middle">Lista opreme</p>
        <form action="" method="POST">
            <div class="table-form">
                <input type="text" name="equSearch" class="search" placeholder="Pretraživanje opreme po inventurnom i serijskom broju">
                <input type="submit" class="button blue" name="equipmentSearch" value="Pretraži">
                <input type="button" class="button" onclick="window.location='index.php?page=equipment';" value="Poništi pretragu">
            </div>
        </form>
    <div id="results"></div>
    <div id="paginationControls" class="paginationControls"></div>
    <input id="perPage" type="hidden" value="<?=EQUROW_PER_PAGE?>">
    <input id="empTotal" type="hidden" value="<?=$total?>">
    <input id="search" type="hidden" value="<?=$search?>">
    <input type="hidden" value="inc/equipmentList.html.php" id="page">
    <script> RequestPage(1); </script>
</section>


<!-- Div za prikazivanje modala za izmjenu podataka o opremi -->
<div id="equipChange"></div>

<!-- Div za prikazivanje modala za brisanje podataka o opremi -->
<div id="equipDelete"></div>

<div id="message"></div>