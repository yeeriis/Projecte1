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
        $dni = $_SESSION['dni_alumne'];


    // if (isset($_SESSION["user"])){ 
        if ($_POST) {
            $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $dni_alumne = $_POST['dni_alumne'];
                $codi = $_POST['codi_curs'];
                $nota = $_POST['nota'];


                $sql = "UPDATE matricula SET dni_alumne = $dni_alumne, codi_curs = $codi, nota = $nota WHERE dni_alumne = '$dni' AND codi_curs = $codi";
                $consulta = mysqli_query ($conexio,$sql);

                if(!$consulta){ 
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida. ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
                }else{
                   echo "Nota modificada correctament.";
                   echo "<br>";
                   echo "Redirigint..";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=alumnescurs.php'>";
                }
            }
        }else{
            if ($_REQUEST['dni_alumne']) {
                $conexio = mysqli_connect("localhost","root","","infobdn");
                if ($conexio == false){
                    mysqli_connect_error();
                }else{
                    $dni = $_REQUEST['dni_alumne'];
                    $codi = $_REQUEST['codi_curs'];

                    $sql = "SELECT * FROM matricula WHERE dni_alumne LIKE $dni AND codi_curs LIKE $codi";
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
                        $alumne = mysqli_fetch_assoc($consulta);
                        echo "<h2> Modificar professor </h2>";
                        echo "<form action='editarnota.php' class='formulari' ENCTYPE='multipart/form-data' method='post'>";
                            echo "<br>";
                            echo "<br>";
                            echo "DNI Alumne: <input type='text' name='dni_alumne' id='dni_alumne' value='".$alumne['dni_alumne']."' readonly>";
                            echo "<br>";
                            echo "Codi Curs: <input type='text' name='codi_curs' id='codi_curs' value='".$alumne['codi_curs']."' readonly>";
                            echo "<br>";
                            echo "Nota: <input type='text' name='nota' min='0' max='10' id='nota' value='".$alumne['nota']."'>";
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
    // }else{
    //     echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
    //     echo "Redirigint..";
    //     echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=admin.php'>";
    // }
    ?>
</body>
</html>