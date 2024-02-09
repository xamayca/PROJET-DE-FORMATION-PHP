<!-- AFFICHAGE DU MESSAGE DE SUCCÈS -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert-success">
        <p><?= $_SESSION['success'] ?></p>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- AFFICHAGE DE L'ERREUR GLOBALE (AVERTISSEMENT) -->
<?php if (isset($_SESSION['warning'])): ?>
    <div class="alert-warning">
        <p><?= $_SESSION['warning'] ?></p>
    </div>
    <?php unset($_SESSION['warning']); ?>
<?php endif; ?>


<!-- FORMULAIRE D'INSCRIPTION -->
<form id="registration" action="/inscription" method="POST">
    <h1>Inscription</h1>
    <!-- CHAMP EMAIL -->
    <label for="email">Adresse mail</label>
    <input type="email" name="email" id="email" placeholder="exemple@mail.fr" value="<?= htmlspecialchars($email ?? '') ?>">
    <?php if (isset($errors['email'])): ?>
        <div class="form-error">
            <p><?= $errors['email'] ?></p>
        </div>
    <?php endif; ?>

    <!-- CHAMP NOM D'UTILISATEUR -->
    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" placeholder="Entrer votre nom d'utilisateur ici" value="<?= htmlspecialchars($username ?? '') ?>">
    <?php if (isset($errors['username'])): ?>
        <div class="form-error">
            <p><?= $errors['username'] ?></p>
        </div>
    <?php endif; ?>

    <!-- CHAMP MOT DE PASSE -->
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe ici">
    <?php if (isset($errors['password'])): ?>
        <div class="form-error">
            <p><?= $errors['password'] ?></p>
        </div>
    <?php endif; ?>

    <!-- CHAMP CONFIRMATION DU MOT DE PASSE -->
    <label for="password_confirm">Confirmation du mot de passe</label>
    <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe">
    <?php if (isset($errors['password_confirm'])): ?>
        <div class="form-error">
            <p><?= $errors['password_confirm'] ?></p>
        </div>
    <?php endif; ?>

    <!-- CHAMP DATE DE NAISSANCE -->
    <label for="birthdate">Date de naissance</label>

    <!-- htmlspecialchars() ECHAPPE LES CARACTERES SPECIAUX -->
    <input type="date" name="birthdate" id="birthdate" value="<?= htmlspecialchars($birthdate ?? '') ?>">
    <?php if (isset($errors['birthdate'])): ?>
        <div class="form-error">
            <p><?= $errors['birthdate'] ?></p>
        </div>
    <?php endif; ?>

    <input type="submit" name="submit" value="S'inscrire">
</form>