<?php
    //Instanciranje klase "Employees"
    $emp = new Employees();

    define("EMPROW_PER_PAGE",10);
    $search = "";
    if(isset($_POST["employeesSearch"])){
        $search = $_POST["search"];
    }
        
    //Pozivanje metode "selectAll" klase "Database" koja vraća listu svih zaposlenih i smještanje rezultata u promjenljivu "$empList"
    $empList = $emp->selectAll('employees_list',"WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%'");

    $totalNumber = $emp->selectCount('employees','employees_id',"WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%'");//Ukupan broj zaposlenih 
    $total = ceil($totalNumber[0]['Total']/EMPROW_PER_PAGE);//Ukupan broj strana

    //Ažuriranje podataka o zaposlenom 
    if(isset($_POST["update"])){
        $emp->update("employees",["firstname" => $_POST['firstname'],"lastname" => $_POST['lastname'],"email" => $_POST['email'],"phone" => $_POST['phone'],"organization_id" => $_POST['organization_id'],"office_id" => $_POST['office_id']],$_POST['empid']);
        echo "<script>window.location.href='index.php?page=employees';</script>";
    }

    //Ukoliko je kliknuto na dugme "Zaduži korisnika odabranom opremom" u modalu, korisnik/zaposleni se zadužuje odabranom opremom
    if(isset($_POST['obligation'])){
        if(!empty($_POST['equipChecked'])){
            $id = $_POST["empid"];
            $equipChecked = $_POST['equipChecked'];
            $equipCheck = explode(',',$equipChecked);
            foreach($equipCheck as $checked){
                $emp->obligate('equipemployee_obligation',$id,$checked);
            }
        }
        else {
            echo "<script>alert('Morate označiti opremu koju hoćete da zadužite korisniku.')</script>";
        }
    }
?>

<section class="section-two">
    <p class="section-title middle">Lista zaposlenih</p>
        <form action="" method="POST">
            <div class="table-form">
                <input type="text" name="search" class="search" placeholder="Pretraživanje zaposlenih po imenu i prezimenu">
                <input type="submit" class="button blue" name="employeesSearch" value="Pretraži">
                <input type="button" class="button" onclick="window.location='index.php?page=employees';" value="Poništi pretragu">
            </div>
        </form>
    <div id="results"></div>
    <div id="paginationControls" class="paginationControls"></div>
    <input id="perPage" type="hidden" value="<?=EMPROW_PER_PAGE?>">
    <input id="empTotal" type="hidden" value="<?=$total?>">
    <input id="search" type="hidden" value="<?=$search?>">
    <input type="hidden" value="inc/employeesList.html.php" id="page">
    <script> RequestPage(1); </script>
</section>


<!-- Div za prikazivanje modala za zaduživanje/razduživanje opreme -->
<div id="mod"></div>

<!-- Div za prikazivanje modala za brisanje podataka o zaposlenom -->
<div id="modDelete"></div>

<!-- Div za prikazivanje modala za izmjenu podataka o zaposlenom -->
<div id="modChange"></div>

<div id="message"></div>




