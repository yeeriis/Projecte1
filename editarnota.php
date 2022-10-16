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
    <title>Editar Nota</title>
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
            <a href="admin.php" class="menu">Manteniment</a>
        </nav>
        <p  id="nomprof">Benvingut/da, <?php echo $_SESSION['nom']; ?></p>
    </header>
    <?php
    $dni = $_SESSION['dni_professor'];

    if (isset($_SESSION['dni_professor'])){ 
        if ($_POST) {
            $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $dni_alumne = $_POST['dni_alumne'];
                $codi = $_REQUEST['codi_curs'];
                $nota = $_POST['nota'];

                $sql = "UPDATE matricula SET nota = $nota WHERE dni_alumne = '$dni_alumne' AND codi_curs = $codi";
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
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=alumnescurs.php?codi_curs=$codi'>";
                }
            }
        }else{
            if ($_REQUEST['dni_alumne']) {
                $conexio = mysqli_connect("localhost","root","","infobdn");
                if ($conexio == false){
                    mysqli_connect_error();
                }else{
                    $dni = $_REQUEST['dni_alumne'];
                    $codi = $_REQUEST['curs'];

                    $sql = "SELECT * FROM matricula WHERE dni_alumne LIKE $dni AND codi_curs LIKE $codi";
                    $consulta = mysqli_query ($conexio,$sql);  

                    if(!$consulta){ 
                        echo mysqli_error($conexio)."<br>"; 
                        echo "Error! Query no vàlida. ".$sql; 
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=alumnescurs.php'>";
                    }else{
                        $alumne = mysqli_fetch_assoc($consulta);
                        echo "<h2> Modificar Nota </h2>";
                        echo "<form action='editarnota.php' class='formulari' ENCTYPE='multipart/form-data' method='post'>";
                            echo "<br>";
                            echo "<br>";
                            echo "DNI Alumne: <input type='text' name='dni_alumne' class='invisible' id='dni_alumne' value='".$alumne['dni_alumne']."' readonly>";
                            echo "<br>";
                            echo "<br>";
                            echo "Codi Curs: <input type='text' name='codi_curs' class='invisible' id='codi_curs' value='".$alumne['codi_curs']."' readonly>";
                            echo "<br>";
                            echo "<br>";
                            echo "Nota: <input type='number' name='nota' min='0' max='10' class='invisible' required id='nota' value='".$alumne['nota']."'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit'>Modificar</button>";
                            echo "<br>";
                            echo "<br>";   
                         echo "</form>";                     
                    }
                    ?>
                    <br><br>
                    <div class="alta">
                        <a href="sortir.php">Sortir de la sessió</a>
                    </div>
                    <?php 
                } 
            }else{
                echo "No s'ha pogut obtenir el DNI de l'alumne.";
            }
        }
    }else{
        echo "<p style='color:white;'>Has d'estar validat per veure aquesta pagina.</p>";
        echo "<p style='color:white;'>Redirigint...</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=admin.php'>";
    }
    ?>
</body>
</html>