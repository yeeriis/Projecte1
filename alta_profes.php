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
    if (isset($_SESSION["user"])){
       $conexio = mysqli_connect("localhost","root","","infobdn");
       
        if ($_POST){
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $dni_professor = $_POST['dni_professor'];
                $nom = $_POST['nom'];
                $cognoms = $_POST['cognoms'];
                $titol_academic = $_POST['titol_academic'];
                $visible = $_POST['visible'];
                $PasUsuari = $_POST['contrasenya'];
                $contrasenya = md5($PasUsuari);
                // $contrasenya = $_POST['contrasenya'];
               
                if(is_uploaded_file ($_FILES['foto']['tmp_name'])){
                    $nombreDirectorio = "imgprofes/";
                    $idUnico = $dni_professor;
                    $nombreorigen = $_FILES['foto']['name'];
                    $contingutnom = explode(".",$nombreorigen);
                    $extension = $contingutnom[1]; 
                    $nombreFichero = $nombreDirectorio.$idUnico.".".$extension;
                    move_uploaded_file ($_FILES['foto']['tmp_name'],$nombreFichero);

                    $sql = "INSERT INTO professors VALUES ('$dni_professor', '$nom', '$cognoms', '$titol_academic', '$nombreFichero', '$contrasenya' , '$visible')";
                    $consulta = mysqli_query($conexio,$sql);
                    if(!$consulta){
                        echo mysqli_error($conexio)."<br>"; 
                        echo "Error! Query no vàlida ".$sql;    
                    }else{
                        echo "Usuari creat correctament!";
                        echo "<br>";
                        echo "Redirigint...";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=gestio_profes.php'>";
                    }  
                }else{
                    print ("No se ha podido subir el fichero\n");
                }
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
            <a href="alta.php"class="menu">Registra't</a>
            <a href="login.php"class="menu">Inicia Sessió</a>
            <a href="admin.php"class="menu">Manteniment</a>
            <a href="quisom.html"class="menu">Qui som?</a>
        </nav>
    </header>
    <br>
    <form action="alta_profes.php" method="POST" class="formulari" enctype='multipart/form-data'>
        <h3>Alta de Professors</h3>
        <input type="text" name="dni_professor" placeholder="DNI" required>*
        <br></br>
        <input type="text" name="nom" placeholder="Nom" required>
        <br></br>
        <input type="text" name="cognoms" placeholder="Cognoms" required>
        <br></br>
        <input type="text" name="titol_academic" placeholder="Títol Acadèmic" required>
        <br></br>
        Fotografia:<input type="file" name="foto" id="foto" required>
        <br></br>
        <input type="password" name="contrasenya" placeholder="Contrasenya" required>*
        <p>* -> El DNI i la contrasenya es faran servir com a usuari i password al Login, respectivament.
        <br>
        <input type="submit" name="enviar">
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