<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="cat">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css" type="text/css">
    <title>Alta d'usuaris</title>
</head>
<body>
    <?php
    // if (isset($_SESSION["user"])){
    $conexio = mysqli_connect("localhost","root","","infobdn");
        if ($_POST){
            if ($conexio == false){
                mysqli_connect_error();
            }else{
            $dni_alumne = $_POST['dni_alumne'];
            $nom = $_POST['nom'];
            $cognoms = $_POST['cognoms'];
            $edat = $_POST['edat'];
            $correu = $_POST['correu'];
            $PasUsuari = $_POST['contrasenya'];
            $contrasenya = md5($PasUsuari);

            if (is_uploaded_file ($_FILES['foto']['tmp_name'])){
                $nombreDirectorio = "imgalumnes/";
                $idUnico = $dni_alumne;
                $nombreorigen = $_FILES['foto']['name'];
                $contingutnom = explode(".",$nombreorigen);
                $extension = $contingutnom[1]; 
                $nombreFichero = $nombreDirectorio.$idUnico.".".$extension;
                move_uploaded_file ($_FILES['foto']['tmp_name'],$nombreFichero);

                $sql = "INSERT INTO alumnes VALUES ('$dni_alumne', '$nom', '$cognoms', '$edat', '$nombreFichero', '$correu', '$contrasenya', '$visible')";
                $consulta = mysqli_query($conexio,$sql);
                if(!$consulta){
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida ".$sql;    
                }else{
                    echo "Usuari creat correctament!";
                    echo "<br>";
                    echo "Redirigint...";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=main_alumne.php'>";
                }  
            }
            else{
                print ("No s'ha pogut pujar l'arxiu.\n");
            }
        }   
        }else{ 
        ?>
        <header>
            <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
            <nav class="nav">
                <a href="alta.php"class="menu">Registra't</a>
                <a href="login.php"class="menu">Inicia Sessió</a>
                <a href="admin.php"class="menu">Manteniment</a>
                <a href="quisom.html"class="menu">Qui som?</a>
            </nav>
        </header>
        <h2>Creació del compte</h2>
        <form action="alta.php" method="POST" class="formulari" enctype='multipart/form-data'>
            <br>
            <input type="text" required="required" placeholder="DNI" name="dni_alumne"/>
            <br></br>
            <input type="text" required="required" placeholder="Nom" name="nom">
            <br></br>
            <input type="text" required="required" placeholder="Cognoms" name="cognoms">
            <br></br>
            <input type="text" required="required" placeholder="Edat" name="edat">
            <br></br>
            <input type="file" name="foto" id="foto">
            <br></br>
            <input type="text" required="required" placeholder="Correu" name="correu">
            <br></br>
            <input type="password" required="required" placeholder="Contrasenya" name="contrasenya">
            <br></br>
            <input type="submit" name="enviar" value="Aceptar"/>
            <br></br>
        </form>
        <footer></footer>
        <?php  
        }
    // }else{
    //     // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
    //     echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
    //     echo "Redirigint..";
    //     echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=admin.php'>";
    // }
        ?>
</body>
</html>