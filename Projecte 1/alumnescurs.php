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
    <title>Alumnes del Curs</title>
</head>
<body>
<header>
    <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
            <a href="alta.php" class="menu">Registra't</a>
            <a href="login.php" class="menu">Inicia Sessió</a>
            <a href="admin.php" class="menu">Manteniment</a>
            <a href="quisom.html" class="menu">Qui som?</a>
        </nav>
    </header>
    <br>
    <?php
    $data_actual = date ('Y-m-d');

    if(isset($_SESSION['nom'])){
        if($_POST){
            echo "<form action='cusosprof.php' class='buscador' method='POST' name='search'>";
            echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";
                $conexio2 = mysqli_connect('localhost','root','','infobdn');
                $filtro = $_POST['search'];
                $codi = $_SESSION['codi_curs'];
                $sentencia2 = "SELECT * FROM cursos WHERE nom LIKE '%$filtro%' and (SELECT * FROM alumnes WHERE dni_alumne = $dni)";
                $consulta = mysqli_query($conexio2,$sentencia2);
                $linies = mysqli_num_rows($consulta);
                    echo "<h2>Alumnes del Curs</h2>";
                    echo "<table border='1' class='formulari'>";
                    echo "<tr>";
                    ?>
                        <tr class="titols">
                            <td>Nom</td>
                            <td>Cognoms</td>
                            <td>Correu</td>
                            <td colspan="2">Nota</td>
                        </tr>
                    <?php
                        echo "</tr>";
                    for($i = 0; $i < $linies; $i++){
                        $alumne = mysqli_fetch_assoc($consulta);
                        echo "<tr>";
                        echo "<td>".$alumne['nom']."</td>";
                        echo "<td>".$alumne['cognoms']."</td>";
                        echo "<td>".$alumne['correu']."</td>";
                        // echo "<td>".$curs['notes']."</td>";
                        echo "</tr>";
                    }
                echo "</table>";
                ?>    
                </table>
                <br></br>
                <div class="alta">
                    <a href="sortir.php">Sortir de la sessió</a>
                </div>
                <footer></footer>
            <?php
            }else{
                echo "<form action='cursosprof.php' class='buscador' method='POST' name='search'>";
                echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
                echo "<button type='submit'>Buscar</button>";
                echo "</form>";
                    $conexio = new mysqli('localhost', 'root', '', 'infobdn');
                    if($conexio == FALSE){
                        mysqli_connect_error();
                    }else{
                        $sql = "SELECT * FROM alumnes WHERE dni_alumne = $dni_alumne INNER JOIN matricula WHERE dni_alumne = $dni_alumne ";
                        $resultat = mysqli_query($conexio, $sql);
                        $linies = mysqli_num_rows($resultat);
                        ?>
                        <h2>Alumnes del Curs</h2>
                        <table border="1" class="taula">
                            <tr class="titols">
                                <td>Nom</td>
                                <td>Cognoms</td>
                                <td>Correu</td>
                                <td colspan="2">Nota</td>
                            </tr>
                        <?php 
                        $dni = $_SESSION['dni_alumne'];
                        for($i = 0; $i < $linies; $i++){
                            $curs = mysqli_fetch_assoc($resultat);
                            echo "<tr>";
                                echo "<td>".$curs['nom']."</td>";
                                echo "<td>".$curs['cognoms']."</td>";
                                echo "<td>".$curs['correu']."</td>";
                                // echo "<td>".$curs['notes']."</td>";
                            echo "</tr>";
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
                        }
        }else{
                    echo "Has d'esta validat per veure aquesta pàgina";
                    echo "<br>";
                    echo "Redirigint...";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=http:index.php'/>";
            }
            ?>
</body>
</html>