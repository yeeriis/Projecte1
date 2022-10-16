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
    <title>Cursos Professors</title>
</head>
<body>
    <?php
    include "funcions.php";
    menuProfe();
    $data_actual = date ('Y-m-d');
    $dni = $_SESSION['dni_professor'];
    $nom = $_SESSION['nom'];

    if(isset($_SESSION['dni_professor'])){
        if($_POST){
            cursProfBuscador();
        }else{
            cursProf();
        }
    }else{
        echo "<p style='color:white;'>Has d'estar validat per veure aquesta pagina.</p>";
        echo "<br>";
        echo "<p style='color:white;'>Redirigint...</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=http:index.php'/>";
    }
    ?>
</body>
</html>