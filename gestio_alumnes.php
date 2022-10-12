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
    <title>Gestió d'Alumnes</title>
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
        echo "<form action='gestio_alumnes.php' class='buscador' method='POST' name='search'>";
        echo "Necessites buscar algun alumne? <input type='text' id='search' name='search' placeholder='Buscar'/>";
        echo "<button type='submit'>Buscar</button>";
        echo "</form>";
            $conexio2 = mysqli_connect('localhost','root','','infobdn');
            $filtro = $_POST['search'];
            $sentencia2 = "SELECT dni_alumne, nom, cognoms, edat, correu FROM alumnes WHERE nom LIKE '%$filtro%'";
            if($resultat2 = mysqli_query($conexio2, $sentencia2)){
                while($fila = $resultat2 -> fetch_assoc()){
                    $llista[] = $fila;
                }
            } 
            echo "<h2>Gestió d'Alumnes</h2>";
            echo "<table class='taula' border='1'>";
            echo "<tr>";            
            ?>
                <tr class="titols">
                    <td>DNI</td>
                    <td>Nom</td>
                    <td>Cognoms</td>
                    <td>Edat</td>
                    <td>Correu</td>
                </tr>
            <?php
            foreach($llista as $clave => $valor){
                foreach($valor as $clave1 => $valor1){
                    echo "<td>".$valor1."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
    }else{
            echo "<form action='gestio_alumnes.php' class='buscador' method='POST' name='search'>";
            echo "Necessites buscar algun alumne? <input type='text' id='search' name='search' placeholder='Buscar'/>";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";

            if(isset($_SESSION['user'])){
                $conexio = new mysqli('localhost', 'root', '', 'infobdn');
                if($conexio == FALSE){
                    mysqli_connect_error();
                }else{
                    $sentencia = "SELECT * FROM alumnes";
                    $resultat = mysqli_query($conexio, $sentencia);
                    $linies = mysqli_num_rows($resultat);
                    ?>
                    <h2>Gestió d'Alumnes</h2>
                    <table border="1" class="taula">
                        <tr class="titols">
                            <td>DNI</td>
                            <td>Nom</td>
                            <td>Cognoms</td>
                            <td>Edat</td>
                            <td>Fotografia</td>
                            <td>Correu</td>
                            <td>Editar</td>
                            <td>Editar Foto</td>
                            <td colspan="2">Visibilitat<td>
                        </tr>
                    <?php 
                    for($i = 0; $i < $linies; $i++){
                        $alumne = mysqli_fetch_assoc($resultat);
                        echo "<tr>";
                            echo "<td>".$alumne['dni_alumne']."</td>";
                            echo "<td>".$alumne['nom']."</td>";
                            echo "<td>".$alumne['cognoms']."</td>";
                            echo "<td>".$alumne['edat']."</td>";
                            echo "<td><img src=".$alumne['fotografia']." class='photo' height='50px'></td>";
                            echo "<td>".$alumne['correu']."</td>";
                            echo "<td><a href='editaralumne.php?dni_alumne=".$alumne['dni_alumne']."'><img src='img/lapiz.png' height='40px' width='40px'</a></td>";
                            echo "<td><a href='editarfotoalum.php?dni_alumne=".$alumne['dni_alumne']."&oldfoto=".$alumne['fotografia']."'><img src='img/editfoto.png' height='40px' width='40px'</a></td>";
                            if($alumne['visible']==="1"){
                                echo "<td>Actiu</td>";
                                echo "<td><a href='delalumne.php?id=".$alumne['dni_alumne']."'><img src='img/pngwing.png' height='40px' width='40px'></a></td>";
                            }else{
                                echo "<td>Inactiu</td>";
                                echo "<td><a href='actalumne.php?id=".$alumne['dni_alumne']."'><img src='img/pngnowing.png' height='40px' width='40px'></a></td>";
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
            <a href="manteniment.php">Tornar enrere</a>
            <br></br>
            <a href="sortir.php">Sortir de la sessió</a>
        </div>
        <footer></footer>
</body>
</html>