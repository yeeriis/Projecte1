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
            <a href="admin.php" class="menu">Manteniment</a>
        </nav>
        <p  id="nomprof">Benvingut/da, <?php echo $_SESSION['nom']; ?></p>
    </header>
    <br>
    <?php
    $dni = $_SESSION['dni_professor'];

    if(isset($_SESSION['dni_professor'])){
        $data_actual = date ('Y-m-d');
        if($_POST){
            echo "<form action='alumnescurs.php' class='buscador' method='POST' name='search'>";
            echo "Necessites buscar algun alumne? <input type='text' id='search' name='search' placeholder='Buscar'/>";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";
                $conexio2 = mysqli_connect('localhost','root','','infobdn');
                $filtro = $_POST['search'];
                $sentencia2 = "SELECT * FROM alumnes AS a INNER JOIN matricula AS m ON a.dni_alumne = m.dni_alumne WHERE m.codi_curs = '$codi'";
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
                        <td>Nota</td>
                        <td>Editar nota</td>
                    </tr>
                    <?php
                        echo "</tr>";
                    for($i = 0; $i < $linies; $i++){
                        $alumne = mysqli_fetch_assoc($consulta);
                        echo "<tr style='color: white';>";
                            echo "<td>".$alumne['nom']."</td>";
                            echo "<td>".$alumne['cognoms']."</td>";
                            echo "<td>".$alumne['correu']."</td>";
                            echo "<td>".$alumne['nota']."</td>";
                            echo "<td><a href='editarnota.php?dni_alumne=".$alumne['dni_alumne']."&codi_curs=".$alumne['curs']."&nota=".$alumne['nota']."'><input type='button' value='Editar Nota'></a></td>";
                        echo "</tr>";
                    }
                echo "</table>";
                ?>    
                </table>
                <br></br>
                <div class="alta">
                    <a href="sortir.php">Sortir de la sessió</a>
                </div>
            <?php
            }else{
                echo "<form action='alumnescurs.php' class='buscador' method='POST' name='search'>";
                echo "Necessites buscar algun alumne? <input type='text' id='search' name='search' placeholder='Buscar'/>";
                echo "<button type='submit'>Buscar</button>";
                echo "</form>";
                if ($_REQUEST['codi_curs']) {
                    $conexio = new mysqli('localhost', 'root', '', 'infobdn');
                    if($conexio == FALSE){
                        mysqli_connect_error();
                    }else{
                        $codi = $_REQUEST['codi_curs'];
                        $sql = "SELECT * FROM alumnes AS a INNER JOIN matricula AS m ON a.dni_alumne = m.dni_alumne WHERE m.codi_curs = '$codi'";
                        $resultat = mysqli_query($conexio, $sql);
                        $linies = mysqli_num_rows($resultat);
                        ?>
                        <h2>Alumnes del Curs</h2>
                        <table border="1" class="taula">
                            <tr class="titols">
                                <td>Nom</td>
                                <td>Cognoms</td>
                                <td>Correu</td>
                                <td>Nota</td>
                                <td>Editar nota</td>
                            </tr>
                        <?php 
                        for($i = 0; $i < $linies; $i++){
                            $alumne = mysqli_fetch_assoc($resultat);
                            echo "<tr style='color: white';>";
                                echo "<td>".$alumne['nom']."</td>";
                                echo "<td>".$alumne['cognoms']."</td>";
                                echo "<td>".$alumne['correu']."</td>";
                                echo "<td>".$alumne['nota']."</td>";
                                echo "<td><a href='editarnota.php?dni_alumne=".$alumne['dni_alumne']."&curs=".$alumne['codi_curs']."'><input type='button' value='Editar Nota'></a></td>";
                            echo "</tr>";
                        }
                        ?>    
                        </table>
                        <br></br>
                        <div class="alta">
                            <a href="cursosprof.php">Tornar enrere</a>
                            <br></br>
                            <a href="sortir.php">Sortir de la sessió</a>
                        </div>
                        <?php
                    }
                }else{
                    echo "No s'ha pogut obtenir el codi del curs.";
                }
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