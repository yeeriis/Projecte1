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
    <title>Cursos Disponibles</title>
</head>
<body>
    <header>
    <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
            <a href="alta.php" class="menu">Registra't</a>
            <a href="login.php" class="menu">Inicia Sessió</a>
            <a href="admin.php" class="menu">Manteniment</a>
            <a href="llistacursalum.php" class="menu">Els meus cursos</a>
            <a href="quisom.html" class="menu">Qui som?</a>
        </nav>
    </header>
    <br>
    <?php
    if (isset($_SESSION["nom"])){
       $conexio = mysqli_connect("localhost","root","","infobdn");
       if ($_REQUEST['dni']){
           if ($conexio == false){
               mysqli_connect_error();
           }else{
                $codi_curs = $_REQUEST['curs'];
                $dni = $_REQUEST['dni'];
                $sql = "INSERT INTO matricula VALUES ('$dni', '$codi_curs')";
                $consulta = mysqli_query($conexio,$sql);

                if(!$consulta){
                   echo mysqli_error($conexio)."<br>"; 
                   echo "Error! Query no vàlida ".$sql;    
                }else{
                   echo "<h2>Matriculat correctament</h2>";
                   echo "<p>Redirigint...</p>";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=cursosalum.php'>";
                } 
            }
        }
        else{
            echo "No 'sha pogut obtenir el codi del curs.";
        }
    }
    else{
        echo "Has d'estar validat per veure aquesta pagina";    
    }
    ?>
</body>
</html>


