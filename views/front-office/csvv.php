<?php
// Votre code de connexion à la base de données ici
$dsn = 'mysql:host=localhost;dbname=erp';
$username = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $username, $password);

    // Requête SQL pour récupérer les données des personnels
    $sql = "SELECT cin,nom,prenom,email,titre_poste FROM personnel";
    $stmt = $dbh->query($sql);

    // En-têtes du fichier CSV
    $columnHeader = "CIN, Nom, Prenom, Email, Poste\n";

    // Contenu des données
    $setData = '';
    while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rowData = '';
        foreach ($rec as $value) {
            $value = '"' . $value . '",';
            $rowData .= $value;
        }
        $setData .= trim($rowData) . "\n";
    }

    // Nom du fichier CSV et en-tête HTTP pour le téléchargement
    $filename = "ClickErp.csv";
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=" . $filename);

    // Écrire les en-têtes et les données dans la sortie
    echo $columnHeader . $setData;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
?>
