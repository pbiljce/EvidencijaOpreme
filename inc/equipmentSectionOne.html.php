<?php
    require 'Connection.class.php'; 
    require 'Database.class.php'; 
    require 'Type.class.php';
    require 'Producer.class.php';
    require 'Equipment.class.php';

    $type = new Type();
    $equiptype = $type->selectAll('equiptype');

    $producer = new Producer();
    $equipproducer = $producer->selectAll('equipproducer');

    $pie = $type->pie('equipment_type');
    $equtype = "";
    for($i=0;$i<count($pie);$i++){
        $equtype .= "['" . $pie[$i]['equiptype'] . "'," . $pie[$i]['equipment_number'] . "],";
    } 
    $equtype = substr($equtype, 0, -1);

    if(isset($_POST['save'])){
        $equipment = new Equipment();
        $equipment->insert("equipment","equiptype_id,equipproducer_id,inventory,serialnumber","'" . $_POST["type_id"] . "','" . $_POST["producer_id"] . "','" . $_POST["inventoryNumber"] . "','" . $_POST["serialNumber"] ."'");
        echo "<script>window.location.href='index.php?page=equipment';</script>";
    }
?>
<section class="section-one">
    <div class="section-one-left">
        <form action="#" method="POST">
            <div class="form-header">Unos podataka o opremi</div>
            <select required name="type_id" id="type_id" oninvalid="this.setCustomValidity('Odabir tipa opreme je obavezan')" onchange="this.setCustomValidity('')">
                <option value="" selected disabled>Odaberite tip opreme</option>
                <?php foreach ($equiptype as $row): ?>
                <option value="<?=$row["equiptype_id"]?>"><?=$row["equiptype"]?></option>
                <?php endforeach ?>
            </select>
            <select required name="producer_id" id="producer_id" oninvalid="this.setCustomValidity('Odabir proizvođača opreme je obavezan')" onchange="this.setCustomValidity('')">
                <option value="" selected disabled>Odaberite proizvođača opreme</option>
                <?php foreach ($equipproducer as $row): ?>
                <option value="<?=$row["equipproducer_id"]?>"><?=$row["equipproducer"]?></option>
                <?php endforeach ?>
            </select>
            <input type="text" name="inventoryNumber" placeholder="Inventurni broj" required oninvalid="this.setCustomValidity('Unos inventurnog broja je obavezan')" onchange="this.setCustomValidity('')">
            <input type="text" name="serialNumber" placeholder="Serijski broj">
            <input type="submit" class="button blue" value="Sačuvaj" name="save">
        </form>
    </div>
    <div class="section-one-right">
        <div id="piechart"></div>
    </div>

    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tip');
        data.addColumn('number', 'Oprema');
        data.addRows([
        <?=$equtype;?>
    ]);
    var options = {'title':'Grafički prikaz opreme po tipovima','width':500, 'height':300,is3D:true,titleTextStyle:{fontSize:16}};
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
    </script>
</section>