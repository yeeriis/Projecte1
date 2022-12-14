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
            <a href="llistacursalum.php" class="menu">Els meus cursos</a>
            <a href="perfilalumne.php" class="menu">El meu perfil</a>
        </nav>
        <p  id="nomprof">Benvingut/da, <?php echo $_SESSION['nom']; ?></p>
    </header>
    <br>
    <?php
    $data_actual = date ('Y-m-d');
    $dni = $_SESSION['dni_alumne'];
   
    if(isset($_SESSION['dni_alumne']) ){
        if($_POST){
            echo "<form action='cursosalum.php' class='buscador' method='POST' name='search'>";
            echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";
            $conexio2 = mysqli_connect('localhost','root','','infobdn');
            $filtro = $_POST['search'];
            $codi = $_SESSION['codi_curs'];

            $sql = "SELECT * FROM cursos WHERE nom LIKE '%$filtro%' and data_inici>'$data_actual' and visible = 1 and codi_curs NOT IN (SELECT codi_curs FROM matricula WHERE dni_alumne = $dni)";
            $consulta = mysqli_query($conexio2,$sql);
            $linies = mysqli_num_rows($consulta);
                echo "<h2>Cursos Disponibles</h2>";
                echo "<table border='1' class='formulari'>";
                echo "<tr>";
                ?>
                    <tr class="titols">
                        <td>Nom</td>
                        <td>DescripciĆ³</td>
                        <td>Hores</td>
                        <td>Data Inici</td>
                        <td>Data Final</td>
                        <td>Matricular-me</td>
                    </tr>
                <?php
                    echo "</tr>";
                for($i = 0; $i < $linies; $i++){
                    $curs = mysqli_fetch_assoc($consulta);
                    echo "<tr style='color: white';>";
                    echo "<td>".$curs['nom']."</td>";
                    echo "<td>".$curs['descripcio']."</td>";
                    echo "<td>".$curs['hores']."</td>";
                    echo "<td>".$curs['data_inici']."</td>";
                    echo "<td>".$curs['data_final']."</td>";
                    echo "<td><a href='matriculacio.php'><input type='button' value='Matricular-me'></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>    
                </table>
                <br></br>
                <div class="alta">
                    <a href="sortir.php">Sortir de la sessiĆ³</a>
                </div>
                <footer></footer>
            <?php
        }else{
            echo "<form action='cursosalum.php' class='buscador' method='POST' name='search'>";
            echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";
                $conexio = new mysqli('localhost', 'root', '', 'infobdn');
                if($conexio == FALSE){
                    mysqli_connect_error();
                }else{
                    $sql = "SELECT * FROM cursos WHERE data_inici>'$data_actual' and visible = 1 and codi_curs NOT IN (SELECT codi_curs FROM matricula WHERE dni_alumne = $dni)";
                    $resultat = mysqli_query($conexio, $sql);
                    $linies = mysqli_num_rows($resultat);
                    
                    ?>
                    <h2>Cursos Disponibles</h2>
                    <table border="1" class="taula">
                        <tr class="titols">
                            <td>Nom</td>
                            <td>DescripciĆ³</td>
                            <td>Hores</td>
                            <td>Data Inici</td>
                            <td>Data Final</td>
                            <td>Matricular-me</td>
                        </tr>
                    <?php
                    $dni = $_SESSION['dni_alumne'];
                    for($i = 0; $i < $linies; $i++){
                        $curs = mysqli_fetch_assoc($resultat);
                        $codi_curs = $curs['codi_curs'];
                        echo "<tr style='color: white';>";
                            echo "<td>".$curs['nom']."</td>";
                            echo "<td>".$curs['descripcio']."</td>";
                            echo "<td>".$curs['hores']."</td>";
                            echo "<td>".$curs['data_inici']."</td>";
                            echo "<td>".$curs['data_final']."</td>";
                            echo "<td><a href='matriculacio.php?dni=$dni&curs=$codi_curs'><input type='button' value='Matricular-me'></a></td>";
                        echo "</tr>";
                    }
                    ?>    
                    </table>
                    <br></br>
                    <div class="alta">
                        <a href="sortir.php">Sortir de la sessiĆ³</a>
                    </div>
                    <footer></footer>
                <?php
                }
            }
    }else{
        echo "<p style='color:white;'>Has d'estar validat per veure aquesta pagina.</p>";
        echo "<p style='color:white;'>Redirigint...</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
    }
    ?>
</body>
</html>