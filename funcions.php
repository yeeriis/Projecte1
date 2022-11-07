<?php
    function menuProfe(){
        ?>
        <header>
        <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
            <a href="admin.php" class="menu">Manteniment</a>
        </nav>
        <p  id="nomprof">Benvingut/da, <?php echo $_SESSION['nom']; ?></p>

    </header>
    <br>
    <?php
    }

    function loginAdmin(){
        if(!empty($_POST['usuari']) && !empty($_POST['contrasenya'])){
            $Nomusuari = $_POST['usuari'];
            $PasUsuari = $_POST['contrasenya'];
            $passwdmd5 = md5($PasUsuari);
            if($Nomusuari == "admin" && $PasUsuari == "admin"){
                $_SESSION['user'] =  $Nomusuari;
                echo "<p style='color:white;'>Redirigint...</p>";
                ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:manteniment.php"/>
                <?php
            }else{
                echo "<p style='color:white;'>Has d'estar validat per veure aquesta pàgina</p>";
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:index.php"/>
            <?php
            }
        }else{
            ?>
            <header>
                <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
                <nav class="nav">
                    <a href="alta.php" class="menu">Registra't</a>
                    <a href="login.php" class="menu">Inicia Sessió</a>
                </nav>
            </header>
        <br>
        <form name="formulari" method="POST" action="admin.php" class="formulari" >
            <h3>Manteniment Admin</h3>
            <input type="text"  name="usuari" maxlength="15" id = "usuari" placeholder="Usuari" required class="invisible"/>
            <br/>
            <br/>
            <input type="password"  maxlength="15" id = "contrasenya" name="contrasenya" placeholder="Contrasenya" required class="invisible" />
            <br/>
            <br/>
            <input type="submit" class='label button' name="subir" value="Enviar"/>
            <br/>
            <br/>
        </form>
    <?php
        }
    }

    function cursProfBuscador(){
        $dni = $_SESSION['dni_professor'];

        echo "<form action='cursosprof.php' class='buscador' method='POST' name='search'>";
            echo "Necessites buscar algun curs? <input type='text' id='search' name='search' placeholder='Buscar'/>";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";
            $conexio2 = mysqli_connect('localhost','root','','infobdn');
            $filtro = $_POST['search'];

            $sentencia2 = "SELECT * FROM cursos WHERE nom LIKE '%$filtro%' and visible = 1 and dni_professor = $dni";
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
                echo "<tr style='color:white;'>";
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
            <?php
    }

    function cursProf(){
        $dni = $_SESSION['dni_professor'];

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
                    echo "<tr style='color:white;'>";
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
                <?php
            }
    }


    function altaCurs(){
        $conexio = mysqli_connect("localhost","root","","infobdn");


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

    function altaProfe(){

        $conexio = mysqli_connect("localhost","root","","infobdn");

        $dni_professor = $_POST['dni_professor'];
        $nom = $_POST['nom'];
        $cognoms = $_POST['cognoms'];
        $titol_academic = $_POST['titol_academic'];
        $visible = $_POST['visible'];
        $PasUsuari = $_POST['contrasenya'];
        $contrasenya = md5($PasUsuari);
        
        if(is_uploaded_file ($_FILES['foto']['tmp_name'])){
            $nombreDirectorio = "imgprofes/";
            $idUnico = $dni_professor;
            $nombreorigen = $_FILES['foto']['name'];
            $contingutnom = explode(".",$nombreorigen);
            $extension = $contingutnom[1]; 
            $nombreFichero = $nombreDirectorio.$idUnico.".".$extension;
            move_uploaded_file ($_FILES['foto']['tmp_name'],$nombreFichero);

            $sql = "INSERT INTO professors VALUES ('$dni_professor', '$nom', '$cognoms', '$titol_academic', '$nombreFichero', '$visible' , '$contrasenya')";
            $consulta = mysqli_query($conexio,$sql);
            if(!$consulta){
                echo mysqli_error($conexio)."<br>"; 
                echo "Error! Query no vàlida ".$sql;    
            }else{
                echo "Usuari creat correctament!";
                echo "<br>";
                echo "Redirigint...";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=gestio_profes.php'>";
            }  
        }else{
            print ("No se ha podido subir el fichero\n");
        }
    }

?>