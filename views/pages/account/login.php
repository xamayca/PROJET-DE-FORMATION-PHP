<form action="/connexion" method="POST">
    <h1>Connexion</h1>
    <label for="email">Adresse mail</label>
    <input type="email" name="email" id="email" placeholder="jean.dupont@mail.fr" value="<?= @$_COOKIE['email'] ?>">
    <?php if (isset($errors['email'])) { ?>
        <p><?= $errors['email'] ?></p>
    <?php } ?>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Azerty123!" value="<?= @$_COOKIE['password'] ?>">
    <?php if (isset($errors['password'])) : ?>
        <p><?= $errors['password'] ?></p>
    <?php endif; ?>

    <?php if (isset($errors['other'])) : ?>
        <p><?= $errors['other'] ?></p>
    <?php endif; ?>

    <div class="checkboxContainer">
        <input type="checkbox" name="remember" id="remember"><label for="remember">Se souvenir de moi</label>
    </div>
    <input type="submit" value="Se connecter">

    <!-- <php var_dump($_SESSION) ?> -->
</form>