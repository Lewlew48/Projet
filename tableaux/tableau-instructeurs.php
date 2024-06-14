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
                        <h1>Tableau des instructeurs</h1>
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
                                Attention, la recherche se fait sur le nom et le prénom.
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
                                    <th scope="col" rowspan="2" class="col-2">Nom</th>
                                    <!-- Prénom -->
                                    <th scope="col" rowspan="2" class="col-2">Prénom</th>
                                    <!-- Identifiant -->
                                    <th scope="col" rowspan="2" class="col-2">Identifiant</th>
                                    <!-- Mot de passe -->
                                    <th scope="col" rowspan="2" class="col-1">Mot de passe</th>
                                    <!-- Role -->
                                    <th scope="col" rowspan="2" class="col-1">Rôle</th>
                                    <!-- Direction -->
                                    <th scope="col" rowspan="2" class="col-1">Direction</th>
                                    <!-- Statut -->
                                    <th scope="col" rowspan="2" class="col-1">Statut</th>
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
                                $sql = "SELECT * FROM instructeur, direction WHERE instructeur.id_Di = direction.id_Di order by id_In";
                                $result = $pdo->query($sql);

                                // Récupérer l'ID maximum
                                $sql = "SELECT MAX(id_In) FROM instructeur, direction WHERE instructeur.id_Di = direction.id_Di order by id_In";
                                $resultat = $pdo->query($sql);

                                // Formulaire pour ajouter un élément
                                echo "<tr><form method='POST' action='portal-factory/ajouter.php?type=Instructeur'>";
                                echo "<td><input type='text' name='id' id='id' readonly placeholder='Auto'/></td>";
                                echo "<td><input type='text' name='nom' id='nom' placeholder='Nom'/></td>";
                                echo "<td><input type='text' name='prenom' id='prenom' placeholder='Prénom'/></td>";
                                echo "<td><input type='text' name='identifiant' id='identifiantAjout' placeholder='Unique'/></td>";
                                echo "<td><input type='text' name='password' id='password' placeholder='Vide' readonly/></td>";
                                echo "<td>
                                <select name='role' id='role'>
                                    <option value='admin'>admin</option>
                                    <option selected value='employe'>employe</option>
                                </select>
                              </td>";
                                echo "<td><select name='direction' id='direction'>";
                                foreach ($pdo->query("SELECT * FROM direction") as $row) {
                                    echo "<option value='" . $row['id_Di'] . "'>" . $row['nom_Di'] . "</option>";
                                }
                                echo "</select>
                              </td>";
                                echo "<td>
                                <select name='statut' id='statut'>
                                    <option selected value='en attente'>en attente</option>
                                    <option value='validé'>validé</option>
                                    <option value='bloqué'>bloqué</option>
                                </select>
                              </td>";
                                echo "<td><button type='submit' id='btnAjouter' disabled>Ajouter</button></form></td>";
                                echo "</tr>";

                                // Afficher les éléments existants avec possibilité de modification et suppression
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['nom_In'] == $_SESSION['nom'] && $row['prenom_In'] == $_SESSION['prenom'] && $row['role_In'] == $_SESSION['role'] && $row['nom_Di'] == $_SESSION['nom_dir']) {
                                        echo '<tr><form method="post" action="portal-factory/modifier.php?type=Instructeur">';
                                        echo "<td><input class='requis' type='text' name='id' id='id' value='" . $row['id_In'] . "' readonly disabled/></td>";
                                        echo "<td><input class='requis' type='text' name='nom' id='nom' value='" . $row['nom_In'] . "'disabled /></td>";
                                        echo "<td><input class='requis' type='text' name='prenom' id='prenom' value='" . $row['prenom_In'] . "' disabled/></td>";
                                        echo "<td><input class='requis' type='text' name='identifiant' id='identifiant' value='" . $row['identifiant_In'] . "' disabled/></td>";
                                        echo "<td><input class='requis' type='password' name='password' id='password" . $row['id_In'] . "' value='" . $row['password_In'] . "' readonly/><input class='requis' type='radio' name='changer' title='Réinitialiser le mot de passe' onclick=\"getElementById('password" . $row['id_In'] . "').value='' \"></td>";
                                        echo "<td><select class='requis' name='role' id='role' disabled>";
                                        if ($row['role_In'] == 'admin') {
                                            echo "<option class='requis' selected value='admin'>admin</option>";
                                        } else {
                                            echo "<option class='requis' selected value='employe'>employe</option>";
                                        }
                                        echo "</select>
                              </td>";
                                        echo "<td><select class='requis' name='direction' id='direction' disabled>";
                                        foreach ($pdo->query("SELECT * FROM direction") as $ligne) {
                                            if ($row['id_Di'] == $ligne['id_Di']) {
                                                echo "<option selected value='" . $row['id_Di'] . "'>" . $row['nom_Di'] . "</option>";
                                            }
                                        }
                                        echo "</select>
                              </td>";
                                        echo "<td><select class='requis' name='statut' id='statut' disabled>";
                                        if ($row['statut_In'] == 'en attente') {
                                            echo "<option selected value='en attente'>en attente</option>";
                                        } elseif ($row['statut_In'] == 'validé') {
                                            echo "<option selected value='validé'>validé</option>";
                                        } else {
                                            echo "<option selected value='bloqué'>bloqué</option>";
                                        }
                                        echo "</select></td>";
                                        echo '<td></td>';
                                    } else {
                                        echo '<tr><form method="post" action="portal-factory/modifier.php?type=Instructeur">';
                                        echo "<td><input type='text' name='id' id='id' value='" . $row['id_In'] . "' readonly/></td>";
                                        echo "<td><input type='text' name='nom' id='nom' value='" . $row['nom_In'] . "' /></td>";
                                        echo "<td><input type='text' name='prenom' id='prenom' value='" . $row['prenom_In'] . "' /></td>";
                                        echo "<td><input type='text' name='identifiant' id='identifiant' value='" . $row['identifiant_In'] . "' /></td>";
                                        echo "<td><input type='password' name='password' id='password" . $row['id_In'] . "' value='" . $row['password_In'] . "' readonly /><input type='radio' name='changer' title='Réinitialiser le mot de passe' onclick=\"getElementById('password" . $row['id_In'] . "').value='' \"></td>";
                                        echo "<td><select name='role' id='role'>";
                                        if ($row['role_In'] == 'admin') {
                                            echo "<option selected value='admin'>admin</option>";
                                            echo "<option value='employe'>employe</option>";
                                        } else {
                                            echo "<option value='admin'>admin</option>";
                                            echo "<option selected value='employe'>employe</option>";
                                        }
                                        echo "</select>
                              </td>";
                                        echo "<td><select name='direction' id='direction'>";
                                        foreach ($pdo->query("SELECT * FROM direction") as $ligne) {
                                            if ($row['id_Di'] == $ligne['id_Di']) {
                                                echo "<option selected value='" . $row['id_Di'] . "'>" . $row['nom_Di'] . "</option>";
                                            } else {
                                                echo "<option value='" . $ligne['id_Di'] . "'>" . $ligne['nom_Di'] . "</option>";
                                            }
                                        }
                                        echo "</select>
                              </td>";
                                        echo "<td><select name='statut' id='statut'>";
                                        if ($row['statut_In'] == 'en attente') {
                                            echo "<option selected value='en attente'>en attente</option>";
                                            echo "<option value='validé'>validé</option>";
                                            echo "<option value='bloqué'>bloqué</option>";
                                        } elseif ($row['statut_In'] == 'validé') {
                                            echo "<option value='en attente'>en attente</option>";
                                            echo "<option selected value='validé'>validé</option>";
                                            echo "<option value='bloqué'>bloqué</option>";
                                        } else {
                                            echo "<option value='en attente'>en attente</option>";
                                            echo "<option value='validé'>validé</option>";
                                            echo "<option selected value='bloqué'>bloqué</option>";
                                        }
                                        echo "</select></td>";
                                        echo '<td>
                                                <button type="submit" class="action" title="Accepter les modifications">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            <form method="post" action="../services-generaux/portal-factory/supprimer/supprimer.php?type=Instructeur">
                                                <input type="hidden" name="id" value="' . $row['id_In'] . '">
                                                <button type="submit" class="action" title="Supprimer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>';
                                        echo "</tr>";
                                    }
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
                let prenom = rows[i].getElementsByTagName("td")[2].getElementsByTagName("input")[0].value.toLowerCase();

                if (name.includes(filter) || prenom.includes(filter)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        // Ajoutez un écouteur d'événements au champ d'entrée
        input.addEventListener("input", filterTable);
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Récupérez le bouton "
        const btn = document.getElementById('btnAjouter');
        //
        const input = document.getElementById('identifiantAjout');

        // Obtenez le tableau et les éléments d'entrée
        let table = document.querySelector("table");

        // Fonction pour filtrer les lignes en fonction de la valeur d'entrée
        function filterId() {
            let filter = input.value;
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let identifiant = rows[i].getElementsByTagName("td")[3].getElementsByTagName("input")[0].value;

                btn.disabled = identifiant === filter;
            }
        }

        // Ajoutez un écouteur d'événements au champ d'entrée
        input.addEventListener("input", filterId);
    });

</script>
</body>
</html>