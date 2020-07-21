<?php
    require 'Connection.class.php'; 
    require 'Database.class.php'; 
    require 'Organization.class.php';
    require 'Employees.class.php';
    require 'Office.class.php';

    $org = new Organization();
    $organization = $org->selectAll('organization');

    $pie = $org->pie('employee_organization');
    $emporg = "";
    for($i=0;$i<count($pie);$i++){
        $emporg .= "['" . $pie[$i]['organization'] . "'," . $pie[$i]['employees_number'] . "],";
    } 
    $emporg = substr($emporg, 0, -1);

    $off = new Office();
    $office = $off->selectAll('office');
    
    if(isset($_POST['save'])){
        $employee = new Employees();
        $employee->insert("employees","firstname,lastname,email,phone,organization_id,office_id","'" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $_POST["email"] . "','" . $_POST["phone"] . "','" . $_POST["organization_id"] . "','" . $_POST["office_id"]."'");
        echo "<script>window.location.href='index.php?page=employees';</script>";
    }
?>
<section class="section-one">
    <div class="section-one-left">
        <form action="" method="POST">
            <div class="form-header">Unos podataka o zaposlenom</div>
            <input type="text" name="firstname" placeholder="Ime" required oninvalid="this.setCustomValidity('Unos imena je obavezan')" onchange="this.setCustomValidity('')">
            <input type="text" name="lastname" placeholder="Prezime" required oninvalid="this.setCustomValidity('Unos prezimena je obavezan')" onchange="this.setCustomValidity('')">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Broj telefona">
            <select required name="office_id" id="office_id" oninvalid="this.setCustomValidity('Odabir broja kancelarije je obavezan')" onchange="this.setCustomValidity('')">
                <option value="" disabled selected>Izaberite kancelariju</option>
                <?php foreach ($office as $row): ?>
                    <option value="<?=$row["office_id"]?>"><?=$row["office"]?></option>
                <?php endforeach ?>
            </select>
            <select required name="organization_id" id="organization_id" oninvalid="this.setCustomValidity('Odabir organizacione jedinice je obavezan')" onchange="this.setCustomValidity('')">
                <option value="" disabled selected>Izaberite organizacionu jedinicu</option>
                <?php foreach ($organization as $row): ?>
                    <option value="<?=$row["organization_id"]?>"><?=$row["organization"]?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" class="button blue" value="Sačuvaj" name="save">
        </form>
    </div>
    <div class="section-one-right">
    <div id="piechart"></div>

    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Organizacija');
        data.addColumn('number', 'Broj zaposlenih');
        data.addRows([
        <?=$emporg;?>
    ]);
    var options = {'title':'Grafički prikaz zaposlenih po organizacionim jedinicama','width':500, 'height':300,is3D:true,titleTextStyle:{fontSize:16}};
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
    </script>
</section>
