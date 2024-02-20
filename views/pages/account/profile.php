<div id="user-profile">
    <div class="profile-header">

        <button id="edit-avatar-btn" name="Modifier l'avatar du profil">
            <i class="fa fa-xl fa-image"></i>
        </button>

        <?php if (!empty($userData['avatar'])): ?>
            <img class="avatar" src="<?= htmlspecialchars(str_replace('../public', '', $userData['avatar'])); ?>" alt="Avatar de l'utilisateur">
        <?php else: ?>
            <img class="avatar" src="assets/img/community/avatar-default.svg" alt="Avatar par défaut">
        <?php endif; ?>

        <h1 class="<?= isset($userData['username']) ? '' : 'default-opacity'; ?>">
            <?= !empty($userData['username']) ? htmlspecialchars($userData['username']) : 'Utilisateur'; ?>
        </h1>

        <span class="tribe <?= isset($userData['tribe']) ? '' : 'default-opacity'; ?>">
            <?= !empty($userData['tribe']) ?  htmlspecialchars('Tribu ' . $userData['tribe']) : 'Tribu non définie'; ?>
        </span>

        <form id="edit-avatar-form" action="/profil" method="post" enctype="multipart/form-data">
            <div class="form-group">
                    <h2>Modifier l'avatar</h2>
                    <label for="user-avatar-input" class="custom-file-upload">
                        Choisir un fichier
                    </label>
                    <input type="file" id="user-avatar-input" name="avatar" accept="image/*"/>
            </div>
            <div class="form-btn-group">
                <button type="submit" id="avatar_btn">
                    Envoyer
                </button>
                <button id="avatar-back-btn" name="Retour au profil">
                    Fermer
                </button>
            </div>
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
                <label for="username" class="<?= !empty($userData['username']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['username']) ? htmlspecialchars($userData['username']) : 'Nom d\'utilisateur non défini'; ?>
                </label>
                <form id="edit-username-form" action="/profil" method="post">
                    <input type="text" id="username" name="username" placeholder="Entrez votre pseudo d'utilisateur" value="<?= @$userData['username']?>">
                    <button type="submit" class="validate-btn"><i class="fa fa-lg fa-check"></i></button>
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
                <label for="tribe" class="<?= !empty($userData['tribe']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['tribe']) ? htmlspecialchars($userData['tribe']) : 'Tibu non définie'; ?>
                </label>
                <form id="edit-tribe-form" action="/profil" method="post">
                    <input type="text" id="tribe" name="tribe" placeholder="Entrez votre nom de tribu" value="<?= @$userData['tribe']?>">
                    <button type="submit" class="validate-btn"><i class="fa fa-lg fa-check"></i></button>
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
                <label for="phone" class="<?= !empty($userData['phone']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['phone']) ? htmlspecialchars($userData['phone']) : 'Téléphone non défini'; ?>
                </label>
            </li>
            <li>
                <i class="info-icon fa fa-envelope"></i>
                <label for="email" class="<?= !empty($userData['email']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['email']) ? htmlspecialchars($userData['email']) : 'Email non défini'; ?>
                </label>
            </li>
            <li>
                <i class="info-icon fa fa-calendar"></i>
                <label for="description" class="<?= !empty($userData['birthdate_fr']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['birthdate_fr']) ? htmlspecialchars($userData['birthdate_fr']) : 'Date de naissance non définie'; ?>
                </label>
            </li>
            <form id="edit-infos-form" action="/profil" method="post">
                <input type="text" id="phone" name="phone" placeholder="Entrez votre numéro" value="<?= @$userData['phone']?>">
                <input type="text" id="email" name="mail" placeholder="Entrez votre email" value="<?= @$userData['mail']?>">
                <button type="submit" class="validate-btn">Mettre a jour<i class="fa fa-lg fa-check"></i></button>
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
                <label for="description" class="<?= !empty($userData['description']) ? '' : 'default-opacity'; ?>">
                    <?= !empty($userData['description']) ? htmlspecialchars($userData['description']) : 'Description non définie'; ?>
                </label>
                <form id="edit-desc-form" action="/profil" method="post">
                    <textarea id="description" name="description" placeholder="Entrez votre description" value="<?= @$userData['description']?>"></textarea>
                    <button type="submit" class="validate-btn"><i class="fa fa-lg fa-check"></i></button>
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
                <label for="signature" class="<?= isset($userData['signature']) ? '' : 'default-opacity'; ?>">
                    <?= isset($userData['signature']) ? htmlspecialchars($userData['signature']) : 'Signature non définie'; ?>
                </label>
                <form id="edit-sign-form" action="/profil" method="post">
                    <input type="text" id="signature" name="signature" placeholder="Entrez votre signature">
                    <button type="submit" class="validate-btn"><i class="fa fa-lg fa-check"></i></button>
                </form>
            </li>
        </ul>
    </div>

    <button type="button" id="password-account-btn">Modifier le mot de passe</button>
    <button type="button" id="delete-account-btn">Supprimer mon compte</button>

    <div class="profile-footer">
        <span class="<?= isset($userData['registerDate_fr']) && isset($userData['role_name']) ? '' : 'default-opacity'; ?>">
            <small><?= isset($userData['registerDate_fr']) && isset($userData['role_name']) ? ucfirst(htmlspecialchars($userData['role_name'])) . ' inscrit depuis le ' . htmlspecialchars($userData['registerDate_fr']) : 'Rôle ou date d\'inscription non définis'; ?></small>
        </span>
    </div>

    <form id="delete-account-form" action="/profil" method="post">
        <h2>Confirmé la suppression</h2>
        <input type="hidden" name="delete_account" value="1">
        <div class="form-btn-group">
            <button type="submit" id="delete-account-confirm">Oui</button>
            <button type="button" id="delete-account-cancel">Non</button>
        </div>
    </form>

    <form id="modify-password-form" action="/profil" method="post">
        <h2>Modifier le mot de passe</h2>
        <div class="form-group">
            <div class="input-with-icon">
                <label for="current_password">Mot de passe actuel :</label>
                <input type="password" id="current_password" name="current_password" placeholder="Entrez votre mot de passe actuel">
                <i class="fas fa-lock"></i>
                <?php if (isset($errors['current_password'])): ?>
                    <div class="form-error">
                        <p><?= $errors['current_password'] ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="input-with-icon">
                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" id="new_password" name="new_password" placeholder="Entrez votre nouveau mot de passe">
                <i class="fas fa-lock"></i>
                <?php if (isset($errors['new_password'])): ?>
                    <div class="form-error">
                        <p><?= $errors['new_password'] ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="input-with-icon">
                <label for="password_confirm">Confirmez le mot de passe :</label>
                <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmez votre nouveau mot de passe">
                <i class="fas fa-lock"></i>
                <?php if (isset($errors['password_confirm'])): ?>
                    <div class="form-error">
                        <p><?= $errors['password_confirm'] ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-btn-group">
            <button type="submit" id="modify-password-confirm" name="modify_password">Confirmer</button>
            <button type="button" id="modify-password-cancel">Annuler</button>
        </div>
    </form>

</div>

