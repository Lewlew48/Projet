<?php
session_start(); // Démarre une nouvelle session

include('cnx.inc.php'); // Inclut le fichier de connexion à la base de données
global $pdo;
global $dsn;

$id = $_POST['id']; // Récupère l'ID de l'utilisateur
$no = $_POST['nom']; // Récupère le nom de l'utilisateur
$pr = $_POST['prenom']; // Récupère le prénom de l'utilisateur
$identifiant = $_POST['identifiant']; // Récupère l'identifiant de l'utilisateur

if ($_POST['pwd1'] == $_POST['pwd2']) { // Vérifie si les deux mots de passe sont identiques
    $pw = $_POST['pwd1']; // Si oui, récupère le mot de passe

    try {
        $req = "UPDATE instructeur SET nom_In=?, prenom_In=?, identifiant_In=?, password_In=? WHERE id_In=?;"; // Prépare la requête SQL pour mettre à jour les informations de l'utilisateur
        $traitement = $pdo->prepare($req); // Prépare la requête pour l'exécution

        $traitement->bindValue(1, $no); // Lie la valeur du nom à la requête
        $traitement->bindValue(2, $pr); // Lie la valeur du prénom à la requête
        $traitement->bindValue(3, $identifiant); // Lie la valeur de l'identifiant à la requête
        $traitement->bindValue(4, md5($pw)); // Lie la valeur du mot de passe (haché) à la requête
        $traitement->bindValue(5, $id); // Lie la valeur de l'ID à la requête

        $ok = $traitement->execute(); // Exécute la requête préparée

        if ($ok) { // Si la requête a réussi
            $_SESSION['nom'] = $no; // Met à jour le nom dans la session
            $_SESSION['prenom'] = $pr; // Met à jour le prénom dans la session
            header('location:../index.php'); // Redirige vers la page d'accueil
        } else { // Si la requête a échoué
            header('location:../erreur.php?err=Creation'); // Redirige vers la page d'erreur
        }
    } catch (PDOException $e) { // Si une erreur de base de données se produit
        die("Source : " . $dsn . " Erreur : " . $e->getMessage()); // Affiche un message d'erreur
    }

} else { // Si les mots de passe ne sont pas identiques
    header('location:../erreur.php?err=pwd'); // Redirige vers la page d'erreur
}