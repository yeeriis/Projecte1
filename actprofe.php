<?php session_start();
// Comprovem que s'ha iniciat la sessió:
if (isset($_SESSION["user"])){
    $conexion = mysqli_connect("localhost","root","","infobdn");
    // Comprovem que la conexió sigui vàlida:
    if ($conexion == false){
        mysqli_connect_error();
    }else{
        // Recollim les dades:
        $id = $_GET["id"];
        // Creamos la sentencia sql
        $sql = "UPDATE professors SET visible='1' WHERE dni_professor='$id'";
        $consulta = mysqli_query($conexion,$sql);
        // Comprovem si hi ha possibles errors
        if (!$consulta){
            echo mysqli_error($conexion)."<br>";
            echo "Error querry no valida ".$sql;
        }else{
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=gestio_profes.php'>";
        }
    }
}else{
    echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
}
?>