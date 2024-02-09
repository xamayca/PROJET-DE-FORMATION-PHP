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