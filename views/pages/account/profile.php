<div id="user-profile">
    <div class="profile-header">

        <button id="edit-avatar-btn" name="Modifier l'avatar du profil">
            <i class="fa fa-xl fa-image"></i>
        </button>

        <img class="avatar" src="<?= isset($userData['avatar']) ? htmlspecialchars($userData['avatar']) : 'assets/img/avatar-default.png'; ?>" alt="Avatar de l'utilisateur">

        <h1 class="<?= isset($userData['username']) ? '' : 'default-opacity'; ?>">
            <?= isset($userData['username']) ? htmlspecialchars($userData['username']) : 'Utilisateur'; ?>
        </h1>

        <span class="tribe <?= isset($userData['tribe']) ? '' : 'default-opacity'; ?>">
            <?= isset($userData['tribe']) ?  htmlspecialchars('Tribu ' . $userData['tribe']) : 'Tribu non définie'; ?>
        </span>

        <form id="edit-avatar-form" action="/profil" method="post">
            <button id="avatar-back-btn" name="Retour au profil">
                <i class="fa fa-lg fa-rotate-left"></i>
            </button>
            <input type="file" id="user-avatar-input" name="avatar" accept="image/*"/>
            <button type="submit" class="validation-btn" name="update_username"><i class="fa fa-lg fa-check"></i></button>
        </form>
    </div>


    <!-- NOM D'UTILISATEUR -->
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Nom d'utilisateur</h2>
            <button id="edit-username-btn" name="Modifier le nom d'utilisateur">
                <i class="fa fa-lg fa-edit"></i>
            </button>
            <button id="username-back-btn" name="Retour au profil">
                <i class="fa fa-lg fa-rotate-left"></i>
            </button>
        </div>

        <ul class="profile-info">
            <li>
                <i class="info-icon fa fa-user"></i>
                <span class="<?= isset($userData['username']) ? '' : 'default-opacity'; ?>">
                    <?= isset($userData['username']) ? htmlspecialchars($userData['username']) : 'Username non défini'; ?>
                </span>
                <form id="edit-username-form" action="/profil" method="post">
                    <input type="text" id="username" name="update_username" placeholder="Entrez votre pseudo d'utilisateur" value="<?= @$userData['username']?>">
                    <button type="submit" class="validation-btn"><i class="fa fa-lg fa-check"></i></button>
                </form>
            </li>
        </ul>
    </div>


    <!-- NOM DE LA TRIBU -->
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Nom de la tribu</h2>
            <button id="edit-tribe-btn" name="Modifier le nom de votre tribu">
                <i class="fa fa-lg fa-edit"></i>
            </button>
            <button id="tribe-back-btn" name="Retour au profil">
                <i class="fa fa-lg fa-rotate-left"></i>
            </button>
        </div>
        <ul class="profile-info">
            <li>
                <i class="info-icon fa fa-users"></i>
                <span class="<?= isset($userData['tribe']) ? '' : 'default-opacity'; ?>">
                    <?= isset($userData['tribe']) ? htmlspecialchars($userData['tribe']) : 'Tribu non définie'; ?>
                </span>
                <form id="edit-tribe-form" action="/profil" method="post">
                    <input type="text" id="tribe" name="update_tribe" placeholder="Entrez votre nom de tribu" value="<?= @$userData['tribe']?>">
                    <button type="submit" class="validation-btn"><i class="fa fa-lg fa-check"></i></button>
                </form>
            </li>
        </ul>
    </div>

    <!-- INFORMATION PERSONNELLE -->
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Informations personnelles</h2>
            <button id="edit-infos-btn" name="Modifier le nom de votre tribu">
                <i class="fa fa-lg fa-edit"></i>
            </button>
            <button id="infos-back-btn" name="Retour au profil">
                <i class="fa fa-lg fa-rotate-left"></i>
            </button>
        </div>
        <ul class="profile-info">
            <li>
                <i class="info-icon fa fa-phone"></i>
                <span class="<?= !empty($userData['phone']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['phone']) ? htmlspecialchars($userData['phone']) : 'Numéro non défini'; ?>
                </span>
            </li>
            <li>
                <i class="info-icon fa fa-envelope"></i>
                <span class="<?= isset($userData['email']) ? '' : 'default-opacity'; ?>">
                    <?= isset($userData['email']) ? htmlspecialchars($userData['email']) : 'Email non défini'; ?>
                </span>
            </li>
            <li>
                <i class="info-icon fa fa-calendar"></i>
                <span class="<?= isset($userData['birthdate_fr']) ? '' : 'default-opacity'; ?>">
                    <?= isset($userData['birthdate_fr']) ? ucfirst(htmlspecialchars($userData['birthdate_fr'])) : 'Date de naissance non définie'; ?>
                </span>
            </li>
            <form id="edit-infos-form" action="/profil" method="post">
                <input type="text" id="phone" name="update_phone" placeholder="Entrez votre numéro" value="<?= @$userData['phone']?>">
                <input type="text" id="mail" name="update_mail" placeholder="Entrez votre email" value="<?= @$userData['mail']?>">
                <button type="submit" class="validation-btn">Mettre a jour<i class="fa fa-lg fa-check"></i></button>
            </form>
        </ul>
    </div>


    <!-- DESCRIPTION -->
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Description</h2>
            <button id="edit-desc-btn" name="Modifier le nom de votre tribu">
                <i class="fa fa-lg fa-edit"></i>
            </button>
            <button id="desc-back-btn" name="Retour au profil">
                <i class="fa fa-lg fa-rotate-left"></i>
            </button>
        </div>
        <ul class="profile-info">
            <li>
                <i class="info-icon fa fa-message"></i>
                <span class="<?= !empty($userData['description']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['description']) ? htmlspecialchars($userData['description']) : 'Description non défini'; ?>
                </span>
                <form id="edit-desc-form" action="/profil" method="post">
                    <input type="text" id="description" name="update_description" placeholder="Entrez votre description" value="<?= @$userData['description']?>">
                    <button type="submit" class="validation-btn"><i class="fa fa-lg fa-check"></i></button>
                </form>
            </li>
        </ul>
    </div>

    <!-- SIGNATURE -->
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Signature</h2>
            <button id="edit-sign-btn" name="Modifier votre signature">
                <i class="fa fa-lg fa-edit"></i>
            </button>
            <button id="sign-back-btn" name="Retour au profil">
                <i class="fa fa-lg fa-rotate-left"></i>
            </button>
        </div>
        <ul class="profile-info">
            <li>
                <i class="info-icon fa fa-signature"></i>
                <span class="<?= !empty($userData['signature']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['signature']) ? htmlspecialchars($userData['signature']) : 'Signature non défini'; ?>
                </span>
                <form id="edit-sign-form" action="/profil" method="post">
                    <input type="text" id="signature" name="update_signature" placeholder="Entrez votre signature" value="<?= @$userData['signature']?>">
                    <button type="submit" class="validation-btn" name="update_username"><i class="fa fa-lg fa-check"></i></button>
                </form>
            </li>
        </ul>
    </div>

    <button type="submit" class="profile-pass-button">Modifier le mot de passe</button>
    <button type="submit" class="profile-delete-button">Supprimer mon compte</button>

    <div class="profile-footer">
        <span class="<?= isset($userData['registerDate_fr']) && isset($userData['role_name']) ? '' : 'default-opacity'; ?>">
            <?= isset($userData['registerDate_fr']) && isset($userData['role_name']) ? ucfirst(htmlspecialchars($userData['role_name'])) . ' inscrit depuis le ' . htmlspecialchars($userData['registerDate_fr']) : 'Rôle ou date d\'inscription non définis'; ?>
        </span>
    </div>

</div>

