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
    <title>Gestió de Cursos</title>
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
    if($_POST){
        echo "<form action='gestio_cursos.php' class='buscador' method='POST' name='search'>";
        echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
        echo "<button type='submit'>Buscar</button>";
        echo "</form>";

        if(isset($_POST['search']) && $_POST['search'] != ""){
            $conexio2 = mysqli_connect('localhost','root','','infobdn');
            $filtro = $_POST['search'];
            $sentencia2 = "SELECT * FROM cursos WHERE nom LIKE '%$filtro%'";
            if($resultat2 = mysqli_query($conexio2, $sentencia2)){
                while($fila = $resultat2 -> fetch_assoc()){
                    $llista[] = $fila;
                }
            }                 
            foreach($llista as $clave => $valor){
                echo "<h2>Gestió de Cursos</h2>";
                echo "<table border='1' class='formulari'>";
                echo "<tr>";
                ?>
                    <tr class="titols">
                        <td>Codi Curs</td>
                        <td>Nom</td>
                        <td>Descripció</td>
                        <td>Hores</td>
                        <td>Data Inici</td>
                        <td>Data Final</td>
                        <td>DNI Professor</td>
                        <td>Visibilitat</td>
                    </tr>
                <?php
                foreach($valor as $clave1 => $valor1){
                    echo "<td>".$valor1."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }else{}
    }else{
        echo "<form action='gestio_cursos.php' class='buscador' method='POST' name='search'>";
        echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
        echo "<button type='submit'>Buscar</button>";
        echo "</form>";

        if(isset($_SESSION['user'])){
            $conexio = new mysqli('localhost', 'root', '', 'infobdn');
            if($conexio == FALSE){
                mysqli_connect_error();
            }else{
                $sentencia = "SELECT * FROM cursos";
                $sql = "SELECT * FROM cursos as c INNER JOIN professors as p ON c.dni_professor = p.dni_professor WHERE p.visible = true";
                $resultat = mysqli_query($conexio, $sentencia);
                $linies = mysqli_num_rows($resultat);
                ?>
                <h2>Gestió de Cursos</h2>
                <table border="1" class="taula">
                    <tr class="titols">
                        <td>Codi Curs</td>
                        <td>Nom</td>
                        <td>Descripció</td>
                        <td>Hores</td>
                        <td>Data Inici</td>
                        <td>Data Final</td>
                        <td>DNI Professor</td>
                        <td>Editar</td>
                        <td colspan="2">Visibilitat</td>
                    </tr>
                <?php 
                for($i = 0; $i < $linies; $i++){
                    $curs = mysqli_fetch_assoc($resultat);
                    echo "<tr>";
                        echo "<td>".$curs['codi_curs']."</td>";
                        echo "<td>".$curs['nom']."</td>";
                        echo "<td>".$curs['descripcio']."</td>";
                        echo "<td>".$curs['hores']."</td>";
                        echo "<td>".$curs['data_inici']."</td>";
                        echo "<td>".$curs['data_final']."</td>";
                        echo "<td>".$curs['dni_professor']."</td>";
                        echo "<td><a href='editarcurs.php?codi_curs=".$curs['codi_curs']."'><img src='img/lapiz.png' height='40px' width='40px'</a></td>";
                        if($curs['visible']==="1"){
                            echo "<td>Actiu</td>";
                            echo "<td><a href='delcurs.php?id=".$curs['codi_curs']."'><img src='img/pngwing.png' height='40px' width='40px'></a></td>";
                        }else{
                            echo "<td>Inactiu</td>";
                            echo "<td><a href='actcurs.php?id=".$curs['codi_curs']."'><img src='img/pngnowing.png' height='40px' width='40px'></a></td>";
                        }
                    echo "</tr>";
                }
            }
        }else{
            print("Has d'esta validat per veure aquesta pàgina");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:index.php"/>
        <?php
        }
    }
        ?>    
        </table>
        <br></br>
        <div class="alta">
            <a href="alta_cursos.php">Donar d'alta un nou curs</a>
            <br></br>
            <a href="manteniment.php">Tornar enrere</a>
            <br></br>
            <a href="sortir.php">Sortir de la sessió</a>
        </div>
        <footer></footer>
</body>
</html>


