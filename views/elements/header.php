<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <a class="brand" href="/"><img src="assets/img/navigation/icon-francesurvival.svg" class="brand-logo" alt="ARK: France Survival logo">France survival</a>

        <img src="assets/img/navigation/menu-open.svg" id="nav-open" alt="Icône du menu mobile ouverture">
        <img src="assets/img/navigation/menu-close.svg" id="nav-close" alt="Icône du menu mobile fermeture">

        <ul id="navigation-links">

            <li class="dropdown">
                    <button class="dropdown-toggle">
                        <?php if (isset($_SESSION['user'])): ?>
                            <!-- SI L'UTILISATEUR EST CONNECTER ON AFFICHE SON PSEUDONYME -->
                            <img src="assets/img/avatar-default.png" class="avatar" alt="Avatar de l'utilisateur">
                            <i class="fa-solid fa-chevron-down"></i><?= htmlspecialchars($_SESSION['user']['username']) ?>
                        <?php else: ?>
                            <!-- SINON ON AFFICHE SEULEMENT COMPTE -->
                            <img src="assets/img/avatar-default.png" class="avatar" alt="Avatar par défaut">
                            <i class="fa-solid fa-chevron-down"></i>Compte
                        <?php endif; ?>
                    </button>

                    <ul class="sub-items">
                        <?php if (isset($_SESSION['user'])): ?>
                            <!-- SI L'UTILISATEUR EST CONNECTER ON AFFICHE LES LIENS SUIVANTS -->
                            <li><a href="/profil">Mon Profil</a></li>
                            <li><a href="/deconnexion">Déconnexion</a></li>
                        <?php else: ?>
                            <!-- SINON ON AFFICHE LES LIENS CONNEXION & INSCRIPTION -->
                            <li><a href="/connexion">Connexion</a></li>
                            <li><a href="/inscription">Crée un compte</a></li>
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
                            <a href=""><img src="assets/img/navigation/icon-francesurvival.svg" class="game-logo" alt="ARK: France Survival logo">Communauté</a>
                        </li>
                        <li>
                            <a href=""><img src="assets/img/navigation/icon-ASA.webp" class="game-logo" alt="ARK: Survival Ascended logo">ARK: Survival Ascended</a>
                        </li>
                        <li>
                            <a href=""><img src="assets/img/navigation/icon-ARK2.png" class="game-logo" alt="ARK: II logo">ARK: II</a>
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
