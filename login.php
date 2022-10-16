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
    <title>Login usuaris</title>
</head>
<body>
<?php

    $conexio = mysqli_connect("localhost","root","","infobdn");
    if($_POST){
        if ($conexio == false){
            mysqli_connect_error();
        }else{
            
            $dni = $_POST['usuari'];
            $contrasenya = $_POST['password'];
            $passwdmd5 = md5($contrasenya);
            $tipus = $_POST['select'];


            if($tipus == "prof"){
                $sql = "SELECT * FROM professors WHERE dni_professor= '$dni' AND contrasenya= '$passwdmd5'";
                $consulta = mysqli_query($conexio,$sql);
                $linies = mysqli_num_rows($consulta);
                $usuario = mysqli_fetch_assoc($consulta);
                if($linies == 1){
                    $_SESSION['dni_professor'] = $dni;
                    $_SESSION['rol'] = $tipus;
                    $_SESSION['nom'] = $usuario['nom'];
                    $_SESSION['dni_professor'] = $usuario['dni_professor'];
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=http:cursosprof.php'/>";
                }
                else{
                    echo "Error!";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=http:index.php'/>";

                }
            }else{
                $sql = "SELECT * FROM alumnes WHERE dni_alumne= '$dni' AND contrasenya= '$passwdmd5'";
                $consulta = mysqli_query($conexio,$sql);
                $linies = mysqli_num_rows($consulta);
                $usuario = mysqli_fetch_assoc($consulta);
                if($linies == 1){
                    $_SESSION['dni_alumne'] = $dni;
                    $_SESSION['rol'] = $tipus;
                    $_SESSION['nom'] = $usuario['nom'];
                    $_SESSION['dni_alumne'] = $usuario['dni_alumne'];
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=http:cursosalum.php'/>";
                }
                else{
                    echo "Error!";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=http:index.php'/>";

                }
            }
        }
    }else{
    ?>
    <header>
        <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
            <a href="alta.php" class="menu">Registra't</a>
            <a href="admin.php" class="menu">Manteniment</a>
        </nav>
    </header>
    <h2>Benvingut/da al portal de cursos d'informàtica!</h2>
    <form name="formulari" action="login.php" method="POST" class="formulari">
        <h3>Inicia Sessió:</h3>
        <input type="text" name="usuari" placeholder="Usuari" class="invisible" required><br>
        <br>
        <input type="password" name="password" placeholder="Contrasenya" class="invisible" required><br>
        <br>
        Professor: <input type="radio"  maxlength="15" id="professor" name="select" value="prof" required/>
        <br/>
        Alumne: <input type="radio"  maxlength="15" id="alumne" name="select" value="alum" required/>
        <br/>
        <br/>
        <input type="submit" clasS='button label' name="Enviar" value="Enviar">
        <br>
        <p>No estàs registrat? Clica <a href="alta.php">aquí</a></p>
    </form>
    <footer>
    </footer>
    <?php
    }
    ?>
</body>
</html>