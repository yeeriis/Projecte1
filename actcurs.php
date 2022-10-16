<?php session_start();
// Comprovem que la sessió sigui vàlida:
if (isset($_SESSION["user"])){
    $conexion = mysqli_connect("localhost","root","","infobdn");
    // Comprovem que la sessió sigui correcta:
    if ($conexion == false){
        mysqli_connect_error();
    }else{
        // Recollim les dades:
        $id = $_GET["id"];
        $sql = "UPDATE cursos SET visible='1' WHERE codi_curs='$id'";
        // Executem la sentència:
        $consulta = mysqli_query($conexion,$sql);
        // Comprovem si la sentència es compleix:
        if (!$consulta){
            echo mysqli_error($conexion)."<br>";
            echo "Error querry no valida ".$sql;
        }else{
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=gestio_cursos.php'>";
        }
    }
}else{
    echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
}
?>