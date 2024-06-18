<?php

include "../../inc/cnx.inc.php"; // Inclut le fichier de connexion à la base de données

function fetchArretes($mois, $annee, $sql, $count, $param) // Définit une fonction pour récupérer les arrêtés
{
    $req = 'SELECT * FROM arrete a, direction d, instructeur i 
        WHERE a.id_In = i.id_In 
        AND i.id_Di = d.id_Di'; // Prépare la requête SQL pour récupérer les arrêtés
    if ($sql == '') {
        if ($mois != "") {
            $req .= ' AND MONTH(dateCreation_Ar) = :mois'; // Ajoute une condition pour filtrer par mois
        }
        $req .= ' AND YEAR(dateCreation_Ar) = :annee'; // Ajoute une condition pour filtrer par année
    }
    global $pdo; // Rend la variable $pdo globale

    $req .= $sql;
    $req .= " GROUP BY a.id_Ar order by a.dateCreation_Ar desc, a.id_Ar desc;"; // Ajoute des conditions supplémentaires à la requête
    $stmt = $pdo->prepare($req); // Prépare la requête pour l'exécution
    if ($sql == '') {
        if ($mois != "") {
            $stmt->bindParam(':mois', $mois); // Lie la valeur du mois à la requête
        }
        $stmt->bindParam(':annee', $annee); // Lie la valeur de l'année à la requête
    }
    if ((int)$count > 0) {
        $stmt->bindParam(':query', $param); // Lie la valeur du paramètre à la requête
    }
    $stmt->execute(); // Exécute la requête

    $arretes = array(); // Initialise un tableau pour stocker les arrêtés

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Parcourt les résultats de la requête
        if ($row['attributaire_Ar'] == NULL) {
            $attributaire = 'NR'; // Si l'attributaire est NULL, assigne 'NR'
        } else {
            $attributaire = $row['attributaire_Ar']; // Sinon, assigne la valeur de l'attributaire
        }
        if ($row['chapitre_Ar'] == NULL) {
            $chapitre = 'NR'; // Si le chapitre est NULL, assigne 'NR'
        } else {
            $chapitre = $row['chapitre_Ar']; // Sinon, assigne la valeur du chapitre
        }
        if ($row['article_Ar'] == NULL) {
            $article = 'NR'; // Si l'article est NULL, assigne 'NR'
        } else {
            $article = $row['article_Ar']; // Sinon, assigne la valeur de l'article
        }
        if ($row['divers_Ar'] == NULL) {
            $divers = 'NR'; // Si divers est NULL, assigne 'NR'
        } else {
            $divers = $row['divers_Ar']; // Sinon, assigne la valeur de divers
        }
        if ($row['annule_Ar'] == 0) {
            $annule = 'Non'; // Si annulé est 0, assigne 'Non'
        } else {
            $annule = 'Oui'; // Sinon, assigne 'Oui'
        }
        if ($row['prive_Ar'] == 0) {
            $prive = 'Non'; // Si privé est 0, assigne 'Non'
        } else {
            $prive = 'Oui'; // Sinon, assigne 'Oui'
        }
        $arretes[] = array( // Ajoute un nouvel arrêté au tableau
            'id' => $row['id_Ar'],
            'dateCreation' => $row['dateCreation_Ar'],
            'libelle' => $row['libelle_Ar'],
            'attributaire' => $attributaire,
            'chapitre' => $chapitre,
            'article' => $article,
            'divers' => $divers,
            'montant' => $row['montant_Ar'],
            'annule' => $annule,
            'prive' => $prive,
            'direction' => $row['nom_Di'],
            'instructeur' => ucfirst($row['prenom_In']) . ' ' . strtoupper($row['nom_In'])
        );
    }

    return $arretes; // Retourne le tableau d'arrêtés
}


function fetchConventions($mois, $annee, $sql, $count, $param) // Définit une fonction pour récupérer les conventions
{
    $req = 'SELECT * FROM convention c, direction d, instructeur i 
        WHERE c.id_In = i.id_In 
        AND i.id_Di = d.id_Di'; // Prépare la requête SQL pour récupérer les conventions
    if ($sql == '') {
        if ($mois != "") {
            $req .= ' AND MONTH(dateCreation_Co) = :mois'; // Ajoute une condition pour filtrer par mois
        }
        $req .= ' AND YEAR(dateCreation_Co) = :annee'; // Ajoute une condition pour filtrer par année
    }
    global $pdo; // Rend la variable $pdo globale

    $req .= " " . $sql;
    $req .= " GROUP BY id_Co order by dateCreation_Co desc, id_Co desc;"; // Ajoute des conditions supplémentaires à la requête
    $stmt = $pdo->prepare($req); // Prépare la requête pour l'exécution
    if ($sql == '') {
        if ($mois != "") {
            $stmt->bindParam(':mois', $mois); // Lie la valeur du mois à la requête
        }
        $stmt->bindParam(':annee', $annee); // Lie la valeur de l'année à la requête
    }
    if ((int)$count > 0) {
        $stmt->bindParam(':query', $param); // Lie la valeur du paramètre à la requête
    }
    $stmt->execute(); // Exécute la requête

    $conventions = array(); // Initialise un tableau pour stocker les conventions

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Parcourt les résultats de la requête
        if ($row['attributaire_Co'] == NULL) {
            $attributaire = 'NR'; // Si l'attributaire est NULL, assigne 'NR'
        } else {
            $attributaire = $row['attributaire_Co']; // Sinon, assigne la valeur de l'attributaire
        }
        if ($row['chapitre_Co'] == NULL) {
            $chapitre = 'NR'; // Si le chapitre est NULL, assigne 'NR'
        } else {
            $chapitre = $row['chapitre_Co']; // Sinon, assigne la valeur du chapitre
        }
        if ($row['article_Co'] == NULL) {
            $article = 'NR'; // Si l'article est NULL, assigne 'NR'
        } else {
            $article = $row['article_Co']; // Sinon, assigne la valeur de l'article
        }
        if ($row['divers_Co'] == NULL) {
            $divers = 'NR'; // Si divers est NULL, assigne 'NR'
        } else {
            $divers = $row['divers_Co']; // Sinon, assigne la valeur de divers
        }
        if ($row['annule_Co'] == 0) {
            $annule = 'Non'; // Si annulé est 0, assigne 'Non'
        } else {
            $annule = 'Oui'; // Sinon, assigne 'Oui'
        }
        if ($row['prive_Co'] == 0) {
            $prive = 'Non'; // Si privé est 0, assigne 'Non'
        } else {
            $prive = 'Oui'; // Sinon, assigne 'Oui'
        }
        $conventions[] = array( // Ajoute une nouvelle convention au tableau
            'id' => $row['id_Co'],
            'dateCreation' => $row['dateCreation_Co'],
            'libelle' => $row['libelle_Co'],
            'attributaire' => $attributaire,
            'chapitre' => $chapitre,
            'article' => $article,
            'divers' => $divers,
            'montant' => $row['montant_Co'],
            'annule' => $annule,
            'prive' => $prive,
            'direction' => $row['nom_Di'],
            'instructeur' => ucfirst($row['prenom_In']) . ' ' . strtoupper($row['nom_In'])
        );
    }

    return $conventions; // Retourne le tableau de conventions
}


function fetchAccords($mois, $annee, $sql, $count, $param) // Définit une fonction pour récupérer les accords
{
    global $pdo; // Rend la variable $pdo globale
    $req = 'SELECT * FROM accords_cadres a, direction d, instructeur i, procedure_ac_ma, type_ac_ma WHERE a.id_In = i.id_In 
                                               AND i.id_Di = d.id_Di
                                               AND a.id_Ty = type_ac_ma.id_Ty
                                               AND a.id_Pr = procedure_ac_ma.id_Pr'; // Prépare la requête SQL pour récupérer les accords
    if ($sql == '') {
        if ($mois != "") {
            $req .= ' AND MONTH(dateCreation_Ac) = :mois'; // Ajoute une condition pour filtrer par mois
        }
        $req .= ' AND YEAR(dateCreation_Ac) = :annee'; // Ajoute une condition pour filtrer par année
    }
    global $pdo; // Rend la variable $pdo globale

    $req .= " " . $sql;
    $req .= " GROUP BY a.id_Ac order by a.dateCreation_Ac desc, a.id_Ac desc;"; // Ajoute des conditions supplémentaires à la requête
    $stmt = $pdo->prepare($req); // Prépare la requête pour l'exécution
    if ($sql == '') {
        if ($mois != "") {
            $stmt->bindParam(':mois', $mois); // Lie la valeur du mois à la requête
        }
        $stmt->bindParam(':annee', $annee); // Lie la valeur de l'année à la requête
    }
    if ((int)$count > 0) {
        $stmt->bindParam(':query', $param); // Lie la valeur du paramètre à la requête
    }
    $stmt->execute(); // Exécute la requête

    $accords = array(); // Initialise un tableau pour stocker les accords

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Parcourt les résultats de la requête
        if ($row['attributaire_Ac'] == NULL) {
            $attributaire = 'NR'; // Si l'attributaire est NULL, assigne 'NR'
        } else {
            $attributaire = $row['attributaire_Ac']; // Sinon, assigne la valeur de l'attributaire
        }
        if ($row['annule_Ac'] == 0) {
            $annule = 'Non'; // Si annulé est 0, assigne 'Non'
        } else {
            $annule = 'Oui'; // Sinon, assigne 'Oui'
        }
        if ($row['prive_Ac'] == 0) {
            $prive = 'Non'; // Si privé est 0, assigne 'Non'
        } else {
            $prive = 'Oui'; // Sinon, assigne 'Oui'
        }
        $accords[] = array( // Ajoute une nouvelle accord au tableau
            'id' => $row['id_Ac'],
            'dateCreation' => $row['dateCreation_Ac'],
            'libelle' => $row['libelle_Ac'],
            'attributaire' => $attributaire,
            'codePostal' => $row['codePostal_Ac'],
            'type' => $row['nom_Ty'],
            'procedure' => $row['nom_Pr'],
            'montant' => $row['montantHT_Ac'],
            'annule' => $annule,
            'prive' => $prive,
            'direction' => $row['nom_Di'],
            'instructeur' => ucfirst($row['prenom_In']) . ' ' . strtoupper($row['nom_In'])
        );
    }

    return $accords; // Retourne le tableau d'accords
}


function fetchMarches($mois, $annee, $sql, $count, $param) // Définit une fonction pour récupérer les marches
{
    global $pdo; // Rend la variable $pdo globale
    $req = 'SELECT * FROM marche m, direction d, instructeur i, procedure_ac_ma, type_ac_ma WHERE m.id_In = i.id_In 
                                               AND i.id_Di = d.id_Di
                                               AND m.id_Ty = type_ac_ma.id_Ty
                                               AND m.id_Pr = procedure_ac_ma.id_Pr'; // Prépare la requête SQL pour récupérer les marches
    if ($sql == '') {
        if ($mois != "") {
            $req .= ' AND MONTH(dateCreation_Ma) = :mois'; // Ajoute une condition pour filtrer par mois
        }
        $req .= ' AND YEAR(dateCreation_Ma) = :annee'; // Ajoute une condition pour filtrer par année
    }
    global $pdo; // Rend la variable $pdo globale

    $req .= " " . $sql;
    $req .= " GROUP BY id_Ma order by dateCreation_Ma desc, id_Ma desc;"; // Ajoute des conditions supplémentaires à la requête
    $stmt = $pdo->prepare($req); // Prépare la requête pour l'exécution
    if ($sql == '') {
        if ($mois != "") {
            $stmt->bindParam(':mois', $mois); // Lie la valeur du mois à la requête
        }
        $stmt->bindParam(':annee', $annee); // Lie la valeur de l'année à la requête
    }
    if ((int)$count > 0) {
        $stmt->bindParam(':query', $param); // Lie la valeur du paramètre à la requête
    }
    $stmt->execute(); // Exécute la requête

    $marches = array(); // Initialise un tableau pour stocker les marches

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Parcourt les résultats de la requête
        if ($row['attributaire_Ma'] == NULL) {
            $attributaire = 'NR'; // Si l'attributaire est NULL, assigne 'NR'
        } else {
            $attributaire = $row['attributaire_Ma']; // Sinon, assigne la valeur de l'attributaire
        }
        if ($row['annule_Ma'] == 0) {
            $annule = 'Non'; // Si annulé est 0, assigne 'Non'
        } else {
            $annule = 'Oui'; // Sinon, assigne 'Oui'
        }
        if ($row['prive_Ma'] == 0) {
            $prive = 'Non'; // Si privé est 0, assigne 'Non'
        } else {
            $prive = 'Oui'; // Sinon, assigne 'Oui'
        }
        $marches[] = array( // Ajoute une nouvelle marche au tableau
            'id' => $row['id_Ma'],
            'dateCreation' => $row['dateCreation_Ma'],
            'libelle' => $row['libelle_Ma'],
            'attributaire' => $attributaire,
            'codePostal' => $row['codePostal_Ma'],
            'commune' => $row['commune_Ma'],
            'type' => $row['nom_Ty'],
            'procedure' => $row['nom_Pr'],
            'montant' => $row['montantHT_Ma'],
            'montantMin' => $row['montantMin_Ma'],
            'montantMax' => $row['montantMax_Ma'],
            'annule' => $annule,
            'prive' => $prive,
            'commentaires' => $row['commentaires_Ma'],
            'direction' => $row['nom_Di'],
            'instructeur' => ucfirst($row['prenom_In']) . ' ' . strtoupper($row['nom_In'])
        );
    }

    return $marches; // Retourne le tableau de marches
}

?>

