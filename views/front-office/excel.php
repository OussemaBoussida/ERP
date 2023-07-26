<?php

$dsn = 'mysql:host=localhost;dbname=erp';
$username = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $username, $password);

    $sql = "SELECT cin,nom,prenom,email,titre_poste FROM personnel";
    $stmt = $dbh->query($sql);

    
    $columnHeader = "\tCIN\tNom\tPrenom\tEmail\tPoste";

    $setData = '';
    while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rowData = '';
        foreach ($rec as $value) {
            $value = '"' . $value . '"' . "\t";
            $rowData .= $value;
        }
        $setData .= " " . "\t" . trim($rowData) . "\n";
    }

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=ClickErp.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo ucwords(" " . "\n" . $columnHeader . "\n" . $setData . "\n");
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
?>
