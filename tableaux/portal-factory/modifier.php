<?php
if (isset($_GET['type'])) {
    if ($_GET['type'] != 'Instructeur' && $_GET['type'] != 'Direction' && $_GET ['type'] != 'Type_ac_ma' && $_GET['type'] != 'Procedure_ac_ma') {
        header('Location:../../index.php');
    } else {
        if (isset($_POST['nom'])) {
            $nom = $_POST['nom'];
            $table = strtolower($_GET['type']);
            $type = $_GET['type'][0] . $_GET['type'][1];
            $id = (int)$_POST['id'];
            $idTable = 'id_' . $type;

            require '../../inc/cnx.inc.php';
            global $pdo;

            if ($_GET['type'] == 'Instructeur') {
                if (isset($_POST['prenom']) && isset($_POST['identifiant']) && isset($_POST['password']) && isset($_POST['role']) && isset($_POST['direction']) && isset($_POST['statut'])) {
                    $prenom = $_POST['prenom'];
                    $identifiant = $_POST['identifiant'];
                    $password = $_POST['password'];
                    $role = $_POST['role'];
                    $direction = $_POST['direction'];
                    $statut = $_POST['statut'];
                    $sql = "UPDATE instructeur SET nom_In = :nom, prenom_In=:prenom, identifiant_In=:identifiant, password_In=:password, role_In=:role,id_Di = :direction, statut_In=:statut WHERE id_In = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':identifiant', $identifiant);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':role', $role);
                    $stmt->bindParam(':direction', $direction);
                    $stmt->bindParam(':statut', $statut);
                } else {
                    header('Location:../../index.php');
                }
            } else {
                $sql = "UPDATE " . $table . " SET nom_" . $type . " = :nom WHERE " . $idTable . " = :id";
                $stmt = $pdo->prepare($sql);
            }
            try {
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':id', $id);
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