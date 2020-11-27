<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Košík</title>
    <link rel="stylesheet" href="../css/indexCSS.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>


</body>
</html>

<h1>Košík</h1>
<?php
function pridatZbozi($IdZbozi)
{
        $_SESSION["kosik"][$IdZbozi]["mnozstvi"]++;
}
function odebratZbozi($IdZbozi)
{
    if($_SESSION["kosik"][$IdZbozi]["mnozstvi"]==1){
         odstranitZbozi($IdZbozi);
    }else{
        $_SESSION["kosik"][$IdZbozi]["mnozstvi"]--;
    }
}
function odstranitZbozi($productId)
{
    unset($_SESSION["kosik"][$productId]);
}
if($_GET["akce"]=="pridej"&&!empty($_GET["idZbozi"])){
    pridatZbozi($_GET["idZbozi"]);
    header("Location: /Eshop/index.php?page=kosik");

}
if($_GET["akce"]=="odeber"&&!empty($_GET["idZbozi"])){
    odebratZbozi($_GET["idZbozi"]);
    header("Location: /Eshop/index.php?page=kosik");

}
if($_GET["akce"]=="odstranit"&&!empty($_GET["idZbozi"])){
    odstranitZbozi($_GET["idZbozi"]);
    header("Location: /Eshop/index.php?page=kosik");

}
$conn = connection::getConnection();

if(!empty($_SESSION["kosik"])){
    $celkovaCena = 0;
    echo '<div id=veskereZboziVKosiku>';

foreach ($_SESSION["kosik"] as $key => $value) {
    $result = $conn->query("SELECT cena FROM db_dev.zbozi WHERE nazev='$key'");
    $row = $result->fetch_assoc();
    $cena = $row["cena"] * $value["mnozstvi"];
    echo '<div id=zboziVKosiku>';
    echo '<div id=detailzboziVKosiku>';
    echo $key." -- Mnozstvi: ".$value["mnozstvi"]." -- Cena: $cena";
    echo '</div>';
    echo '<div class="vsechnaTlacitkaKosiku">';
    echo'<a href="index.php?page=kosik&akce=pridej&idZbozi=' . $key . '" ><div class=kosikTlacitko>+</div></a>';
    echo'<a href="index.php?page=kosik&akce=odeber&idZbozi=' . $key . '"><div class=kosikTlacitko>-</div></a>';
    echo'<a href="index.php?page=kosik&akce=odstranit&idZbozi=' . $key . '"><div class=kosikTlacitko>x</div></a>';
    echo '<br>';
    echo '</div>';
    echo '</div>';
    $celkovaCena+=$cena;
}
    echo '</div>';

    echo '<div id="celkovaCena">';
    echo 'Celkova cena objednavky: '.$celkovaCena." Kč";
    echo '</div>';

}else{
    echo '<div id=nepodariloSe>';
    echo "V kosiku nic neni";
    echo '</div>';
}

?>
    <form <?php

    if(!empty($_SESSION["kosik"])) {
        echo 'action="./index.php?page=objednavky"';}
        else{ echo 'action=""';}?>
            method="post">
        <input id="objednatSubmit"     <?php if(empty($_SESSION["kosik"])){ echo 'style="display: none"';} ?>
                type="submit" name="objednavka" value="Objednat">
    </form>
