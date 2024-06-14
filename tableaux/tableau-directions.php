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
    <!-- Bibliothèque jquery -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
</head>
<!-- Corps de la page -->
<body class="subpage">
<!-- Contenu de la page qui s'adapte au changement de taille-->
<div class="container-fluid">
    <?php
    // Vérifier le rôle de l'utilisateur
    $role = $_SESSION['role'];
    if ($role != 'admin') {
        // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
        header('Location: index.php');
        exit();
    }

    // Inclure l'en-tête du site
    include("../inc/header.inc.php");
    ?>

    <!-- Mise en page par ligne pour une meilleure adaptation -->
    <div class="row">
        <!-- Menu à gauche -->
        <?php include("../inc/menu.inc.php"); ?>
        <!-- Contenu principal -->
        <div class="main-content container col-xl-9 col-sm-12 mb-3">
            <!-- Mise en page par ligne pour une meilleure adaptation -->
            <div class="row">
                <!-- Adaptation du contenu -->
                <div class="col-12">
                    <!-- Lien vers l'accueil -->
                    <a href="../index.php" class="menu" title="Accueil">
                        <!-- Icone -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                             class="bi bi-receipt-cutoff icone"
                             viewBox="0 0 16 16">
                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                            <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"/>
                        </svg>
                        <!-- Titre du contenu -->
                        <h1>Tableau des directions</h1>
                    </a>
                    <hr/>
                    <!-- Affichage en ligne -->
                    <div class="row">
                        <!-- Groupement d'éléments -->
                        <div>
                            <label for="q">Recherche:</label>
                            <!-- Zone de recherche -->
                            <input type="text" id="q" placeholder="Entrez votre texte ici..." value="">
                            <br>
                            <label>
                                <!-- Icone -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                                     class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                </svg>
                                Attention, la recherche se fait sur le nom.
                            </label>
                        </div>
                        <!-- Séparation des éléments -->
                        <div class="col-12">
                            <!-- Tableau -->
                            <table>
                                <!-- Première ligne -->
                                <thead>
                                <tr>
                                    <!-- Id -->
                                    <th scope="col" rowspan="2" class="col-1">Id</th>
                                    <!-- Nom -->
                                    <th scope="col" rowspan="2" class="col-10">Nom</th>
                                    <!-- Action -->
                                    <th scope="col" rowspan="2" class="col-1">Action</th>
                                </tr>
                                </thead>
                                <!-- Corps du tableau -->
                                <tbody>
                                <?php
                                // Connexion à la base de données
                                require '../inc/cnx.inc.php';
                                global $pdo;

                                // Récupérer tous les éléments
                                $sql = "SELECT * FROM direction order by id_Di";
                                $result = $pdo->query($sql);

                                // Récupérer l'ID maximum
                                $sql = "SELECT MAX(id_Di) FROM direction order by id_Di";
                                $resultat = $pdo->query($sql);

                                // Formulaire pour ajouter un élément
                                echo "<tr><form method='POST' action='portal-factory/ajouter.php?type=Direction'>";
                                echo "<td><input type='text' name='id' id='id' placeholder='Auto' readonly/></td>";
                                echo "<td><input type='text' name='nom' id='nom' placeholder='Nom' /></td>";
                                echo "<td><button type='submit'>Ajouter</button></form></td>";
                                echo "</tr>";

                                // Afficher les éléments existants avec possibilité de modification et suppression
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr><form method='POST' action='portal-factory/modifier.php?type=Direction'>";
                                    echo "<td><input type='text' name='id' id='id' value='" . $row['id_Di'] . "' readonly/></td>";
                                    echo "<td><input type='text' name='nom' id='nom' value='" . $row['nom_Di'] . "' /></td>";
                                    echo '<td>
                                            <button type="submit" class="action" title="Accepter les modifications">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="post" action="../services-generaux/portal-factory/supprimer/supprimer.php?type=Direction">
                                            <input type="hidden" name="id" value="' . $row['id_Di'] . '">
                                            <button type="submit" class="action" title="Supprimer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>';
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pied de page -->
<?php include '../inc/footer.inc.php' ?>
<!-- Script pour filtrer les lignes -->>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Obtenez le tableau et les éléments d'entrée
        let table = document.querySelector("table");
        let input = document.querySelector("#q");

        // Fonction pour filtrer les lignes en fonction de la valeur d'entrée
        function filterTable() {
            let filter = input.value.toLowerCase();
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let name = rows[i].getElementsByTagName("td")[1].getElementsByTagName("input")[0].value.toLowerCase();
                if (name.includes(filter)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        // Ajoutez un écouteur d'événements au champ d'entrée
        input.addEventListener("input", filterTable);
    });
</script>
</body>
</html>