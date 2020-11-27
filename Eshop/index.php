<?php
session_start();
if(empty($_GET["akce"])){
    $_GET["akce"] = "";
}
if(empty($_GET["page"])){
    $_GET["page"] = "";
}
if(empty($_SESSION["prihlasen"])){
    $_SESSION["prihlasen"] = false;
}

require_once "classes/connection.php";
require_once "classes/objednavky.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/indexCSS.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php

include "menu.php";
?>
<?php
$pathToFile = "./page/".$_GET["page"].".php";
if(file_exists($pathToFile)){
    include $pathToFile;
}else{
    include "./page/katalog.php";
}
?>

<?php
include "footer.php"
?>


</body>
</html>