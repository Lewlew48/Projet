<?php

// Vérifier si le paramètre 'type' est défini dans la requête GET
if (isset($_GET['type'])) {

    // Vérifier si le type est valide
    if ($_GET['type'] != 'Accords_cadres' && $_GET['type'] != 'Arrete' && $_GET['type'] != 'Convention' && $_GET['type'] != 'Marche' && $_GET['type'] != 'Instructeur' && $_GET['type'] != 'Direction' && $_GET ['type'] != 'Type_ac_ma' && $_GET['type'] != 'Procedure_ac_ma') {

        // Rediriger vers la page d'accueil si le type n'est pas valide
        header('Location:../../index.php');
    } else {
        // Récupérer le nom de la table en convertissant en minuscules
        $table = strtolower($_GET['type']);

        // Récupérer les deux premières lettres du type
        $type = $_GET['type'][0] . $_GET['type'][1];

        // Convertir l'ID en entier
        $id = (int)$_POST['id'];

        // Construire le nom de la colonne ID
        $idTable = 'id_' . $type;

        try {
            // Inclure le fichier de connexion à la base de données
            require '../../../inc/cnx.inc.php';
            global $pdo;

            // Préparer et exécuter la requête de suppression
            $sql = "DELETE FROM " . $table . " WHERE " . $idTable . " = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            // Afficher l'erreur s'il y en a une
            echo "Erreur : " . $e->getMessage();
        }

        // Rediriger vers la page précédente
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
} else {
    // Rediriger vers la page d'accueil si le paramètre 'type' n'est pas défini
    header('Location:../../index.php');
}
