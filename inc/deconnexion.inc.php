<?php
// Démarrage de la session
session_start();

// Suppression des variables de session spécifiques
unset(
    $_SESSION['nom'],      // Suppression du nom
    $_SESSION['prenom'],   // Suppression du prénom
    $_SESSION['role'],     // Suppression du rôle
    $_SESSION['nom_dir']   // Suppression du nom de la direction
);

// Redirection vers la page d'accueil
header("location:../index.php");
