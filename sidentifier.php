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
    include("inc/header.inc.php");
    ?>

    <!-- Mise en page par ligne pour une meilleure adaptation -->
    <div class="row">
        <!-- Menu à gauche -->
        <?php include("inc/menu.inc.php"); ?>
        <!-- Contenu principal -->
        <div class="main-content container col-xl-9 col-sm-12 mb-3">
            <!-- Mise en page par ligne pour une meilleure adaptation -->
            <div class="row">
                <!-- Adaptation du contenu -->
                <div class="col-12">
                    <!-- Lien vers l'accueil -->
                    <a href="index.php" class="menu" title="Accueil">
                        <!-- Icone -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                             class="bi bi-receipt-cutoff icone"
                             viewBox="0 0 16 16">
                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                            <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"/>
                        </svg>
                        <!-- Titre du contenu -->
                        <h1>Identifiaction</h1>
                    </a>
                    <hr/>
                    <form action="inc/verifierConnexion.inc.php" method="post">
                        <fieldset>
                            <legend>&nbsp;Informations de connexion&nbsp;</legend>
                            <label for='id'>Identifiant</label>
                            <input type="text" name="id" required autofocus maxlength="20"><br>
                            <label for='pwd'>Mot de passe</label>
                            <input type="password" name="pwd" maxlength="32" required><br>
                            <label>&nbsp;</label>
                            <input class="formButton" type="submit" value="S'identifier">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pied de page -->
<?php include 'inc/footer.inc.php' ?>
</body>
</html>