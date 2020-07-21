<header class="main-header">
    <!-- TOP-HEADER START-->
    <div class="top-header">
        <img src="images/logo.svg" alt="Logo - Elektronska evidencija računarske opreme">
        <a href="index.php">Evidencija računarske opreme</a>
    </div>
    <!-- TOP-HEADER END-->
    <!-- MAIN-NAVIGATION START-->
    <nav class="main-navigation">
        <ul>
            <?php
                echo "<li><a href='index.php?page=employees'>Zaposleni - Zaduživanje/Razduživanje</a></li>";
                echo "<li><a href='index.php?page=equipment'>Oprema</a></li>";
                echo "<li><a href='index.php?page=reports'>Izvještaji</a></li>";
                if($_SESSION['users_role']==1){
                    echo "<li><a href='index.php?page=typeProducer'>Tip/Proizvođač opreme</a></li>";
                    echo "<li><a href='index.php?page=officeOrganization'>Kancelarija/Organizaciona jedinica</a></li>";
                    echo "<li><a href='index.php?page=users'>Administracija korisnika</a></li>";
                }
            ?>
        </ul>
        <ul class="logout">
            <?php
                $username =  $_SESSION['username'];
                echo "<li><a href='logout.php'>Odjava " . $username . "</a></li>";
            ?>
        </ul>
    </nav>
    <!-- MAIN-NAVIGATION END-->
</header>
