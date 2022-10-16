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
    <title>Creació de Cursos</title>
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
        </nav>
    </header>
    <br>
<?php
    include "funcions.php";
    if (isset($_SESSION["user"])){
       $conexio = mysqli_connect("localhost","root","","infobdn");
       if ($_POST){
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                altaCurs();
            }    
        }else{
            $conexio = mysqli_connect("localhost","root","","infobdn");
            if ($conexio == false){
                mysqli_connect_error();
            }else{
                $sentencia = "SELECT dni_professor, nom, cognoms FROM professors";
                $consulta = mysqli_query ($conexio,$sentencia);  

                if(!$consulta){ 
                    echo mysqli_error($conexio)."<br>"; 
                    echo "Error! Query no vàlida. ".$sentencia; 
                    echo "Redirigint...";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=gestio_cursos.php'>";
                }else{
                    ?>
                    <form action="alta_cursos.php" method="POST" class="formulari">
                        <h3>Creació de Cursos</h3>
                        <input type="text" name="codi_curs" class='invisible' placeholder="Codi Curs" required>
                        <br></br>
                        <input type="text" name="nom" class='invisible' placeholder="Nom" required>
                        <br></br>
                        <input type="text" name="descripcio" class='invisible' placeholder="Descripció" required>
                        <br></br>
                        <input type="text" name="hores" class='invisible' placeholder="Hores" required>
                        <br></br>
                        <input type="date" name="data_inici" class='invisible' placeholder="Data Inici" required>
                        <br></br>
                        <input type="date" name="data_final" class='invisible' placeholder="Data Final" required>
                        <br></br>
                        Professor que imparteix: <select name="dni_professor" id="dni_professor">
                    <?php
                        $linies = mysqli_num_rows($consulta);
                        for($i = 0;$i < $linies; $i++){
                            $dni_professor = mysqli_fetch_assoc($consulta);
                    ?>
                        <option value="<?php echo $dni_professor['dni_professor']?>"><?php echo $dni_professor['nom'].' '.$dni_professor['cognoms']?></option>
                    <?php
                        }
                    ?>
                        </select></p>
                        <p><button type='submit' class='button label'>Crear</button></p>  
                    </form>
                    <div class="alta">
                        <br></br>
                        <a href="manteniment.php">Tornar enrere</a>
                        <br></br>
                        <a href="sortir.php">Sortir de la sessió</a>
                    </div>          
                   <?php
                    
                }   
            }
        }
    }else{
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "Redirigint...";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
    }
    ?>
</body>
</html>