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
    include "funcions.php";
    loginAdmin();
?>
</body>
</html>  