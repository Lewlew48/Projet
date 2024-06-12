<?php
session_start(); // Démarrage de la session

include('cnx.inc.php'); // Inclusion des paramètres de connexion à la base de données
global $pdo;

$no = $_POST['nom']; // Récupération du nom
$pr = $_POST['prenom']; // Récupération du prénom
$id = $_POST['identifiant']; // Récupération de l'identifiant
$dir = $_POST['direction']; // Récupération de la direction

if ($_POST['pwd1'] == $_POST['pwd2']) { // Vérification de la correspondance des mots de passe
    $pw = $_POST['pwd1']; // Récupération du mot de passe

    try {
        $req = "INSERT INTO instructeur (nom_In, prenom_In, identifiant_In, password_In, id_Di) VALUES (?,?,?,?,?,?);"; // Requête SQL
        $traitement = $pdo->prepare($req); // Préparation de la requête

        $traitement->bindValue(1, $no); // Liaison de la valeur pour le nom
        $traitement->bindValue(2, $pr); // Liaison de la valeur pour le prénom
        $traitement->bindValue(3, $id); // Liaison de la valeur pour l'identifiant
        $traitement->bindValue(4, md5($pw)); // Liaison de la valeur pour le mot de passe (après hachage)
        $traitement->bindValue(5, $dir); // Liaison de la valeur pour la direction

        $ok = $traitement->execute(); // Exécution de la requête

        if ($ok) { // Vérification du succès de l'insertion
            $_SESSION['nom'] = $no; // Enregistrement du nom dans la session
            header('location:../erreur.php?err=enregistrement'); // Redirection vers la page d'erreur avec le paramètre 'enregistrement'
        } else {
            header('location:../erreur.php?err=Creation'); // Redirection vers la page d'erreur avec le paramètre 'Creation' en cas d'échec de l'insertion
        }
    } catch (PDOException $e) {
        if ($e->getMessage() == "SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens") { // Vérification de l'erreur spécifique liée au nombre de paramètres
            header('location:../erreur.php?err=identifiant'); // Redirection vers la page d'erreur avec le paramètre 'identifiant' en cas d'erreur de paramètre
        }
    }
} else {
    header('location:../erreur.php?err=pwd'); // Redirection vers la page d'erreur avec le paramètre 'pwd' si les mots de passe ne correspondent pas
}
