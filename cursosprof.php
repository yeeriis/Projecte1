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
            echo "<form action='cusosprof.php' class='buscador' method='POST' name='search'>";
            echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";
            
                $conexio2 = mysqli_connect('localhost','root','','infobdn');
                $filtro = $_POST['search'];
                $codi = $_SESSION['codi_curs'];

                $sentencia2 = "SELECT * FROM cursos WHERE nom LIKE '%$filtro%' and visible = 1 and dni_professor = $dni)";
                $consulta = mysqli_query($conexio2,$sentencia2);
                $linies = mysqli_num_rows($consulta);
                    echo "<h2>Cursos Com a Professor</h2>";
                    echo "<table border='1' class='formulari'>";
                    echo "<tr>";
                    ?>
                        <tr class="titols">
                            <td>Nom</td>
                            <td>Descripció</td>
                            <td>Hores</td>
                            <td>Data Inici</td>
                            <td>Data Final</td>
                            <td>Veure Alumnes</td>
                        </tr>
                    <?php
                        echo "</tr>";
                    for($i = 0; $i < $linies; $i++){
                        $curs = mysqli_fetch_assoc($consulta);
                        $codi_curs = $curs['codi_curs'];

                        echo "<tr>";
                        echo "<td>".$curs['nom']."</td>";
                        echo "<td>".$curs['descripcio']."</td>";
                        echo "<td>".$curs['hores']."</td>";
                        echo "<td>".$curs['data_inici']."</td>";
                        echo "<td>".$curs['data_final']."</td>";
                        echo "<td><a href='alumnescurs.php?curs=$codi_curs'><input type='button' value='Alumnes'></a></td>";
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
                        $sql = "SELECT * FROM cursos WHERE visible = 1 and dni_professor = $dni";                    
                        $resultat = mysqli_query($conexio, $sql);
                        $linies = mysqli_num_rows($resultat);
                        ?>
                        <h2>Cursos Com a Professor</h2>
                        <table border="1" class="taula">
                            <tr class="titols">
                                <td>Nom</td>
                                <td>Descripció</td>
                                <td>Hores</td>
                                <td>Data Inici</td>
                                <td>Data Final</td>
                                <td>Veure Alumnes</td>
                            </tr>
                        <?php 
                        $dni = $_SESSION['dni_professor'];
                        for($i = 0; $i < $linies; $i++){
                            $curs = mysqli_fetch_assoc($resultat);
                            $codi_curs = $curs['codi_curs'];


                            echo "<tr>";
                                echo "<td>".$curs['nom']."</td>";
                                echo "<td>".$curs['descripcio']."</td>";
                                echo "<td>".$curs['hores']."</td>";
                                echo "<td>".$curs['data_inici']."</td>";
                                echo "<td>".$curs['data_final']."</td>";
                                echo "<td><a href='alumnescurs.php?codi_curs=$codi_curs'><input type='button' value='Alumnes'></a></td>";
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