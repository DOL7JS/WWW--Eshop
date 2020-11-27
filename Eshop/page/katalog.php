<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Košík</title>
    <link rel="stylesheet" href="../css/indexCSS.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<h1>Katalog</h1>

<?php
function pridatDoKosiku($nazevZbozi)
{
    if (!array_key_exists($nazevZbozi, $_SESSION["kosik"])) {
        $_SESSION["kosik"][$nazevZbozi]["mnozstvi"] = 1;
    } else {
        $_SESSION["kosik"][$nazevZbozi]["mnozstvi"]++;
    }
}
?>
<?php
if($_GET["akce"]=="pridej"&&!empty($_GET["nazevZbozi"])){
    pridatDoKosiku($_GET["nazevZbozi"]);
    header("Location: /Eshop/index.php?page=katalog");
}

$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
;
$sql = "SELECT * FROM db_dev.zbozi";
$result = $conn->query($sql);
if($result->num_rows>0){
    $doKose = "Do kosiku";
    echo '<div id="veskereZbozi">';
    while($row = $result->fetch_assoc()) {
        echo '<div id="zbozi">';
        echo '<tr><td> <img width="200"  src='.$row["obrazek"].'> </td>
        <section id="textZbozi">
        <div><td> '.$row["nazev"].'</td></div>
        <div><td>'.$row["cena"]." Kč".'</td></div>
        </section>
        <a href="index.php?page=katalog&akce=pridej&nazevZbozi='.$row["nazev"].'"><td>'.$doKose.'</td></a>
        <br>
         </tr>';
        echo '</div>';
    }
     echo '</div>';


}
?>

</body>
</html>


