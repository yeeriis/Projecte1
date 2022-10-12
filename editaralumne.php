<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css" type="text/css">
    <title>Editar Alumne</title>
</head>
<body>
    <?php
    if (isset($_SESSION["user"])){ 
        if ($_POST) {
            $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $dni_alumne = $_POST['dni_alumne'];
                $nom = $_POST['nom'];
                $cognoms = $_POST['cognoms'];
                $edat = $_POST['edat'];
                $correu = $_POST['correu'];
                $contrasenya = $_POST['contrasenya'];
                $md5pass = md5($contrasenya);

                $sql = "UPDATE alumnes SET nom = '$nom', cognoms = '$cognoms', edat = '$edat', correu = '$correu',contrasenya = '$md5pass' WHERE dni_alumne LIKE '$dni_alumne'";
                $consulta = mysqli_query ($conexio,$sql);

                if(!$consulta){ 
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida. ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
                }else{
                   echo "Professor modificat correctament.";
                   echo "Redirigint..";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=manteniment.php'>";
                }
            }
        }else{
            if ($_REQUEST['dni_alumne']) {
                $conexio = mysqli_connect("localhost","root","","infobdn");
                if ($conexio == false){
                    mysqli_connect_error();
                }else{
                    $dni_alumne = $_REQUEST['dni_alumne'];
                    $sql = "SELECT * FROM alumnes WHERE dni_alumne LIKE '$dni_alumne'";
                    $consulta = mysqli_query ($conexio,$sql);  

                    if(!$consulta){ 
                        echo mysqli_error($conexio)."<br>"; 
                        echo "Error! Query no vàlida. ".$sql; 
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=gestio_profes.php'>";
                    }else{
                        echo "<header>";
                        echo "<a href='index.php'><img src='img/logo-infobdn.svg' alt='logo infobdn' class='logo'/></a>";
                        echo "<nav class='nav'>";
                            echo "<a href='alta.php' class='menu'>Registra't</a>";
                            echo "<a href='login.php' class='menu'>Inicia Sessió</a>";
                            echo "<a href='admin.php' class='menu'>Manteniment</a>";
                            echo "<a href='quisom.html' class='menu'>Qui som?</a>";
                        echo "</nav>";
                        echo "</header>";
                        $alumne = mysqli_fetch_assoc($consulta);
                        echo "<h2> Modificar alumne </h2>";
                        echo "<form action='editaralumne.php' class='formulari' ENCTYPE='multipart/form-data' method='post'>";
                            echo "<br>";
                            echo "<br>";
                            echo "DNI: <input type='text' name='dni_alumne' id='dni_professor' value='".$alumne['dni_alumne']."' readonly>";
                            echo "<br>";
                            echo "<br>";
                            echo "Nom: <input type='text' name='nom' id='nom' value='".$alumne['nom']."'>";
                            echo "<br>";
                            echo "<br>";
                            echo "Cognoms: <input type='text' name='cognoms' id='cognoms' value='".$alumne['cognoms']."'>";
                            echo "<br>";
                            echo "<br>";
                            echo "Edat: <input type='text' name='edat' id='edat' value='".$alumne['edat']."'>";
                            echo "<br>";
                            echo "<br>";
                            echo "Correu: <input type='text' name='correu' id='correu' value='".$alumne['correu']."'>";
                            echo "<br>";
                            echo "<br>";
                            echo "Contrasenya: <input type='password' name='contrasenya' id='contrasenya'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit'>Modificar</button>";
                            echo "<br>";
                            echo "<br>";      
                         echo "</form>";                     
                    }   
                } 
            }else{
                echo "No s'ha pogut obtenir el DNI de l'alumne.";
            }
        }
    }else{
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "Redirigint..";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }
    ?>
    <br></br>
        <div class="alta">
            <a href="manteniment.php">Tornar enrere</a>
            <br></br>
            <a href="sortir.php">Sortir de la sessió</a>
        </div>
    <footer></footer>
</body>
</html>