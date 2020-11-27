<header>
<nav>
    <?php
    echo '<a href="index.php?page=katalog">Katalog zboží</a>';
    echo '<a href="index.php?page=kosik" >Košík</a>';


    if($_SESSION["prihlasen"]){
        echo '<a href="index.php?page=objednavky">Objednávky</a>';
        echo '<a href="index.php?page=odhlaseni">Odhlášení</a>';
    }else{
        echo '<a href="index.php?page=prihlaseni">Přihlášení</a>';
        echo '<a href="index.php?page=registrace">Registrace</a>';
    }
        ?>
</nav>
</header>