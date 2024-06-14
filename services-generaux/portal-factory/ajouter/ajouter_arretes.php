<?php
session_start();
?>
<!-- Début de la page -->
<!DOCTYPE html>
<!-- Type du document -->
<html lang="fr">
<!-- Entête -->
<head>
    <!-- Titre de la page -->
    <title>Département</title>
    <!-- Charte graphique -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <!-- Bibliothèque Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Style des éléments de la page -->
    <link rel="stylesheet" href="/Intranet/css/style.css">
</head>
<!-- Corps de la page -->
<body class="subpage">
<!-- Contenu de la page qui s'adapte au changement de taille-->
<div class="container-fluid">
    <?php
    // Vérifier si la session est définie
    if (isset($_SESSION['nom'])) {
        // Récupérer les informations de la session
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];
        $role = $_SESSION['role'];
        $direction = $_SESSION['nom_dir'];
    } else {
        // Rediriger vers la page de connexion si la session n'est pas définie
        header('Location: ../../../sidentifier.php');
        exit();
    }

    // Inclure le fichier de connexion à la base de données
    require '../../../inc/cnx.inc.php';
    global $pdo;

    // Requête pour obtenir l'ID de l'instructeur
    $sql = "SELECT id_In FROM instructeur WHERE nom_In = ? AND prenom_In = ? AND role_In = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $role]);
    $id_In = $stmt->fetchColumn();
    // Inclure l'en-tête
    include("../../../inc/header.inc.php");
    ?>
    <!-- Mise en page par ligne pour une meilleure adaptation -->
    <div class="row">
        <!-- Menu à gauche -->
        <?php include("../../../inc/menu.inc.php"); ?>
        <!-- Contenu principal -->
        <div class="main-content container col-xl-9 col-sm-12 mb-3">
            <!-- Mise en page par ligne pour une meilleure adaptation -->
            <div class="row">
                <!-- Adaptation du contenu -->
                <div class="col-12">
                    <!-- Lien vers l'accueil -->
                    <a href="../../" class="menu" title="Accueil">
                        <!-- Icone -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                             class="bi bi-receipt-cutoff icone"
                             viewBox="0 0 16 16">
                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                            <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"/>
                        </svg>
                        <!-- Titre du contenu -->
                        <h1>Ajouter Arrêtés</h1>
                    </a>
                    <hr/>
                    <?php
                    // Vérifier si la requête est de type POST
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        try {
                            // Récupérer les valeurs du formulaire
                            $titre = $_POST['titre'];
                            $libelle = $_POST['titre'];
                            $attributaire = $_POST['attributaire'];
                            $chapitre = $_POST['chapitre'];
                            $article = $_POST['article'];
                            $divers = $_POST['divers'];
                            $montant = $_POST['montant'];
                            $prive = isset($_POST['prive']) ? 1 : 0;
                            $annule = isset($_POST['annule']) ? 1 : 0;
                            $date = date('Y-m-d');
                            $qte = $_POST['qte'];

                            // Boucle pour insérer les données en fonction de la quantité
                            for ($i = 0; $i < $qte; $i++) {
                                // Générer le libellé en fonction de l'itération
                                if ($i == 0) {
                                    $libelle = $_POST['titre'];
                                } else {
                                    $libelle = $_POST['titre'] . '-' . $i;
                                }

                                // Requête SQL pour insérer les données dans la base de données
                                $sql = "INSERT INTO arrete (dateCreation_Ar, libelle_Ar, attributaire_Ar, chapitre_Ar, article_Ar, divers_Ar, montant_Ar, annule_Ar, prive_Ar, id_In) VALUES (:date, :libelle, :attributaire, :chapitre, :article, :divers, :montant, :annule, :prive, :id_In)";
                                $stmt = $pdo->prepare($sql);

                                // Liaison des paramètres
                                $stmt->bindParam(':date', $date);
                                $stmt->bindParam(':libelle', $libelle);
                                $stmt->bindParam(':attributaire', $attributaire);
                                $stmt->bindParam(':chapitre', $chapitre);
                                $stmt->bindParam(':article', $article);
                                $stmt->bindParam(':divers', $divers);
                                $stmt->bindParam(':montant', $montant);
                                $stmt->bindParam(':annule', $annule);
                                $stmt->bindParam(':prive', $prive);
                                $stmt->bindParam(':id_In', $id_In);

                                // Exécution de la requête
                                $stmt->execute();
                            }
                        } catch (PDOException $e) {
                            // Gestion des erreurs
                            echo "Erreur : " . $e->getMessage();
                        }
                        header("Location:../../accords-cadres");
                    }
                    ?>
                    <!-- Contenu du formulaire -->
                    <div class='container d-flex justify-content-center ajouter'>
                        <!-- Formulaire d'ajout -->
                        <form method="post">
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <label>
                                    <!-- Icone -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                         class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                    </svg>
                                    Titre
                                </label>
                                <!-- Zone de saisie -->
                                <input type="text" name="titre" required class='form-control'>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <label>Attributaire / Bénéficiaire:</label>
                                <!-- Zone de saisie-->
                                <input type="text" name="attributaire" class='form-control'>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <label>
                                    <!-- Icone-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                         class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                    </svg>
                                    Montant:
                                </label>
                                <!-- Zone de saisie -->
                                <input type="number" step="0.01" name="montant" required value='0.0'
                                       class='form-control'>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <!-- Case à cocher -->
                                <input type="checkbox" name="prive">
                                <label>Privé</label>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <!-- Case à cocher -->
                                <input type="checkbox" name="annule">
                                <label>Annulé</label>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <label>Chapitre :</label>
                                <!-- Zone de saisie -->
                                <input type="text" name="chapitre" class='form-control'>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <label>Article :</label>
                                <!-- Zone de saisie -->
                                <input type="text" name="article" class='form-control'>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <label>Divers :</label>
                                <!-- Zone de saisie -->
                                <input type="text" name="divers" class='form-control'>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <label for="qte">Nombre d'entrées :</label>
                                <!-- Bouton -100 entrées -->
                                <input class="bpqte" type="button" value="- 100"
                                       onclick="dec100Qte(getElementById('qte'));"/>
                                <!-- Bouton -10 entrées -->
                                <input class="bpqte" type="button" value="- 10"
                                       onclick="dec10Qte(getElementById('qte'));"/>
                                <!-- Bouton -1 entrée -->
                                <input class="bpqte" type="button" value="- 1"
                                       onclick="decQte(getElementById('qte'));"/>
                                <!-- Zone de saisie -->
                                <input class="qte" type="number" id="qte" name="qte" value="1"
                                       onblur="validRefFormat(this)"
                                       readonly/>
                                <!-- Bouton +1 entrée -->
                                <input class="bpqte" type="button" value="+ 1"
                                       onclick="incQte(getElementById('qte'));"/>
                                <!-- Bouton +10 entrées -->
                                <input class="bpqte" type="button" value="+ 10"
                                       onclick="inc10Qte(getElementById('qte'));"/>
                                <!-- Bouton +100 entrées -->
                                <input class="bpqte" type="button" value="+ 100"
                                       onclick="inc100Qte(getElementById('qte'));"/>
                            </div>
                            <!-- Groupement d'éléments -->
                            <div class="form-group">
                                <!-- Affichage en rouge -->
                                <label class="requis">
                                    <!-- Icone -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                    </svg>
                                    (Requis)
                                </label><br>
                                <!-- Bouton enregistrer -->
                                <button type="submit">Enregistrer</button>
                                <!-- Bouton annuler -->
                                <button type="button" onclick="window.history.back()">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pied de page -->
<?php include '../../../inc/footer.inc.php' ?>
</body>
<!-- Insertion des scripts -->
<script src="../../../scripts/scripts.js" type="text/javascript"></script>
</html>