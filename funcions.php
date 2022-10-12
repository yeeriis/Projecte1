<?php
    function menuProfe(){
        ?>
        <header>
    <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
            <a href="alta.php" class="menu">Registra't</a>
            <a href="login.php" class="menu">Inicia Sessió</a>
            <a href="admin.php" class="menu">Manteniment</a>
            <a href="quisom.html" class="menu">Qui som?</a>
        </nav>
        <p  id="nomprof">Benvingut/da, <?php echo $_SESSION['nom']; ?></p>

    </header>
    <br>
    <?php
    }

?>