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


<!-- FORMULAIRE DE CONNEXION -->
<form id="connexion" action="/connexion" method="POST">
    <h1>Connexion</h1>
    <label for="email">Adresse mail</label>

    <input type="email" name="email" id="email" placeholder="exemple@mail.fr" value="<?= @$_COOKIE['email'] ?>">
    <?php if (isset($errors['email'])): ?>
        <p><?= $errors['email'] ?></p>
    <?php endif; ?>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe ici">
    <?php if (isset($errors['password'])): ?>
        <p><?= $errors['password'] ?></p>
    <?php endif; ?>

    <input type="submit" value="Se connecter">
</form>