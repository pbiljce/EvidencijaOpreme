<?php
    require '../Connection.class.php'; 
    require '../Database.class.php';
    require '../Employees.class.php';
    require '../Organization.class.php';
    require '../Office.class.php';

    $org = new Organization();
    $organization = $org->selectAll('organization');

    $off = new Office();
    $office = $off->selectAll('office');

    if (isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $empl = new Employees();
        $employee = $empl->selectById('employees_list','employees_id',$id);  
        
        $selected = "";
        $officeoption = "";
        foreach($office as $o){
            $officeid = $o["office_id"];
            $office = $o["office"];
            if($employee[0]['office'] == $o['office']){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $officeoption .= "<option $selected value=\"$officeid\">$office</option>\n";
        }

        $orgselected = "";
        $organizationoption = "";
        foreach($organization as $org){
            $organizationid = $org["organization_id"];
            $organizationname = $org["organization"];
            if($employee[0]['organization'] == $org['organization']){
                $orgselected = "selected";
            }else{
                $orgselected = "";
            }
            $organizationoption .= "<option $orgselected value=\"$organizationid\">$organizationname</option>\n";
        }
    }
?>

<!-- Modal za izmjenu podataka o zaposlenom-->
<div class="modal" id="modalemployee" style="display:block">
    <div class="modal-content modsize">
        <div class="modal-header">
            <p class="section-title bottom">Izmjena podataka o zaposlenom</p>
        </div>
        <div class="modal-body">
            <div class="section-one-left">
            <form action="" method="POST">
                <input type="text" name="firstname" value="<?=$employee[0]['firstname']?>">
                <input type="text" name="lastname" value="<?=$employee[0]['lastname']?>">
                <input type="text" name="email" value="<?=$employee[0]['email']?>">
                <input type="text" name="phone" value="<?=$employee[0]['phone']?>">
                <select name="office_id" id="office_id">
                    <?php echo $officeoption; ?>
                </select>
                <select name="organization_id" id="organization_id">
                    <?php echo $organizationoption; ?>
                </select>
                <input type="submit" class="button blue" value="Sačuvaj" name="update">
                <input type="hidden" name="empid" value="<?=$employee[0]['employees_id']?>">
                <input type="submit" class="button" value="Odustani" name="cancel" onclick="Cancel('modChange')">
            </form>
            </div>
        </div>
    </div>
</div>