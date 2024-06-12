<?php

// Définition du DSN pour la connexion à la base de données
$dsn = "mysql:host=localhost;dbname=intranet;charset=UTF8";
// Définition du nom d'utilisateur pour la connexion à la base de données
$user = 'Intranet';
// Définition du mot de passe pour la connexion à la base de données
$mdp = 'Intranet';

// Tentative de connexion à la base de données
try {
    // Création d'une nouvelle instance de PDO
    $pdo = new PDO($dsn, $user, $mdp);
    // Configuration du mode d'erreur de PDO pour qu'il lance des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} // Gestion des exceptions
catch (PDOException $e) {
    // Affichage du message d'erreur
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
