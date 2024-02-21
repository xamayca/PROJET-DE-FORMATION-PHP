<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- AUTRES META TAGS -->
    <meta name="author" content="France Survival">
    <meta name="keywords" content="France Survival, ARK: Survival Evolved, ARK: Survival Ascended, Communauté ARK, The Island, Taming, Breeding, Rates, PVE, PVP, Serveurs, Serveur ARK, Communauté ARK France, ARK Dinosaures, Stratégies ARK, ARK Mods, ARK Raids, ARK Communauté Française, ARK Serveurs FR, ARK Guides FR, ARK Tutoriels, ARK Cartes, ARK Événements, ARK Mises à jour, Fjordur, The center, Ragnarok, Scorched earth, lost island, crystal isles, aberration, Tribu ARK, Discord ARK, ARK Conseils, ARK Crafting, ARK Construction, ARK Exploration, Dinosaures">
    <meta name="description" content="Site de la communauté France Survival basée sur le jeu ARK: Survival Evolved et ARK: Survival Ascended. Serveurs ARK: Survival Evolved PVE en Cluster &amp; serveur ARK: Survival Ascended PVE. [Playstation, Xbox, Nintendo Switch, PC, Mobile]">
    <script src="https://kit.fontawesome.com/c8066bb5d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="assets/fonts/Roboto-Regular.ttf">
    <title>FRANCE SURVIVAL</title>
</head>

<body>

<!-- CREE UNE OMBRE QUAND ON OUVRE LE MENU VERSION MOBILE & TABLETTE -->
<div id="nav-shadow"></div>

    <!-- NAVIGATION BAR / NAVIGATION LINKS -->
    <nav>
        <a class="brand" href="/"><img src="assets/img/community/icon-francesurvival.svg" class="brand-logo" alt="ARK: France Survival logo">France survival</a>

        <i class="fa fa-2xl fa-bars" id="nav-open" aria-label="Ouvrir le menu de navigation"></i>
        <i class="fa fa-2xl fa-times" id="nav-close" aria-label="Fermer le menu de navigation"></i>

        <ul id="navigation-links">

            <li class="dropdown">
                <button class="dropdown-toggle">
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- SI L'UTILISATEUR EST CONNECTÉ -->
                        <?php if (!empty($_SESSION['user']['avatar'])): ?>
                            <!-- SI UN AVATAR EST DÉFINI, AFFICHEZ L'AVATAR -->
                            <img class="avatar" src="<?= htmlspecialchars(str_replace('../public', '',$_SESSION['user']['avatar'])); ?>" alt="Avatar de l'utilisateur">
                        <?php else: ?>
                            <!-- SINON, AFFICHEZ L'AVATAR PAR DÉFAUT -->
                            <img class="avatar" src="/assets/img/community/avatar-default.svg" alt="Avatar par défaut">
                        <?php endif; ?>
                        <!-- AFFICHEZ LE NOM D'UTILISATEUR -->
                        <i class="fa-solid fa-chevron-down"></i><?= htmlspecialchars($_SESSION['user']['username']) ?>
                    <?php else: ?>
                        <!-- SI L'UTILISATEUR N'EST PAS CONNECTÉ, AFFICHEZ SIMPLEMENT "COMPTE" -->
                        <img src="assets/img/community/avatar-default.svg" class="avatar" alt="Avatar par défaut">
                        <i class="fa-solid fa-chevron-down"></i>Compte
                    <?php endif; ?>
                </button>

                <ul class="sub-items">
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- SI L'UTILISATEUR EST CONNECTÉ -->
                        <li><a href="/profil">Mon Profil</a></li>
                        <li><a href="/deconnexion">Déconnexion</a></li>
                        <?php if ($_SESSION['user']['role_name'] == 'administrateur'): ?>
                            <!-- SI L'UTILISATEUR A LE RÔLE ADMINISTRATEUR -->
                            <li><a href="/admin">Espace Admin</a></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- SINON AFFICHER LES LIENS DE CONNEXION ET D'INSCRIPTION -->
                        <li><a href="/connexion">Connexion</a></li>
                        <li><a href="/inscription">Créer un compte</a></li>
                    <?php endif; ?>
                </ul>


                </li>
                <li>
                    <a href="/">Accueil</a>
                </li>

                <li class="dropdown">
                    <button class="dropdown-toggle">
                        <i class="fa-solid fa-chevron-down"></i>Actualités
                    </button>
                    <ul class="sub-items">
                        <li>
                            <a href="/actualites-communaute"><img src="assets/img/community/icon-francesurvival.svg" class="game-logo" alt="ARK: France Survival logo">Communauté</a>
                        </li>
                        <li>
                            <a href="/actualites-ark-survival-ascended"><img src="assets/img/navigation/icon-ASA.svg" class="game-logo" alt="ARK: Survival Ascended logo">ARK: Survival Ascended</a>
                        </li>
                        <li>
                            <a href="/actualites-ark-2"><img src="assets/img/navigation/icon-ARK2.svg" class="game-logo" alt="ARK: II logo">ARK: II</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="">Forum</a>
                </li>

                <li class="dropdown">
                    <button class="dropdown-toggle">
                        <i class="fa-solid fa-chevron-down"></i>Clusters
                    </button>
                    <ul class="sub-items">
                        <li>
                            <a href="">Serveurs PVE</a>
                        </li>
                        <li>
                            <a href="">Serveurs PVP</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="">Boutique</a>
                </li>

                <li class="dropdown">
                    <button class="dropdown-toggle">
                        <i class="fa-solid fa-chevron-down"></i>Guides
                    </button>
                    <ul class="sub-items">
                        <li>
                            <a href="">Tutoriels</a>
                        </li>
                        <li>
                            <a href="">Dino dossiers</a>
                        </li>
                    </ul>
                </li>

        </ul>
    </nav>

    <!-- AFFICHAGE DU MESSAGE DE SUCCÈS -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <p><?= $_SESSION['success'] ?></p>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- AFFICHAGE DE L'ERREUR GLOBALE (AVERTISSEMENT) -->
    <?php if (isset($_SESSION['warning'])): ?>
        <div class="alert alert-warning">
           <p><?= $_SESSION['warning'] ?></p>
        </div>
        <?php unset($_SESSION['warning']); ?>
    <?php endif; ?>


    <header>ICI MON HEADER POUR PAS PERDRE LA TETE</header>

<div class="container">