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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
</head>
<body class="subpage">
<div class="container-fluid">
    <?php
    $role = $_SESSION['role'];
    if ($role != 'admin') {
        header('Location: index.php');
        exit();
    }
    include("../inc/header.inc.php");
    ?>
    <div class="row">
        <!-- SIDEBAR -->
        <?php include("../inc/menu.inc.php"); ?>

        <div class="main-content container col-xl-9 col-sm-12 mb-3">
            <a href="../index.php" class="menu" title="Accueil">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                     class="bi bi-receipt-cutoff icone"
                     viewBox="0 0 16 16">
                    <path d="M3 4.5a.5.5 0 0 1.5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1.5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1.5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1.5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                    <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0.707 0L4 1.707l.646.647a.5.5 0 0 0.708 0L6 1.707l.646.647a.5.5 0 0 0.708 0L8 1.707l.646.647a.5.5 0 0 0.708 0L10 1.707l.646.647a.5.5 0 0 0.708 0l.509-.51.137.274V15H2V2.118z"/>
                </svg>
                <h1>
                    Tableau des procédures
                </h1>
            </a>
            <hr/>
            <div class="row">
                <div>
                    <label for="q">Recherche:</label>
                    <input type="text" id="q" placeholder="Entrez votre texte ici..." value="">
                    <br>
                    <label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red"
                             class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        Attention, la recherche se fait sur le nom.
                    </label>
                </div>
                <div class="col-12">
                    <table>
                        <thead>
                        <tr>
                            <th scope="col" rowspan="2" class="col-1">Id</th>
                            <th scope="col" rowspan="2" class="col-10">Nom</th>
                            <th scope="col" rowspan="2" class="col-1">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require '../inc/cnx.inc.php';
                        global $pdo;
                        $sql = "SELECT * FROM procedure_ac_ma order by id_Pr";
                        $result = $pdo->query($sql);

                        $sql = "SELECT MAX(id_Pr) FROM procedure_ac_ma order by id_Pr";
                        $resultat = $pdo->query($sql);

                        echo "<tr><form method='POST' action='portal-factory/ajouter.php?type=Procedure_ac_ma'>";
                        echo "<td><input type='text' name='id' id='id' placeholder='Auto' readonly/></td>";
                        echo "<td><input type='text' name='nom' id='nom' placeholder='Nom' /></td>";
                        echo "<td><button type='submit'>Ajouter</button></form></td>";
                        echo "</tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr><form method='POST' action='portal-factory/modifier.php?type=Procedure_ac_ma'>";
                            echo "<td><input type='text' name='id' id='id' value='" . $row['id_Pr'] . "' readonly/></td>";
                            echo '<td><input type="text" name="nom" id="nom" value="' . $row['nom_Pr'] . '" /></td>';
                            echo '<td>
                <button type="submit" class="action" title="Accepter les modifications">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                    </svg>
                </button>
                </form>
                <form method="post" action="../services-generaux/portal-factory/supprimer/supprimer.php?type=Procedure_ac_ma">
                <input type="hidden" name="id" value="' . $row['id_Pr'] . '">
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
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FOOTER -->
<?php include '../inc/footer.inc.php' ?>
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