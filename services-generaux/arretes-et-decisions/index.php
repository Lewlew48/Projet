<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Département</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Intranet/css/style.css">
</head>
<body class="subpage">
<div class="container-fluid">
    <?php
    require '../../Requetes/fetch.php';
    if (isset($_GET['mois']) && isset($_GET['annee'])) {
        $mois = $_GET['mois'];
        $annee = $_GET['annee'];

    } else {
        $mois = date('m');
        $annee = date('Y');
    }
    if (isset($_POST['q'])) {
        $query = $_POST['q'];
    } else {
        $query = '';
    }
    $counter = 0;
    $sql = '';
    $param = '';
    // Add libelle_Ac condition to the SQL query
    if (isset($_POST['libelle']) && $_POST['libelle'] == 'on') {
        $sql .= " AND a.libelle_Ar LIKE :query";
        $param = '%' . $query . '%';
        $counter++;
    }

    // Add attributaire_Ac condition to the SQL query
    if (isset($_POST['attributaire']) && $_POST['attributaire'] == 'on') {
        if ($counter > 0) {
            $sql .= " OR a.attributaire_Ar LIKE :query";
        } else {
            $sql .= " AND a.attributaire_Ar LIKE :query";
            $counter++;
        }
        $param = '%' . $query . '%';
    }

    // Add nom_In and prenom_In conditions to the SQL query
    if (isset($_POST['instructeur']) && $_POST['instructeur'] == 'on') {
        if ($counter > 0) {
            $sql .= " OR (i.nom_In LIKE :query OR i.prenom_In LIKE :query)";
        } else {
            $sql .= " AND (i.nom_In LIKE :query OR i.prenom_In LIKE :query)";
            $counter++;
        }
        $param = '%' . $query . '%';
    }

    // Add nom_Di condition to the SQL query
    if (isset($_POST['direction']) && $_POST['direction'] == 'on') {
        if ($counter > 0) {
            $sql .= " OR d.nom_Di LIKE :query";
        } else {
            $sql .= " AND d.nom_Di LIKE :query";
        }
        $counter++;
        $param = '%' . $query . '%';
    }

    $date = $mois . '/' . $annee;
    $arretes = fetchArretes($mois, $annee, $sql, $counter, $param);
    if (isset($_SESSION['nom'])) {
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];
        $role = $_SESSION['role'];
        $direction = $_SESSION['nom_dir'];
        $url = "../portal-factory/ajouter/ajouter_arretes.php";
    } else {
        $url = "#\" onclick=\"alert('Veuillez vous connecter');";
    }

    $limite = 50;

    if (isset($_POST['Voir+'])) {
        $limite = $_POST['limite+'];
    } elseif (isset($_POST['Voir-'])) {
        $limite = $_POST['limite-'];
    }
    include("../../inc/header.inc.php");
    ?>


    <div class="row">
        <!-- SIDEBAR -->
        <?php include("../../inc/menu.inc.php"); ?>

        <div class="main-content container col-xl-9 col-sm-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <a href="../../" class="menu" title="Accueil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                             class="bi bi-receipt-cutoff icone"
                             viewBox="0 0 16 16">
                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                            <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"/>
                        </svg>
                        <h1>Arrêtés et décisions</h1>
                    </a>
                    <hr/>
                    <form method="post" action="index.php" style="padding-bottom:5%">
                        <?php
                        echo "Libellé ";
                        if (isset($_POST['libelle']) && $_POST['libelle'] == 'on') {
                            echo '<input checked type="checkbox" name="libelle"><br>';
                        } else {
                            echo '<input type="checkbox" name="libelle"><br>';
                        }

                        echo "Attributaire ";
                        if (isset($_POST['attributaire']) && $_POST['attributaire'] == 'on') {
                            echo '<input checked type="checkbox" name="attributaire"><br>';
                        } else {
                            echo '<input type="checkbox" name="attributaire"><br>';
                        }
                        echo "Instructeur ";
                        if (isset($_POST['instructeur']) && $_POST['instructeur'] == 'on') {
                            echo '<input checked type="checkbox" name="instructeur"><br>';
                        } else {
                            echo '<input type="checkbox" name="instructeur"><br>';
                        }
                        echo "Direction ";
                        if (isset($_POST['direction']) && $_POST['direction'] == 'on') {
                            echo '<input checked type="checkbox" name="direction"><br>';
                        } else {
                            echo '<input type="checkbox" name="direction"><br>';
                        }
                        ?>
                        <div style="position: relative; margin-left: 20%; margin-top: -7%">
                            <label for="q">Recherche:</label>
                            <input type="text" id="q" name="q" placeholder="Entrez votre texte ici..."
                                   value="<?php echo htmlspecialchars($query); ?>">
                            <input type="submit" value="Rechercher">
                            <br>
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                     class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                </svg>
                                Attention, la recherche se fait sur tous les champs sélectionnés.
                            </label>
                        </div>
                    </form>
                    <a href="<?php echo $url; ?>" class="menu" title="Ajouter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                             class="bi bi-plus-circle plus"
                             viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </a>
                    <a href="index.php?mois=<?php if ($mois - 1 == 0) {
                        echo '12';
                        echo "&annee=" . ($annee - 1);
                    } else {
                        echo sprintf("%02d", $mois - 1);
                        echo "&annee=" . $annee;
                    } ?>"
                       class="menu" title="Reculer d'un mois">

                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                             class="bi bi-arrow-left-circle plus selection" viewBox="0 0 16 16">>
                            <path fill-rule="evenodd"
                                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                        </svg>
                    </a>
                    <a href="index.php?mois=<?php if ($mois + 1 == 13) {
                        echo '01';
                        echo "&annee=" . ($annee + 1);
                    } else {
                        echo sprintf("%02d", $mois + 1);
                        echo "&annee=" . $annee;
                    } ?>"
                       class="menu" title="Avancer d'un mois">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                             class="bi bi-arrow-right-circle plus"
                             viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                        </svg>
                    </a>
                    Vous visualisez la période courant
                    <form class="menu-selection" action="index.php" method="get">
                        <label for="start"></label>
                        <input type="month" id="start"
                               value="<?php echo $date[3] . $date[4] . $date[5] . $date[6] . '-' . $date[0] . $date[1]; ?>"/>
                        <input type="hidden" id="mois" name="mois" value="">
                        <input type="hidden" id="annee" name="annee" value="">
                    </form>
                    <a class="menu" id="top" style="text-decoration: none;float: right;" title="Aller en bas de la page"
                       href="#end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                             class="bi bi-arrow-down-circle plus" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                        </svg>
                    </a>
                    <form class="menu-selection" style="text-decoration: none;float: right;"
                          action="../CSV/envoiCSV.php"
                          method="post">
                        <input type="hidden" name="type" value="Arretes-et-decisions">
                        <input type="hidden" name="valeur" value="<?php if ($counter > 0) {
                            echo "Recherche:'" . $query . "'";
                        } else {
                            echo $date;
                        } ?>">
                        <input type="hidden" name="mois" value=<?php echo $mois ?>>
                        <input type="hidden" name="annee" value=<?php echo $annee ?>>
                        <input type="hidden" name="sql" value=<?php echo "'" . $sql . "'" ?>>
                        <input type="hidden" name="count" value=<?php echo $counter ?>>
                        <input type="hidden" name="param" value=<?php echo $param ?>>
                        <button class="menu boutton" id="top" name="ExportCSV" title="Télécharger le CSV" type="submit"
                                value="ExportCSV">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                 class="bi bi-cloud-download plus" viewBox="0 0 16 16">
                                <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                                <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"/>
                            </svg>
                        </button>
                    </form>
                    <form class="menu-selection" style="text-decoration: none;float: right;"
                          action="../CSV/envoiCSV.php"
                          method="post">
                        <input type="hidden" name="type" value="Arretes-et-decisions">
                        <input type="hidden" name="valeur" value="<?php if ($counter > 0) {
                            echo "Recherche:'" . $query . "'";
                        } else {
                            echo $annee;
                        } ?>">
                        <input type="hidden" name="mois" value="">
                        <input type="hidden" name="annee" value=<?php echo $annee ?>>
                        <input type="hidden" name="sql" value=<?php echo "'" . $sql . "'" ?>>
                        <input type="hidden" name="count" value=<?php echo $counter ?>>
                        <input type="hidden" name="param" value=<?php echo $param ?>>
                        <button class="menu boutton" id="top" name="ExportCSV" title="Télécharger le CSV annuel"
                                type="submit"
                                value="ExportCSV">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                 class="bi bi-cloud-download-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708z"/>
                            </svg>
                        </button>
                    </form>
                    <table class="col-12">
                        <thead>
                        <tr>
                            <th scope="col" rowspan="2" class="col-1">Numéro</th>
                            <th scope="col" rowspan="2" class="col-1">Date de création</th>
                            <th scope="col" rowspan="2" class="col-3">Libellé</th>
                            <th scope="col" rowspan="2" class="col-1">Direction</th>
                            <th scope="col" rowspan="2" class="col-1">Instructeur</th>
                            <th scope="col" rowspan="2" class="col-1">Attributaire</th>
                            <th scope="col" rowspan="2" class="col-1">Chapitre</th>
                            <th scope="col" rowspan="2" class="col-1">Article</th>
                            <th scope="col" rowspan="2" class="col-1">Divers</th>
                            <th scope="col" rowspan="2" class="col-1">Montant</th>
                            <th scope="col" colspan="2" class="col-1">Propriétés</th>
                            <th scope="col" rowspan="2" class="col-1">Action</th>
                        </tr>
                        <tr>
                            <th scope="col">Annulé</th>
                            <th scope="col">Privé</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $val = 0;
                        for ($i = ($limite - 50); $i < $limite; $i++) {
                            $val++;
                            if ($i < 0) {
                                break;
                            }
                            if (isset($arretes[$i]) && $arretes[$i] != NULL) {
                                $arrete = $arretes[$i];

                                echo '<tr>';
                                echo '<td>' . $arrete['dateCreation'][2] . $arrete['dateCreation'][3] . '-' . sprintf("%04d", $arrete['id']) . '</td>';
                                echo '<td>' . $arrete['dateCreation'] . '</td>';
                                echo '<td>' . $arrete['libelle'] . '</td>';
                                echo '<td>' . $arrete['direction'] . '</td>';
                                echo '<td>' . $arrete['instructeur'] . '</td>';
                                echo '<td>' . $arrete['attributaire'] . '</td>';
                                echo '<td>' . $arrete['chapitre'] . '</td>';
                                echo '<td>' . $arrete['article'] . '</td>';
                                echo '<td>' . $arrete['divers'] . '</td>';
                                echo '<td>' . $arrete['montant'] . ' €</td>';
                                echo '<td>' . $arrete['annule'] . '</td>';
                                echo '<td>' . $arrete['prive'] . '</td>';
                                if (isset($_SESSION['role']) && isset($_SESSION['nom_dir'])) {
                                    if ($_SESSION['role'] == 'admin' || $_SESSION['nom_dir'] == $arrete['direction']) {
                                        echo '<td>
                <form method="post" action="../portal-factory/modifier/modifier_arretes.php">
                <input type="hidden" name="id" value="' . $arrete['id'] . '">
                <button type="submit" class="action" title="Modifier">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                    </svg>
                </button>
                </form>
                <form method="post" action="../portal-factory/supprimer/supprimer.php?type=Arrete">
                <input type="hidden" name="id" value="' . $arrete['id'] . '">
                <button type="submit" class="action" title="Supprimer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </button>
                </form>
              </td>';

                                    } else {
                                        echo '<td></td>';
                                    }
                                } else {
                                    echo '<td></td>';
                                }
                                echo '</tr>';
                            } else {
                                break;
                            }

                        }
                        ?>
                        </tbody>
                    </table>
                    <div id="end" style="text-align: center">
                        <form method="post">
                            <?php if ($limite > 50) { ?>
                                <input type="hidden" name="limite-" value="<?php echo($limite - 50); ?>">
                                <input type="hidden" name="q" value="<?php echo $query; ?>">
                                <input type="hidden" name="libelle" value="<?php if (isset($_POST['libelle'])) {
                                    echo $_POST['libelle'];
                                }; ?>">
                                <input type="hidden" name="attributaire"
                                       value="<?php if (isset($_POST['attributaire'])) {
                                           echo $_POST['attributaire'];
                                       }; ?>">
                                <input type="hidden" name="instructeur" value="<?php if (isset($_POST['instructeur'])) {
                                    echo $_POST['instructeur'];
                                }; ?>">
                                <input type="hidden" name="direction" value="<?php if (isset($_POST['direction'])) {
                                    echo $_POST['direction'];
                                }; ?>">
                                <button class="menu boutton" id="end" name="Voir-" title="Voir les 50 pécédents"
                                        type="submit"
                                        value="Voir-">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                         class="bi bi-calendar-minus" viewBox="0 0 16 16">
                                        <path d="M5.5 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg>
                                </button>
                            <?php } ?>
                            <?php if ($val >= 50) { ?>
                                <input type="hidden" name="limite+" value="<?php echo($limite + 50); ?>">
                                <input type="hidden" name="q" value="<?php echo $query; ?>">
                                <input type="hidden" name="libelle" value="<?php if (isset($_POST['libelle'])) {
                                    echo $_POST['libelle'];
                                }; ?>">
                                <input type="hidden" name="attributaire"
                                       value="<?php if (isset($_POST['attributaire'])) {
                                           echo $_POST['attributaire'];
                                       }; ?>">
                                <input type="hidden" name="instructeur" value="<?php if (isset($_POST['instructeur'])) {
                                    echo $_POST['instructeur'];
                                }; ?>">
                                <input type="hidden" name="direction" value="<?php if (isset($_POST['direction'])) {
                                    echo $_POST['direction'];
                                }; ?>">
                                <button class="menu boutton" id="end" name="Voir+" title="Voir les 50 suivants"
                                        type="submit"
                                        value="Voir+">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                         class="bi bi-calendar-plus" viewBox="0 0 16 16">
                                        <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg>
                                </button>
                            <?php } ?>
                            <a class="menu" id="end" title="Aller en haut de la page"
                               href="#top">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                     class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                                </svg>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FOOTER -->
<?php include '../../inc/footer.inc.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('start').addEventListener('blur', function () {
        document.getElementById('mois').value = document.getElementById('start').value.slice(5, 7);
        document.getElementById('annee').value = document.getElementById('start').value.slice(0, 4);
        this.form.submit();
    });
</script>
</body>
</html>