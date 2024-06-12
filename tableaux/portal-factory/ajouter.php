<?php
if (isset($_GET['type'])) {
    if ($_GET['type'] != 'Instructeur' && $_GET['type'] != 'Direction' && $_GET ['type'] != 'Type_ac_ma' && $_GET['type'] != 'Procedure_ac_ma') {
        header('Location:../../index.php');
    } else {
        if (isset($_POST['nom'])) {
            $nom = $_POST['nom'];
            $table = strtolower($_GET['type']);
            $type = $_GET['type'][0] . $_GET['type'][1];
            $idTable = 'id_' . $type;

            require '../../inc/cnx.inc.php';
            global $pdo;

            if ($_GET['type'] == 'Instructeur') {
                if (isset($_POST['prenom']) && isset($_POST['identifiant']) && isset($_POST['role']) && isset($_POST['direction']) && isset($_POST['statut'])) {
                    $prenom = $_POST['prenom'];
                    $identifiant = $_POST['identifiant'];
                    $role = $_POST['role'];
                    $direction = $_POST['direction'];
                    $statut = $_POST['statut'];
                    $sql = "INSERT INTO instructeur(nom_In, prenom_In, identifiant_In, role_In, id_Di,statut_In) VALUES (:nom, :prenom, :identifiant, :role, :direction, :statut)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':identifiant', $identifiant);
                    $stmt->bindParam(':role', $role);
                    $stmt->bindParam(':direction', $direction);
                    $stmt->bindParam(':statut', $statut);
                } else {
                    header('Location:../../index.php');
                }
            } else {
                $sql = "INSERT INTO " . $table . "(nom_" . $type . ") VALUES(:nom)";
                $stmt = $pdo->prepare($sql);
            }
            try {
                $stmt->bindParam(':nom', $nom);
                $stmt->execute();

            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location:../../index.php');
        }
    }

} else {
    header('Location:../../index.php');
}