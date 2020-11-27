<?php


class objednavky
{
    static function pridejObjednavku(){
        $conn =connection::getConnection();
        $result = $conn->query("SELECT MAX(id_objednavka) FROM db_dev.objednavka");
        $row = $result->fetch_assoc();
        $maxId = $row["MAX(id_objednavka)"];
        $idZakaznika = $_SESSION["idZakaznika"];
        foreach ($_SESSION["kosik"] as $key=>$value) {
            $nazev = $key;
            $mnozstvi = $value["mnozstvi"];
            $result = $conn->query("SELECT cena FROM db_dev.zbozi WHERE nazev='$nazev'");
            $row = $result->fetch_assoc();
            $cena = $row["cena"];
            $stmt = $conn->prepare("INSERT INTO db_dev.objednavka (id_objednavka,nazev_zbozi,pocet_kusu,cena,id_zakaznika) VALUES($maxId+1,'$nazev','$mnozstvi','$cena'*'$mnozstvi',$idZakaznika)");
            $stmt->execute();
            $stmt->close();
        }
        unset($_SESSION["kosik"]);
    }
    static function vypisObjednavky(){
        $conn =connection::getConnection();
        $idZakaznika = $_SESSION["idZakaznika"];
        $sql = "SELECT id_objednavka,SUM(cena) FROM db_dev.objednavka WHERE id_zakaznika ='$idZakaznika' GROUp BY id_objednavka;";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            while($row = $result->fetch_assoc()) {
                echo '<div id="objednavka">';
                echo 'Objednávka č. ';
                $idObjednavka = $row["id_objednavka"];
                echo '<a href="/Eshop/index.php?page=objednavky&cisloObjednavky='.$row["id_objednavka"].'">'.$idObjednavka.'</a>';
                echo ' -- ';
                echo $row["SUM(cena)"]. " Kč";
                echo '<br>';
                echo'</div>';
            }

        }
    }
    static function vypisDetailObjednavky(){
        $conn =connection::getConnection();
        $cislo = $_GET["cisloObjednavky"];
        $sql = "SELECT * FROM db_dev.objednavka WHERE id_objednavka=$cislo";
        $result = $conn->query($sql);
        $celkovaCastka = 0;
        if($result->num_rows>0){
            echo '<div id="detailObjednavky">';
            while($row = $result->fetch_assoc()) {
                echo $row["nazev_zbozi"];
                echo ', Množství: '.$row["pocet_kusu"];
                echo ', Cena: '.$row["cena"]." Kč".'<br>';
                $celkovaCastka+=$row["cena"];
            }
            echo "Celková částka:".$celkovaCastka." Kč";
            echo'</div>';
        }
    }
}