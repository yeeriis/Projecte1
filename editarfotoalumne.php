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
    <title>Editar Foto</title>
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
                $oldfotografia = $_POST['oldfoto'];
                if ($oldfotografia!=''){
                    if (unlink($oldfotografia)){
                        echo"<p>Fotografia anterior eliminada.</p>";
                    }else{
                        echo"<p>Error! No s'ha pogut eliminar la fotografia.</p>";
                    }
                }else{
                    echo"<p>L'usuari no tenia fotografia.</p>";
                }  
                if (is_uploaded_file ($_FILES['fotografia']['tmp_name'])){
                    $nombreDirectorio = "imgalumnes/";
                    $idUnico = $dni_alumne;
                    $nom=$_FILES['fotografia']['name'];
                    $cont=explode(".",$nom);
                    $extensio= $cont[1];
                    $fotografia = $idUnico.".".$extensio;
                    move_uploaded_file ($_FILES['fotografia']['tmp_name'],
                    $nombreDirectorio.$fotografia);
                    $sql = "UPDATE alumnes SET fotografia='imgalumnes/$fotografia' WHERE dni_alumne LIKE '$dni_alumne'";
                }else{
                    print ("<p>No s'ha pogut pujar la fotografia nova</p>");
                    $sql = "UPDATE alumnes SET fotografia='' WHERE dni_alumne LIKE '$dni_alumne'";
                }
                $consulta = mysqli_query ($conexio,$sql);  
                if(!$consulta){ 
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida.".$sql; 
                    echo "<br>";
                    echo "Redirigint...";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=gestio_alumnes.php'>";
                }else{
                   echo "Fotografia modificada correctament.";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=gestio_alumnes.php'>";
                }
            }
        }else{
            if ($_REQUEST['dni_alumne']) {
                $dni_alumne = $_REQUEST['dni_alumne'];
                $oldfotografia = $_REQUEST['oldfoto'];
                echo "<header>";
                        echo "<a href='index.php'><img src='img/logo-infobdn.svg' alt='logo infobdn' class='logo'/></a>";
                        echo "<nav class='nav'>";
                            echo "<a href='alta.php'class='menu'>Registra't</a>";
                            echo "<a href='login.php'class='menu'>Inicia Sessió</a>";
                            echo "<a href='admin.php'class='menu'>Manteniment</a>";
                            echo "<a href='quisom.html'class='menu'>Qui som?</a>";
                        echo "</nav>";
                        echo "</header>";
                echo "<h2> Modificar la teva fotografia </h2>";
                echo "<form action='editarfotoalum.php' ENCTYPE='multipart/form-data' class='formulari' method='post'>";
                echo "<br>";
                echo "<br>";
                echo "<img with='100px' height='100px' src='$oldfotografia'>";
                echo "<br>";
                echo "<br>";
                echo "<input readonly class='ocult' type='text' name='oldfoto' id='oldfoto' value='$oldfotografia'>";
                echo "<br/>";
                echo "<br/>";
                echo "DNI: <input readonly class='ocult' type='text' name='dni_alumne' id='dni_alumne' value='$dni_alumne'>";
                echo "<br>";
                echo "<br>";
                echo "<input required type='file' name='fotografia' id='fotografia' accept='image/*'>";
                echo "<br>";
                echo "<br>";
                echo "<button type='submit' >Modificar</button>";
                echo "<br>";
                echo "<br>";
                echo "</form>";
                ?>
                <div class="alta">
                    <br></br>
                    <a href="perfilalumne.php">Tornar enrere</a>
                    <br></br>
                    <a href="sortir.php">Sortir de la sessió</a>
                </div>          
                <?php
            }else{
                echo "No s'ha pogut obtenir el DNI de l'alumne.";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=gestio_alumnes.php'>";
            }
        }
    }else{
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }    
    ?>
</body>

</html>