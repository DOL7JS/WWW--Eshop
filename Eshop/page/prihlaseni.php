
<h1>Přihlášení</h1>
<?php
$conn = connection::getConnection();


if(!empty($_POST["heslo"])&&!empty($_POST["heslo"])){
    $email = $_POST["email"];
    $heslo = $_POST["heslo"];
    $stmt = $conn->prepare("SELECT * FROM db_dev.users WHERE email='$email' AND password='$heslo'");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows()>0){
        $stmt->bind_result($id, $email, $heslo, $role);
        $stmt->fetch();
        $_SESSION["idZakaznika"] = $id;
        $_SESSION["prihlasen"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["heslo"] = $heslo;
        header("Location:/Eshop/index.php?page=katalog");
        exit;
    }else{
        echo "Nespravne udaje";
    }
}

?>
<div class="centerForm">
    <form action="/Eshop/index.php?page=prihlaseni" method="post">
        <div class="row"><label>Email: </label><input type="email" name="email" ></div>
        <div class="row"><label>Heslo: </label><input type="password" name="heslo"></div>
        <div class="row"><label></label><input type="submit" value="Přihlásit" name=""></div>
    </form>
</div>

