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


<!-- FORMULAIRE DE CONNEXION -->
<form id="connexion-form" action="/connexion" method="POST">
    <h1>Connexion</h1>
    <label for="email">Adresse mail</label>

    <input type="email" name="email" id="email" placeholder="exemple@mail.fr" value="<?= @$_COOKIE['email'] ?>">
    <?php if (isset($errors['email'])): ?>
        <div class="form-error">
            <p><?= $errors['email'] ?></p>
        </div>
    <?php endif; ?>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe ici">
    <?php if (isset($errors['password'])): ?>
        <div class="form-error">
            <p><?= $errors['password'] ?></p>
        </div>
    <?php endif; ?>

    <input class="form-button" type="submit" value="Se connecter">
</form>