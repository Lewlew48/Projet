<!-- Début de la section du menu de gauche -->
<div class="left-menu container col-xl-2 col-sm-12 mb-3" style="flex-shrink: 1;">
    <!-- Section des liens vers les pages -->
    <section id="menu" style="flex-shrink: 1;">
        <header>
            <h3>Pages</h3>
        </header>
        <ul class="link-list">
            <!-- Liens vers les pages spécifiques -->
            <li><a href="/Intranet/">Accueil</a></li>
            <li><a href="/Intranet/services-generaux/accords-cadres/">Accords Cadres</a></li>
            <li><a href="/Intranet/services-generaux/arretes-et-decisions/">Arrêtés et Décisions</a></li>
            <li><a href="/Intranet/services-generaux/conventions/">Conventions</a></li>
            <li><a href="/Intranet/services-generaux/marches/">Marchés</a></li>
        </ul>
    </section>
    <!-- Section de l'espace personnalisé pour chaque utilisateur -->
    <section id="sidentifier" style="flex-shrink: 1;">
        <header>
            <h3>Espace <?php
                // Affichage du rôle de l'utilisateur connecté
                if (isset($_SESSION['role'])) {
                    echo strtoupper($_SESSION['role']);
                } else {
                    echo "utilisateur";
                } ?></h3>
        </header>
        <ul class="link-list">
            <?php
            // Affichage des liens personnalisés en fonction de l'utilisateur connecté
            if (isset($_SESSION['nom'])) {
                $prenom = htmlentities($_SESSION['prenom']);
                $nom = htmlentities($_SESSION['nom']);
                $role = htmlentities($_SESSION['role']);
                $direction = htmlentities($_SESSION['nom_dir']);
                echo "<h5>" . ucfirst($prenom) . " " . strtoupper($nom) . "</h5>";
                echo '<li><a href="/Intranet/panel-utilisateur">Mes informations</a></li>';
                // Liens spéciaux pour les administrateurs
                if ($role == 'admin') {
                    echo '<li><a href="/Intranet/tableaux/tableau-instructeurs.php">Tableaux instructeurs</a></li>
                    <li><a href="/Intranet/tableaux/tableau-directions.php">Tableaux directions</a></li>
                    <li><a href="/Intranet/tableaux/tableau-procedures.php">Tableaux procedures</a></li>
                    <li><a href="/Intranet/tableaux/tableau-types.php">Tableaux types</a></li>';
                }
                echo '<li><a href="/Intranet/inc/deconnexion.inc.php">Se déconnecter</a></li>';
            } else {
                // Liens pour la connexion et l'enregistrement
                echo '<li><a href="/Intranet/sidentifier.php">Connexion</a></li>';
                echo '<li><a href="/Intranet/enregistrerInstructeur.php">Enregistrement</a></li>';
            }
            ?>
        </ul>
    </section>
</div>
<!-- Fin de la section du menu de gauche -->