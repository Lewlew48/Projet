<?php
session_start();

switch ($_GET['err']) {

    //l'erreur vient de la connexion d'un admin
    case "connexion" :
        $message = "Votre identifiant et/ou votre mot de passe sont invalides ou votre compte n'a pas encore été validé.";
        $page_redirect = "sidentifier.php";
        break;


    //l'erreur vient de 2 pwd différents lors de l'enregistrement d'un client
    case "pwd" :
        $message = "Les deux mots de passe saisis doivent être identiques.";
        $page_redirect = "enregistrerInstructeur.php";
        break;

    //l'erreur vient de l'enregistrement d'un client
    case "Creation" :
        $message = "Les informations transmises sont erronées.";
        $page_redirect = "enregistrerInstructeur.php";
        break;

    //l'erreur vient de l'enregistrement d'un client
    case "enregistrement" :
        $message = "Veuillez attendre que votre compte soit validé.";
        $page_redirect = "inc/deconnexion.inc.php";
        break;

    case "identifiant" :
        $message = "L'identifiant choisi est déjà utilisé, veuillez en choisir un autre.";
        $page_redirect = $_SERVER['HTTP_REFERER'];
        break;

    //l'erreur n'est pas prévue, on retournera à l'accueil
    default:
        $message = "Erreur inconue. Retour à l'accueil";
        $page_redirect = "index.php";
        break;
}
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
</head>
<body class="subpage">
<div class="container-fluid">
    <?php
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
                    Information
                </h1>
            </a>
            <hr/>
            <p class='erreur'><?php echo $message; ?></p>
            <p>Veuillez patientez quelques secondes...</p>
            <?php header("refresh:5;url=" . $page_redirect); ?>
        </div>
    </div>
</div>
<!-- FOOTER -->
<?php include 'inc/footer.inc.php' ?>


</body>
</html>