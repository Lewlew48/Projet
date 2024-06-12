<?php
if (isset($_GET['type'])) {
    if ($_GET['type'] != 'Accords_cadres' && $_GET['type'] != 'Arrete' && $_GET['type'] != 'Convention' && $_GET['type'] != 'Marche' && $_GET['type'] != 'Instructeur' && $_GET['type'] != 'Direction' && $_GET ['type'] != 'Type_ac_ma' && $_GET['type'] != 'Procedure_ac_ma') {
        header('Location:../../index.php');
    } else {
        $table = strtolower($_GET['type']);
        $type = $_GET['type'][0] . $_GET['type'][1];
        $id = (int)$_POST['id'];
        $idTable = 'id_' . $type;

        try {
            require '../../../inc/cnx.inc.php';
            global $pdo;
            $sql = "DELETE FROM " . $table . " WHERE " . $idTable . " = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
} else {
    header('Location:../../index.php');
}