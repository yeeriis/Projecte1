<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/login.css" rel="stylesheet" type="text/css">
    <title>Alta de Professors</title>
</head>
<body>
    <?php
    include "funcions.php";
    if (isset($_SESSION["user"])){
       $conexio = mysqli_connect("localhost","root","","infobdn");
       
        if ($_POST){
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                altaProfe();
            }    
        }else{}
    }else{
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "Redirigint..";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=admin.php'>";
    }
    ?>
    <header>
        <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
        </nav>
    </header>
    <br>
    <form action="alta_profes.php" method="POST" class="formulari" enctype='multipart/form-data'>
        <h3>Alta de Professors</h3>
        <input type="text" name="dni_professor" class='invisible' placeholder="DNI" required>*
        <br></br>
        <input type="text" name="nom" class='invisible' placeholder="Nom" required>
        <br></br>
        <input type="text" name="cognoms" class='invisible' placeholder="Cognoms" required>
        <br></br>
        <input type="text" name="titol_academic" class='invisible' placeholder="Títol Acadèmic" required>
        <br></br>
        <input type="file" class='selectfile' name="foto" id="foto" required><label for="foto" class='invisible label'> Selecciona fotografia</label>
        <br></br>
        <input type="password" name="contrasenya" class='invisible' placeholder="Contrasenya" required>*
        <p style='font-size:10px;'>* -> El DNI i la contrasenya es faran servir com a usuari i password al Login, respectivament.
        <br>
        <br>
        <input type="submit" class='label button' name="enviar">
    </form>
    <div class="alta">
        <br></br>
        <a href="manteniment.php">Tornar enrere</a>
        <br></br>
        <a href="sortir.php">Sortir de la sessió</a>
    </div>          
    <footer></footer>

</body>
</html>