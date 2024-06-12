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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
</head>
<body class="subpage">
<div class="container-fluid">
    <?php
    include("inc/cnx.inc.php");

    global $pdo;
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $role = $_SESSION['role'];
    $direction = $_SESSION['nom_dir'];

    $sql = "SELECT * FROM instructeur WHERE nom_In = ? AND prenom_In = ? AND role_In = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $role]);
    $instructeur = $stmt->fetch();
    include("inc/header.inc.php");
    ?>
    <div class="row">
        <!-- SIDEBAR -->
        <?php include("inc/menu.inc.php"); ?>

        <div class="main-content container col-xl-9 col-sm-12 mb-3">
            <a href="index.php" class="menu" title="Accueil">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                     class="bi bi-receipt-cutoff icone"
                     viewBox="0 0 16 16">
                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                    <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"/>
                </svg>
                <h1>
                    Mon compte
                </h1>
            </a>
            <hr/>
            <div class="ui-widget">
                <form action="inc/modificationInstructeur.inc.php" method="post">
                    <fieldset>
                        <legend style="text-transform: uppercase">informations</legend>
                        <?php
                        if (isset($_GET['message'])) {
                            if ($_GET['message'] == "mdp") {
                                echo "<h4 class='requis'>Veuillez entrer un nouveau mot de passe</h4>";
                            }
                        }
                        ?>
                        <input type="hidden" name="id" value="<?php echo $instructeur['id_In'] ?>>">
                        <label for='nom'>Nom</label>
                        <input type="text" name="nom" required autofocus maxlength="40"
                               value="<?php echo $nom ?>"><br>
                        <label for='prenom'>Prénom</label>
                        <input type="text" name="prenom" required maxlength="40"
                               value="<?php echo $prenom ?>"><br>
                        <label for='identifiant'>Identitifant</label>
                        <input type="text" name="identifiant" required maxlength="20"
                               value="<?php echo $instructeur['identifiant_In'] ?>"><br>
                        <label for='pwd1'>Mot de passe</label>
                        <input type="password" name="pwd1" maxlength="32"><br>
                        <label for='pwd2'>Confirmez</label>
                        <input type="password" name="pwd2" maxlength="32"><br>
                        <br>
                        <input class="button" type="submit" value="Modifier">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<?php include 'inc/footer.inc.php' ?>

</body>
</html>