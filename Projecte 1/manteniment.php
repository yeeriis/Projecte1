<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_SESSION["user"])){
        if(!empty($_POST['usuari']) && !empty($_POST['contrasenya'])){
            $Nomusuari = $_POST['usuari'];
            $PasUsuari = $_POST['contrasenya'];
            $passwdmd5 = md5($PasUsuari);
                if($Nomusuari == "admin" && $PasUsuari == "admin"){
                    $_SESSION['user'] =  $Nomusuari;
                    ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:manteniment.php"/>
                    <?php
                }else{
                    print("Has d'esta validat per veure aquesta pàgina");
                ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:index.php"/>
                <?php
                }
            }else{
                ?>
                <header>
                    <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
                    <nav class="nav">
                        <a href="alta.php" class="menu">Registra't</a>
                        <a href="login.php" class="menu">Inicia Sessió</a>
                        <a href="admin.php" class="menu">Manteniment</a>
                        <a href="quisom.html" class="menu">Qui som?</a>
                    </nav>
                </header>
                <br>
                <br>
                <nav class="gestio">
                        <a href="alta_profes.php" class="gestion">Alta professors</a>
                        <a href="gestio_profes.php" class="gestion">Gestió de professors</a>
                        <a href="alta_cursos.php" class="gestion">Creació de cursos</a>
                        <a href="gestio_cursos.php" class="gestion">Gestió de cursos</a>
                        <a href="gestio_alumnes.php" class="gestion">Gestió d'alumnes</a>
                </nav>
                <footer></footer>
        <?php
        }
    }else{
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "Redirigint..";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=admin.php'>";
    }   
    ?>
</body>
</html>