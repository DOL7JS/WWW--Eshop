

<h1>Registrace</h1>;
<?php
$conn = connection::getConnection();

if($_POST){
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(!empty($_POST["email"])&&!empty($_POST["heslo"])){
        $stmtSel = $conn->prepare("SELECT * FROM db_dev.users WHERE email=?");
        $stmtSel->bind_param("s", $_POST["email"]);
        $stmtSel->execute();
        $stmtSel->store_result();
        if($stmtSel->num_rows==0){
            $stmtSel->close();
            $email = $_POST["email"];
            $heslo = $_POST["heslo"];
            $role = "Zakaznik";
            $stmt = $conn->prepare("INSERT INTO db_dev.users (email, password,role) VALUES ('$email', '$heslo','$role')");
            $stmt->execute();
            $stmt->close();
            header("Location:/Eshop/index.php?page=prihlaseni");
        }else{
            $stmtSel->close();
            echo "Zadejte jine jmeno (email)";
        }
    }else{
        echo "</br>Nevyplnil jste email nebo heslo";
    }
}

$conn->close();
?>
<div class="centerForm">
    <form action="/Eshop/index.php?page=registrace" method="post">
    <div class="row"><label>Email: </label><input type="email" name="email"></div>
    <div class="row"><label>Heslo: </label><input type="password" name="heslo"></div>
        <div class="row"><label></label><input type="submit" value="Registrovat"></div>;
        </form>
</div>





