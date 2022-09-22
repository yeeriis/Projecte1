<?php

    session_start();
    session_destroy();
    echo "<p>Redirigint...</p>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
            
?>