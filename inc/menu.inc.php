<div class="left-menu container col-xl-2 col-sm-12 mb-3">
    <section id="menu">
        <header>
            <h3>Pages</h3>
        </header>
        <ul class="link-list">
            <li><a href="/Intranet/">Accueil</a></li>
            <li><a href="/Intranet/services-generaux/accords-cadres/">Accords Cadres</a></li>
            <li><a href="/Intranet/services-generaux/arretes-et-decisions/">Arrêtés et Décisions</a></li>
            <li><a href="/Intranet/services-generaux/conventions/">Conventions</a></li>
            <li><a href="/Intranet/services-generaux/marches/">Marchés</a></li>
        </ul>
    </section>
    <section id="sidentifier">
        <header>
            <h3>Espace <?php
                if (isset($_SESSION['role'])) {
                    echo strtoupper($_SESSION['role']);
                } else {
                    echo "utilisateur";
                } ?></h3>
        </header>
        <ul class="link-list">
            <?php
            if (isset($_SESSION['nom'])) {
                $prenom = $_SESSION['prenom'];
                $nom = $_SESSION['nom'];
                $role = $_SESSION['role'];
                $direction = $_SESSION['nom_dir'];
                echo "<h5>" . ucfirst($prenom) . " " . strtoupper($nom) . "</h5>";
                echo '<li><a href="/Intranet/panel-utilisateur">Mes informations</a></li>';
                if ($role == 'admin') {
                    echo '<li><a href="/Intranet/tableaux/tableau-instructeurs.php">Tableaux instructeurs</a></li>
                    <li><a href="/Intranet/tableaux/tableau-directions.php">Tableaux directions</a></li>
                    <li><a href="/Intranet/tableaux/tableau-procedures.php">Tableaux procedures</a></li>
                    <li><a href="/Intranet/tableaux/tableau-types.php">Tableaux types</a></li>';
                }
                echo '<li><a href="/Intranet/inc/deconnexion.inc.php">Se déconnecter</a></li>';
            } else {
                echo '<li><a href="/Intranet/sidentifier.php">Connexion</a></li>';
                echo '<li><a href="/Intranet/enregistrerInstructeur.php">Enregistrement</a></li>';
            }
            ?>
        </ul>
    </section>
</div>