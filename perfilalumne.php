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
        <p  id="nomprof">Benvingut/da, <?php echo $_SESSION['nom']; ?></p>
    </header>
    <br>
    <?php
    $data_actual = date ('Y-m-d');
    $dni = $_SESSION['dni_alumne'];
   
    if(isset($_SESSION['nom']) ){
    if($_POST){
        $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $dni_alumne = $_POST['dni_alumne'];
                $nom = $_POST['nom'];
                $cognoms = $_POST['cognoms'];
                $edat = $_POST['edat'];
                $correu = $_POST['correu'];

                $sql = "SELECT * FROM alumnes WHERE nom = '$nom', cognoms = '$cognoms', edat = '$edat', correu = '$correu', fotografia ='$fotografia'";
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
        
            echo "<h2>El meu perfil</h2>";
            echo "<div class='parent'>
                <div class='div1'>
                    <div><p>Nom: ".$perfil['nom']."</p></div>
                    <br>
                    <div><p>Cognoms: ".$perfil['cognoms']."</p></div>
                    <br>
                    <div><p>Edat: ".$perfil['edat']."</p></div>
                    <br>
                    <div><p>Correu: ".$perfil['correu']."</p></div>
                    <br>
                </div>
                <div class='div2'>
                    <div><p>Fotografia:</p></div>
                    <div><img src='".$perfil['fotografia']."'></div>
                    <div><a href='editarfotoalumne.php?dni_alumne=".$perfil['dni_alumne']."&oldfoto=".$perfil['fotografia']."'><img src='img/editfoto.png' height='40px' width='40px'</a></div>

                </div>
            </div>";  
        
    }else{
            $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $dni_alumne = $_SESSION['dni_alumne'];
                $sql = "SELECT * FROM alumnes WHERE dni_alumne LIKE '$dni_alumne'";
                $consulta = mysqli_query ($conexio,$sql);  

                if(!$consulta){ 
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida. ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=gestio_profes.php'>";
                }else{
                    $perfil = mysqli_fetch_assoc($consulta);

                    echo "<h2>El meu perfil</h2>";
                    echo "<div class='parent'>
                        <div class='div1'>
                            <div><p>Nom: ".$perfil['nom']."</p></div>
                            <br>
                            <div><p>Cognoms: ".$perfil['cognoms']."</p></div>
                            <br>
                            <div><p>Edat: ".$perfil['edat']."</p></div>
                            <br>
                            <div><p>Correu: ".$perfil['correu']."</p></div>
                            <br>
                        </div>
                        <div class='div2'>
                            <div><p>Fotografia:</p></div>
                            <div class='image'><img src='".$perfil['fotografia']."'></div>
                            <div><a href='editarfotoalumne.php?dni_alumne=".$perfil['dni_alumne']."&oldfoto=".$perfil['fotografia']."'><img src='img/editfoto.png' height='40px' width='40px'</a></div>

                        </div>
                    </div>";  
                }   
            } 

        ?>    
        </table>
        <br></br>
        <div class="alta">
            <a href="sortir.php">Sortir de la sessió</a>
        </div>
        <footer></footer>
        <?php
    }
        }else{
        print("Has d'estar validat per veure aquesta pagina.");
        echo "Redirigint...";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
        }
    ?>
</body>
</html>