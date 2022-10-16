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
    <title>Editar Curs</title>
</head>
<body>
    <?php
    if (isset($_SESSION["user"])){ 
        if ($_POST) {
            $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $codi_curs = $_POST['codi_curs'];
                $nom = $_POST['nom'];
                $descripcio = $_POST['descripcio'];
                $hores = $_POST['hores'];
                $data_inici = $_POST['data_inici'];
                $data_final = $_POST['data_final'];
                $dni_professor = $_POST['dni_professor'];

                $sql = "UPDATE cursos SET nom = '$nom', descripcio = '$descripcio', hores = '$hores', data_inici = '$data_inici' , data_final = '$data_final' , dni_professor = '$dni_professor' WHERE codi_curs LIKE '$codi_curs'";
                $consulta = mysqli_query ($conexio,$sql);  
                if(!$consulta){ 
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida. ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
                }else{
                   echo "Curs modificat correctament.";
                   echo "Redirigint..";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=manteniment.php'>";
                }
            }
        }else{
            if ($_REQUEST['codi_curs']) {
                $conexio = mysqli_connect("localhost","root","","infobdn");
                if ($conexio == false){
                    mysqli_connect_error();
                }else{
                    $codi_curs = $_REQUEST['codi_curs'];
                    $sql = "SELECT * FROM cursos WHERE codi_curs LIKE '$codi_curs'";
                    $consulta = mysqli_query ($conexio,$sql);

                    if(!$consulta){ 
                        echo mysqli_error($conexio)."<br>"; 
                        echo "Error! Query no vàlida. ".$sql; 
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=gestio_cursos.php'>";
                    }else{
                        echo "<header>";
                        echo "<a href='index.php'><img src='img/logo-infobdn.svg' alt='logo infobdn' class='logo'/></a>";
                        echo "<nav class='nav'>";
                            echo "<a href='alta.php'class='menu'>Registra't</a>";
                            echo "<a href='login.php'class='menu'>Inicia Sessió</a>";
                            echo "<a href='admin.php'class='menu'>Manteniment</a>";
                            echo "<a href='quisom.html'class='menu'>Qui som?</a>";
                        echo "</nav>";
                        echo "</header>";
                        $curs = mysqli_fetch_assoc($consulta);
                        echo "<h2> Modificar Curs </h2>";
                        echo "<form action='editarcurs.php' class='formulari' ENCTYPE='multipart/form-data' method='POST'>";
                        echo "<br>";
                        echo "<br>";
                        echo "Codi_curs: <input type='text' class='invisible' name='codi_curs' id='codi_curs' value='".$curs['codi_curs']."' readonly>";
                        echo "<br>";
                        echo "<br>";
                        echo "Nom: <input type='text' class='invisible' name='nom' id='nom' value='".$curs['nom']."'>";
                        echo "<br>";
                        echo "<br>";
                        echo "Descripcio: <input type='text' class='invisible' name='descripcio' id='descripcio' value='".$curs['descripcio']."'>";
                        echo "<br>";
                        echo "<br>";
                        echo "Hores: <input type='text' class='invisible' name='hores' id='hores' value='".$curs['hores']."'>";
                        echo "<br>";
                        echo "<br>";
                        echo "Data Inici: <input type='text' class='invisible' name='data_inici' id='data_final' value='".$curs['data_inici']."'>";
                        echo "<br>";
                        echo "<br>";
                        echo "Data Final: <input type='text' class='invisible' name='data_final' id='data_final' value='".$curs['data_final']."'>";
                        echo "<br>";
                        echo "<br>";
                        echo "DNI Professor: <input type='text' class='invisible' name='dni_professor' id='dni_professor' value='".$curs['dni_professor']."'>";
                        echo "<br>";
                        echo "<br>";
                        echo "<button type='submit'>Modificar</button>";
                        echo "<br>";
                        echo "<br>";
                        echo "</form>";                     
                    }   
                } 
            }else{
                echo "No s'ha pogut obtenir el codi del curs.";
            }
        }
    }else{
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "Redirigint...";
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