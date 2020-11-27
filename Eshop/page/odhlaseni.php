<?php
$_SESSION["prihlasen"] = false;
unset($_SESSION["email"]);
unset($_SESSION["objednavky"]);
unset($_SESSION["heslo"]);
unset($_SESSION["idZakaznika"]);

header("Location:/Eshop/index.php?page=katalog");
exit;


