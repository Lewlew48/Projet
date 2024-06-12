<?php
require('inc/cnx.inc.php'); // Inclut les paramètres de connexion à la base de données
global $pdo; // Déclare $pdo comme une variable globale

try {
    $req = "select * from direction;"; // Prépare une requête SQL pour sélectionner toutes les lignes de la table 'direction'

    $traitement = $pdo->prepare($req); // Prépare la requête pour l'exécution

    $traitement->execute(); // Exécute la requête

    $lignes = $traitement->fetchAll(PDO::FETCH_ASSOC); // Récupère toutes les lignes du résultat de la requête
    foreach ($lignes as $ligne) { // Parcourt chaque ligne du résultat
        echo '<option value="' . $ligne['id_Di'] . '">' . $ligne['nom_Di'] . '</option>'; // Génère une option pour un élément de liste déroulante pour chaque ligne
    }

} catch (PDOException $e) { // Attrape les exceptions PDOException
    die("Source : " . $dsn . " Erreur : " . $e->getMessage()); // Affiche le message d'erreur
}
