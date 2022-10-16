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
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=login.php'>";
                }  
            }
            else{
                print ("No s'ha pogut pujar l'arxiu.\n");
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=login.php'>";

            }
        }   
        }else{ 
        ?>
        <header>
            <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
            <nav class="nav">
                <a href="login.php"class="menu">Inicia Sessió</a>
                <a href="admin.php"class="menu">Manteniment</a>
            </nav>
        </header>
        <h2>Creació del compte</h2>
        <form action="alta.php" method="POST" class="formulari" enctype='multipart/form-data'>
            <br>
            <input type="text" required class='invisible' placeholder="DNI" name="dni_alumne"/>
            <br></br>
            <input type="text" required class='invisible' placeholder="Nom" name="nom">
            <br></br>
            <input type="text" required class='invisible' placeholder="Cognoms" name="cognoms">
            <br></br>
            <input type="text" required class='invisible' placeholder="Edat" name="edat">
            <br></br>
            <input type="file" class='selectfile' name="foto" id="foto" required><label for="foto" class='invisible label'> Selecciona fotografia</label>
            <br></br>
            <input type="text" required class='invisible' placeholder="Correu" name="correu">
            <br></br>
            <input type="password" required class='invisible' placeholder="Contrasenya" name="contrasenya">
            <br></br>
            <input type="submit" class='button label' name="enviar" value="Aceptar"/>
            <br></br>
        </form>
        <br><br>
        <div class="alta">
            <a href="index.php">Tornar enrere</a>
        </div>
        <footer></footer>
        <?php  
        }
        ?>
</body>
</html>