<?php session_start();
// Comprobamos que hemos iniciado la session
if (isset($_SESSION["user"])){
    // Creamos la conexion a la bdd
    $conexion = mysqli_connect("localhost","root","","infobdn");
    // Comprobamos que la conexion sea valida
    if ($conexion == false){
        mysqli_connect_error();
    }else{
        // Recogemos los datos guardados en las variables de session en variables locales
        $id = $_GET["id"];
        // Creamos la sentencia sql
        $sql = "UPDATE alumnes SET visible='1' WHERE dni_alumne='$id'";
        // Ejecutamos la sentencia
        $consulta = mysqli_query($conexion,$sql);
        // Controlamos posibles errores
        if (!$consulta){
            echo mysqli_error($conexion)."<br>";
            echo "Error! Query no valida ".$sql;
        }else{
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=gestio_alumnes.php'>";
        }
    }
}else{
    // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
    echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
}
?>