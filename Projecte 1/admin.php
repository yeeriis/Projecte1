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
    <title>Login Admin</title>
</head>
<body>
<?php
    if(!empty($_POST['usuari']) && !empty($_POST['contrasenya'])){
        $Nomusuari = $_POST['usuari'];
        $PasUsuari = $_POST['contrasenya'];
        $passwdmd5 = md5($PasUsuari);
        if($Nomusuari == "admin" && $PasUsuari == "admin"){
            $_SESSION['user'] =  $Nomusuari;
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http:manteniment.php"/>
            <p>Redirigint...</p>
            <?php
        }else{
            print("Has d'esta validat per veure aquesta pàgina");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http:index.php"/>
        <?php
        }
    }else{
        ?>
        <header>
            <img src="img/logo-infobdn.svg" alt="logo infobdn" class="logo"/>
            <nav class="nav">
                <a href="alta.php" class="menu">Registra't</a>
                <a href="login.php" class="menu">Inicia Sessió</a>
                <a href="admin.php" class="menu">Manteniment</a>
                <a href="quisom.html" class="menu">Qui som?</a>
            </nav>
        </header>
    <br>
    <form name="formulari" method="POST" action="admin.php" class="formulari" >
        <h3>Manteniment Admin</h3>
        <input type="text"  name="usuari" maxlength="15" id = "usuari" placeholder="User" required/>
        <br/>
        <br/>
        <input type="password"  maxlength="15" id = "contrasenya" name="contrasenya" placeholder="Contrasenya" required />
        <br/>
        <br/>
        <input type="submit" name="subir" value="Enviar"/>
        <br/>
        <br/>
    </form>
    <footer></footer>
<?php
    }
?> 
</body>
</html>  