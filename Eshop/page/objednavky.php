<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Objednávky</title>
    <link rel="stylesheet" href="../css/indexCSS.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<?php
if(!$_SESSION["prihlasen"]){
    echo '<div id=nepodariloSe>';
    echo "Nejste prihlasen, pro nakup se nejdrive prihlaste";
    echo '</div>';

    return;
}
echo '<h1>Objednávky</h1>';
$conn = connection::getConnection();


if(!empty($_POST["objednavka"])&&!empty($_SESSION["kosik"])){

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    objednavky::pridejObjednavku();
}
objednavky::vypisObjednavky();


if(!empty($_GET["cisloObjednavky"])){
    objednavky::vypisDetailObjednavky();
}
?>
</body>
</html>
