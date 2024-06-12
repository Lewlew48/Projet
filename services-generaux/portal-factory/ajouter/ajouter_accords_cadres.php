<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title>Département</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Intranet/css/style.css">
</head>
<body class="subpage">
<div class="container-fluid">
    <?php
    if (isset($_SESSION['nom'])) {
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];
        $role = $_SESSION['role'];
        $direction = $_SESSION['nom_dir'];
    } else {
        header('Location: ../../../sidentifier.php');
        exit();
    }

    require '../../../inc/cnx.inc.php';
    global $pdo;
    $sql = "SELECT id_In FROM instructeur WHERE nom_In = ? AND prenom_In = ? AND role_In = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $role]);
    $id_In = $stmt->fetchColumn();

    $sql = "SELECT * FROM type_ac_ma";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $types = $stmt->fetchAll();

    $sql = "SELECT * FROM procedure_ac_ma";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $procedures = $stmt->fetchAll();

    include("../../../inc/header.inc.php");
    ?>

    <div class="row">
        <!-- SIDEBAR -->
        <?php include("../../../inc/menu.inc.php"); ?>

        <div class="main-content container col-xl-9 col-sm-12 mb-3">
            <a href="../../.." class="menu" title="Accueil">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                     class="bi bi-receipt-cutoff icone"
                     viewBox="0 0 16 16">
                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                    <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"/>
                </svg>
                <h1>Ajouter Accords Cadres</h1>
            </a>
            <hr/>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    $titre = $_POST['titre'];
                    $libelle = $_POST['titre'];
                    $attributaire = $_POST['attributaire'];
                    $chapitre = $_POST['codePostal'];
                    $article = $_POST['type'];
                    $divers = $_POST['procedure'];
                    $montant = $_POST['montant'];
                    $prive = isset($_POST['prive']) ? 1 : 0;
                    $annule = isset($_POST['annule']) ? 1 : 0;
                    $date = date('Y-m-d');
                    $qte = $_POST['qte'];
                    for ($i = 0; $i < $qte; $i++) {
                        if ($i == 0) {
                            $libelle = $_POST['titre'];
                        } else {
                            $libelle = $_POST['titre'] . '-' . $i;
                        }
                        $sql = "INSERT INTO accords_cadres (dateCreation_Ac, libelle_Ac, attributaire_Ac, codePostal_Ac, id_Ty, id_Pr, montantHT_Ac, annule_Ac, prive_Ac, id_In) VALUES (:date, :libelle, :attributaire, :codePostal, :type, :procedure, :montant, :annule, :prive, :id_In)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':date', $date);
                        $stmt->bindParam(':libelle', $libelle);
                        $stmt->bindParam(':attributaire', $attributaire);
                        $stmt->bindParam(':codePostal', $chapitre);
                        $stmt->bindParam(':type', $article);
                        $stmt->bindParam(':procedure', $divers);
                        $stmt->bindParam(':montant', $montant);
                        $stmt->bindParam(':annule', $annule);
                        $stmt->bindParam(':prive', $prive);
                        $stmt->bindParam(':id_In', $id_In);
                        $stmt->execute();
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
            ?>
            <div class='container d-flex justify-content-center ajouter'>
                <form method="post">
                    <div class="form-group">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                 class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            Titre
                        </label>
                        <input type="text" name="titre" required class='form-control'>
                    </div>
                    <div class="form-group">
                        <label>Attributaire / Bénéficiaire:</label>
                        <input type="text" name="attributaire" class='form-control'>
                    </div>
                    <div class="form-group">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                 class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            Montant:
                        </label>
                        <input type="number" step="0.01" name="montant" required value='0.0' class='form-control'>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="prive">
                        <label>Privé</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="annule">
                        <label>Annulé</label>
                    </div>
                    <div class="form-group">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                 class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            Code Postal :
                        </label>
                        <input type="text" name="codePostal" required class='form-control'>
                    </div>
                    <div class="form-group">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                 class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            Type :
                        </label>
                        <select name="type" id="type" class='form' required>
                            <?php
                            foreach ($types as $type) {
                                echo "<option value=" . $type['id_Ty'] . "> " . $type['nom_Ty'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                 class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0.954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            Procédure :
                        </label>
                        <select name="procedure" id="procedure" class='form' required>
                            <?php
                            foreach ($procedures as $procedure) {
                                echo "<option value=" . $procedure['id_Pr'] . "> " . $procedure['nom_Pr'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre d'entrées :</label>
                        <input class="bpqte" type="button" value="- 100" onclick="dec100Qte(getElementById('qte'));"/>
                        <input class="bpqte" type="button" value="- 10" onclick="dec10Qte(getElementById('qte'));"/>
                        <input class="bpqte" type="button" value="- 1" onclick="decQte(getElementById('qte'));"/>
                        <input class="qte" type="number" id="qte" name="qte" value="1" onblur="validRefFormat(this)"
                               readonly/>
                        <input class="bpqte" type="button" value="+ 1" onclick="incQte(getElementById('qte'));"/>
                        <input class="bpqte" type="button" value="+ 10" onclick="inc10Qte(getElementById('qte'));"/>
                        <input class="bpqte" type="button" value="+ 100" onclick="inc100Qte(getElementById('qte'));"/>
                    </div>
                    <div class="form-group">
                        <label class="requis">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            (Requis)
                        </label><br>
                        <button type="submit">Enregistrer</button>
                        <button type="button" onclick="window.history.back()">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FOOTER -->
<?php include '../../../inc/footer.inc.php' ?>
</body>
<script src="../../../scripts/scripts.js" type="text/javascript"></script>
</html>