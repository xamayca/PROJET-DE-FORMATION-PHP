<div id="user-profile">

    <div class="profile-header">

        <button id="profile-button" name="Edition du profil">
            <i class="fa fa-xl fa-edit"></i>
        </button>


        <img class="avatar" src="<?= isset($userData['avatar']) ? htmlspecialchars($userData['avatar']) : 'assets/img/avatar-default.png'; ?>" alt="Avatar de l'utilisateur">

        <h1 class="<?= isset($userData['username']) ? '' : 'default-opacity'; ?>">
            <?= isset($userData['username']) ? htmlspecialchars($userData['username']) : 'Utilisateur'; ?>
        </h1>

        <span class="tribe <?= isset($userData['tribe']) ? '' : 'default-opacity'; ?>">
            <?= isset($userData['tribe']) ? htmlspecialchars($userData['tribe']) : 'Tribu non définie'; ?>
        </span>

    </div>

    <div class="desc <?= isset($userData['description']) ? '' : 'default-opacity'; ?>">
        <?= isset($userData['description']) ? htmlspecialchars($userData['description']) : 'Description non définie'; ?>
    </div>

    <ul>
        <li>
            <i class="fa fa-user"></i>
            <span class="<?= isset($userData['username']) ? '' : 'default-opacity'; ?>">
                <?= isset($userData['username']) ? htmlspecialchars($userData['username']) : 'Username non défini'; ?>
            </span>
        </li>
        <li>
            <i class="fa fa-envelope"></i>
            <span class="<?= isset($userData['email']) ? '' : 'default-opacity'; ?>">
                <?= isset($userData['email']) ? htmlspecialchars($userData['email']) : 'Email non défini'; ?>
            </span>
        </li>
        <li>
            <i class="fa fa-calendar"></i>
            <span class="<?= isset($userData['birthdate_fr']) ? '' : 'default-opacity'; ?>">
                <?= isset($userData['birthdate_fr']) ? ucfirst(htmlspecialchars($userData['birthdate_fr'])) : 'Date de naissance non définie'; ?>
            </span>
        </li>

        <li>
            <i class="fa fa-phone"></i>
            <span class="<?= !empty($userData['phone']) ? '' : 'default-opacity'; ?>">
                <?= !empty($userData['phone']) ? htmlspecialchars($userData['phone']) : 'Numéro non défini'; ?>
            </span>
        </li>
        <li>
            <i class="fa fa-pencil"></i>
            <span class="<?= isset($userData['signature']) ? '' : 'default-opacity'; ?>">
                <?= isset($userData['signature']) ? htmlspecialchars($userData['signature']) : 'Signature non définie'; ?>
            </span>
        </li>
    </ul>

    <div class="profile-footer">
        <span class="<?= isset($userData['registerDate_fr']) && isset($userData['role_name']) ? '' : 'default-opacity'; ?>">
            <?= isset($userData['registerDate_fr']) && isset($userData['role_name']) ? ucfirst(htmlspecialchars($userData['role_name'])) . ' inscrit depuis le ' . htmlspecialchars($userData['registerDate_fr']) : 'Rôle ou date d\'inscription non définis'; ?>
        </span>
    </div>



    <form id="edit-profile-form" action="/profile" method="post" class="form-group">
        <div class="profile-edit-form-header">
            <button id="form-profile-button" type="button" name="Retour au profil">
                <i class="fa fa-lg fa-chevron-left"></i> Retour au profil
            </button>
            <h2>Modification du profil</h2>
        </div>

        <div class="form-group">
            <label for="username">Pseudo d'utilisateur:</label>
            <div class="input-with-icon">
                <input type="text" id="username" name="username" placeholder="Entrez votre pseudo d'utilisateur" value="<?= isset($userData['username']) ? htmlspecialchars($userData['username']) : ''; ?>">
                <i class="fas fa-user"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Adresse email:</label>
            <div class="input-with-icon">
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" value="<?= isset($userData['email']) ? htmlspecialchars($userData['email']) : ''; ?>">
                <i class="fas fa-envelope"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Nouveau mot de passe:</label>
            <div class="input-with-icon">
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="confirm-password">Confirmez votre mot de passe:</label>
            <div class="input-with-icon">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre mot de passe">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="tribe">Tribu:</label>
            <div class="input-with-icon">
                <input type="text" id="tribe" name="tribe" placeholder="Entrez votre tribu" value="<?= isset($userData['tribe']) ? htmlspecialchars($userData['tribe']) : ''; ?>">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <div class="input-with-icon">
                <textarea id="description" name="description" placeholder="Entrez votre description"><?= isset($userData['description']) ? htmlspecialchars($userData['description']) : ''; ?></textarea>
                <i class="fas fa-align-left"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="phone">Numéro de téléphone:</label>
            <div class="input-with-icon">
                <input type="text" id="phone" name="phone" placeholder="Entrez votre numéro" value="<?= isset($userData['phone']) ? htmlspecialchars($userData['phone']) : ''; ?>">
                <i class="fas fa-phone"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="signature">Signature:</label>
            <div class="input-with-icon">
                <input type="text" id="signature" name="signature" placeholder="Entrez votre signature" value="<?= isset($userData['signature']) ? htmlspecialchars($userData['signature']) : ''; ?>">
                <i class="fas fa-signature"></i>
            </div>
        </div>

        <button type="submit" class="form-button">Mettre à jour le profil</button>
        <button type="submit" class="form-button">Supprimer mon compte</button>
    </form>


</div>

