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
            <a href="alta.php"class="menu">Registra't</a>
            <a href="login.php"class="menu">Inicia Sessió</a>
            <a href="admin.php"class="menu">Manteniment</a>
            <a href="quisom.html"class="menu">Qui som?</a>
        </nav>
    </header>
    <br>
<?php
    if (isset($_SESSION["user"])){
       $conexio = mysqli_connect("localhost","root","","infobdn");
       if ($_POST){
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

                $sql = "INSERT INTO cursos VALUES ('$codi_curs', '$nom', '$descripcio', '$hores', '$data_inici', '$data_final', '$dni_professor', 'si')";
                $consulta = mysqli_query($conexio,$sql);

                if(!$consulta){
                   echo mysqli_error($conexio)."<br>"; 
                   echo "Error! Query no vàlida ".$sql;    
                }else{
                   echo "<h2>Curs creat correctament</h2>";
                   echo "<p>Redirigint...</p>";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=gestio_cursos.php'>";
                }  
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
                        <input type="text" name="codi_curs" placeholder="Codi Curs" required>
                        <br></br>
                        <input type="text" name="nom" placeholder="Nom" required>
                        <br></br>
                        <input type="text" name="descripcio" placeholder="Descripció" required>
                        <br></br>
                        <input type="text" name="hores" placeholder="Hores" required>
                        <br></br>
                        <input type="date" name="data_inici" placeholder="Data Inici" required>
                        <br></br>
                        <input type="date" name="data_final" placeholder="Data Final" required>
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
                        <p><button type='submit'>Crear</button></p>  
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
    <footer></footer>
</body>
</html>