<?php
$serveur = "localhost";
$utilisateur = "root";
$baseDeDonnees = "archi_bdd";

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $motDePasse = "";
} else {
    $motDePasse = "root";
}

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}
?>
