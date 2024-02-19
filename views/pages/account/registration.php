<div class="container">

<!-- FORMULAIRE D'INSCRIPTION -->
<form id="registration-form" action="/inscription" method="POST">
    <h1>Créer un compte</h1>
    <!-- CHAMP EMAIL -->
    <div class="form-group">
        <label for="email">Adresse mail</label>
        <div class="input-with-icon">
            <input type="email" name="email" id="email" placeholder="Entrez votre adresse mail" value="<?= htmlspecialchars($email ?? '') ?>">
            <i class="fas fa-envelope"></i>
        </div>
        <?php if (isset($errors['email'])): ?>
            <div class="form-error">
                <p><?= $errors['email'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- CHAMP NOM D'UTILISATEUR -->
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <div class="input-with-icon">
            <input type="text" name="username" id="username" placeholder="Entrez votre nom d'utilisateur" value="<?= htmlspecialchars($username ?? '') ?>">
            <i class="fas fa-user"></i>
        </div>
        <?php if (isset($errors['username'])): ?>
            <div class="form-error">
                <p><?= $errors['username'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- CHAMP MOT DE PASSE -->
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <div class="input-with-icon">
            <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">
            <i class="fas fa-lock"></i>
        </div>
        <?php if (isset($errors['password'])): ?>
            <div class="form-error">
                <p><?= $errors['password'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- CHAMP CONFIRMATION DU MOT DE PASSE -->
    <div class="form-group">
        <label for="password_confirm">Confirmation du mot de passe</label>
        <div class="input-with-icon">
            <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe">
            <i class="fas fa-lock"></i>
        </div>
        <?php if (isset($errors['password_confirm'])): ?>
            <div class="form-error">
                <p><?= $errors['password_confirm'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- CHAMP DATE DE NAISSANCE -->
    <div class="form-group">
        <label for="birthdate">Date de naissance</label>
        <div class="input-with-icon">
            <input type="date" name="birthdate" id="birthdate" placeholder="Entrez votre date de naissance" value="<?= htmlspecialchars($birthdate ?? '') ?>">
        </div>
        <?php if (isset($errors['birthdate'])): ?>
            <div class="form-error">
                <p><?= $errors['birthdate'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <input class="form-button" type="submit" name="submit" value="S'enregistrer">
</form>

</div>