<?php
session_start(); // Démarre une nouvelle session

require('cnx.inc.php'); // Inclut le fichier de connexion à la base de données
global $pdo;

$id = $_POST['id']; // Récupère l'ID de l'utilisateur
$pw = md5($_POST['pwd']); // Récupère le mot de passe de l'utilisateur et le hache

try {
    $req = "select * from instructeur i, direction d where i.id_Di=d.id_Di and i.identifiant_In=? and i.password_In=? AND statut_In = 'validé';"; // Prépare la requête SQL pour vérifier si les identifiants fournis correspondent à un utilisateur valide
    $traitement = $pdo->prepare($req); // Prépare la requête pour l'exécution

    $traitement->bindValue(1, $id); // Lie la valeur de l'ID à la requête
    $traitement->bindValue(2, $pw); // Lie la valeur du mot de passe à la requête

    $traitement->execute(); // Exécute la requête préparée

    $resultat = $traitement->fetch(); // Récupère le résultat de la requête

    if ($resultat) { // Si un utilisateur valide a été trouvé
        $_SESSION['nom'] = $resultat['nom_In']; // Stocke le nom de l'utilisateur dans une variable de session
        $_SESSION['prenom'] = $resultat['prenom_In']; // Stocke le prénom de l'utilisateur dans une variable de session
        $_SESSION['role'] = $resultat['role_In']; // Stocke le rôle de l'utilisateur dans une variable de session
        $_SESSION['nom_dir'] = $resultat['nom_Di']; // Stocke le nom de la direction dans une variable de session

        header("Location:../index.php"); // Redirige vers la page d'accueil
    } else {
        $req = "select * from instructeur i, direction d where i.id_Di=d.id_Di and i.identifiant_In=? and i.password_In='' AND statut_In = 'validé';"; // Prépare la requête SQL pour vérifier si l'utilisateur existe mais n'a pas fourni de mot de passe
        $traitement = $pdo->prepare($req); // Prépare la requête pour l'exécution

        $traitement->bindValue(1, $id); // Lie la valeur de l'ID à la requête

        $traitement->execute(); // Exécute la requête préparée

        $resultat2 = $traitement->fetch(); // Récupère le résultat de la requête

        if ($resultat2) { // Si un utilisateur sans mot de passe a été trouvé
            $_SESSION['nom'] = $resultat2['nom_In']; // Stocke le nom de l'utilisateur dans une variable de session
            $_SESSION['prenom'] = $resultat2['prenom_In']; // Stocke le prénom de l'utilisateur dans une variable de session
            $_SESSION['role'] = $resultat2['role_In']; // Stocke le rôle de l'utilisateur dans une variable de session
            $_SESSION['nom_dir'] = $resultat2['nom_Di']; // Stocke le nom de la direction dans une variable de session

            header('location:../panel-utilisateur.php?message=mdp'); // Redirige vers le panneau de l'utilisateur avec un message de mot de passe
        } else {
            header('location:../erreur.php?err=connexion'); // Redirige vers la page d'erreur avec un message d'erreur de connexion
        }
    }
} catch (PDOException $e) { // Si une erreur de base de données se produit
    die("Source : " . $dsn . " Erreur : " . $e->getMessage()); // Affiche un message d'erreur
}
