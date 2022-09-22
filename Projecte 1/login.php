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
if(!empty($_POST['usuari']) && !empty($_POST['contrasenya'])){
    $usuari = $_POST['usuari'];
    $contrasenya = $_POST['contrasenya'];
    $passwdmd5 = md5($contrasenya);
        if($usuari == $_POST['usuari'] && $contrasenya == $_POST['contrasenya']){
            $_SESSION['usuari'] =  $usuari; //Creemos una sesión de usuario con el nombre del usuario anteriormente registrado. 
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:cursos.php"/>
            <?php
        }else{
            print("Has d'esta validat per veure aquesta pàgina");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:login.php"/>
        <?php
        }
        
    }else{
        ?>
    <header>
        <a href="index.php"><img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/></a>
        <nav class="nav">
            <a href="alta.php" class="menu">Registra't</a>
            <a href="login.php" class="menu">Inicia Sessió</a>
            <a href="admin.php" class="menu">Manteniment</a>
            <a href="quisom.html" class="menu">Qui som?</a>
        </nav>
    </header>
    <h2>Benvingut/da al portal de cursos d'informàtica!</h2>
    <form action="login.php" method="post" class="formulari">
        <h3>Inicia Sessió:</h3>
        <input type="text" name="nom" placeholder="Usuari" required><br>
        <br>
        <input type="password" placeholder="Contrasenya" required><br>
        <br>
        <input type="submit" name="Enviar" value="Enviar">
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