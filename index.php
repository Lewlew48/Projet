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
                        <h1>Accueil</h1>
                    </a>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="carousel slide" id="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"
                                            aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="3"
                                            aria-label="Slide 4"></button>
                                </div>
                                <div class="carousel-inner rounded">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" alt="accords" src="img/accords.jpg">
                                        <div class="carousel-caption">
                                            <h4>
                                                Accords Cadres
                                            </h4>
                                            <p>
                                                Visualisation périodique des accords.
                                            </p>
                                            <p>
                                                <a class="btn btn-secondary"
                                                   href="services-generaux/accords-cadres/">Nos
                                                    accords</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" alt="arretes" src="img/arretes.jpg">
                                        <div class="carousel-caption">
                                            <h4>
                                                Arrêtés et Décisions
                                            </h4>
                                            <p>
                                                Visualisation périodique des arrêtés et décisions.
                                            </p>
                                            <p>
                                                <a class="btn btn-secondary"
                                                   href="services-generaux/arretes-et-decisions/">Nos
                                                    arrêtés</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" alt="conventions" src="img/conventions.jpg">
                                        <div class="carousel-caption">
                                            <h4>
                                                Conventions
                                            </h4>
                                            <p>
                                                Visualisation périodique des conventions.
                                            </p>
                                            <p>
                                                <a class="btn btn-secondary"
                                                   href="services-generaux/conventions/">Nos
                                                    conventions</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" alt="marches" src="img/marches.jpg">
                                        <div class="carousel-caption">
                                            <h4>
                                                Marchés
                                            </h4>
                                            <p>
                                                Visualisation périodique des marchés.
                                            </p>
                                            <p>
                                                <a class="btn btn-secondary"
                                                   href="services-generaux/marches/">Nos
                                                    marchés</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel"
                                        data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel"
                                        data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pied de page -->
<?php include 'inc/footer.inc.php' ?>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>
</html>