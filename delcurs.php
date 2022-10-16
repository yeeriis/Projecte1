<?php session_start();
if (isset($_SESSION["user"])){
    $conexion = mysqli_connect("localhost","root","","infobdn");
    if ($conexion == false){
        mysqli_connect_error();
    }else{
        $id = $_GET["id"];
        $sql = "UPDATE cursos SET visible='0' WHERE codi_curs='$id'";
        $consulta = mysqli_query($conexion,$sql);
        if (!$consulta){
            echo mysqli_error($conexion)."<br>";
            echo "Error querry no valida ".$sql;
        }else{
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=gestio_cursos.php'>";
        }
    }
}else{
    echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
}
?>