<?php session_start();
// Comprovem que s'ha iniciat la sessió:
if (isset($_SESSION["user"])){
    $conexion = mysqli_connect("localhost","root","","infobdn");
    // Comprovem que la sessió sigui correcta:
    if ($conexion == false){
        mysqli_connect_error();
    }else{
        // Recollim les dades guardades:
        $id = $_GET["id"];
        $sql = "UPDATE alumnes SET visible='1' WHERE dni_alumne='$id'";
        // Executem la sentència:
        $consulta = mysqli_query($conexion,$sql);
        // Comprovem si es compleix la sentència:
        if (!$consulta){
            echo mysqli_error($conexion)."<br>";
            echo "Error! Query no valida ".$sql;
        }else{
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=gestio_alumnes.php'>";
        }
    }
}else{
    echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
}
?>