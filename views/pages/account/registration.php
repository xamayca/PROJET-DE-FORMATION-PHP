<h1 style="margin-top:10vh;">Bienvenue sur la page d'inscription de FRANCE SURVIVAL</h1>

<?php if (isset($_SESSION['success'])) { ?>
    <p><?= $_SESSION['success'] ?></p>
    <?php unset($_SESSION['success']); ?>
<?php } ?>

<form action="/inscription" method="post">
    <label for="email">Adresse mail</label>
    <input type="email" name="email" id="email" placeholder="jean.dupont@gmail.com">
    <?php if (isset($errors['email'])) { ?>
        <p><?= $errors['email'] ?></p>
    <?php } ?>

    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" placeholder="Votre nom d'utilisateur ici" value="<?= htmlspecialchars($username ?? '') ?>">
    <?php if (isset($errors['username'])) { ?>
        <p><?= $errors['username'] ?></p>
    <?php } ?>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Taper votre mot de passe ici">
    <?php if (isset($errors['password'])) { ?>
        <p><?= $errors['password'] ?></p>
    <?php } ?>

    <label for="password_confirm">Confirmation du mot de passe</label>
    <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe ici">
    <?php if (isset($errors['passwordConfirm'])) { ?>
        <p><?= $errors['passwordConfirm'] ?></p>
    <?php } ?>

    <label for="birthdate">Date de naissance</label>
    <input type="date" name="birthdate" id="birthdate">
    <?php if (isset($errors['birthdate'])) { ?>
        <p><?= $errors['birthdate'] ?></p>
    <?php } ?>

    <input type="submit" name="submit" value="S'inscrire">

</form>