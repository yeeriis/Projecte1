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
    <title>Editar professor</title>
</head>
<body>
    <?php
    if (isset($_SESSION["user"])){ 
        if ($_POST) {
            $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $dni_professor = $_POST['dni_professor'];
                $nom = $_POST['nom'];
                $cognoms = $_POST['cognoms'];
                $titol_academic = $_POST['titol'];
                $contrasenya = $_POST['contrasenya'];
                $md5pass = md5($contrasenya);

                $sql = "UPDATE professors SET nom = '$nom', cognoms = '$cognoms', titol_academic = '$titol_academic', contrasenya = '$md5pass' WHERE dni_professor LIKE '$dni_professor'";
                $consulta = mysqli_query ($conexio,$sql);

                if(!$consulta){ 
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida. ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
                }else{
                   echo "Professor modificat correctament.";
                   echo "<br>";
                   echo "Redirigint..";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=manteniment.php'>";
                }
            }
        }else{
            if ($_REQUEST['dni_professor']) {
                $conexio = mysqli_connect("localhost","root","","infobdn");
                if ($conexio == false){
                    mysqli_connect_error();
                }else{
                    $dni_professor = $_REQUEST['dni_professor'];
                    $sql = "SELECT * FROM professors WHERE dni_professor LIKE '$dni_professor'";
                    $consulta = mysqli_query ($conexio,$sql);  

                    if(!$consulta){ 
                        echo mysqli_error($conexio)."<br>"; 
                        echo "Error! Query no vàlida. ".$sql; 
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=gestio_profes.php'>";
                    }else{
                        echo "<header>";
                        echo "<a href='index.php'><img src='img/logo-infobdn.svg' alt='logo infobdn' class='logo'/></a>";
                        echo "</header>";
                        $profe = mysqli_fetch_assoc($consulta);
                        echo "<h2> Modificar professor </h2>";
                        echo "<form action='editarprofe.php' class='formulari' ENCTYPE='multipart/form-data' method='post'>";
                            echo "<br>";
                            echo "<br>";
                            echo "DNI: <input type='text' name='dni_professor' id='dni_professor' value='".$profe['dni_professor']."' readonly>";
                            echo "<br>";
                            echo "<br>";
                            echo "Nom: <input type='text' name='nom' id='nom' value='".$profe['nom']."'>";
                            echo "<br>";
                            echo "<br>";
                            echo "Cognoms: <input type='text' name='cognoms' id='cognoms' value='".$profe['cognoms']."'>";                            
                            echo "<br>";
                            echo "<br>";
                            echo "Titol acadèmic: <input type='text' name='titol' id='titol' value='".$profe['titol_academic']."'>";
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
                echo "No s'ha pogut obtenir el DNI del professor.";
            }
        }
    }else{
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "Redirigint..";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=admin.php'>";
    }
    ?>
</body>
</html>