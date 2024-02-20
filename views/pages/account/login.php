<!-- FORMULAIRE DE CONNEXION -->
<form id="login-form" action="/connexion" method="POST">

    <h1>Connexion</h1>

    <div class="form-group">
        <label for="email">Adresse mail</label>
        <div class="input-with-icon">
            <input type="email" name="email" id="email" placeholder="exemple@mail.fr">
            <i class="fas fa-envelope"></i>
        </div>
        <?php if (isset($errors['email'])): ?>
            <div class="form-error">
                <p><?= $errors['email'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <div class="input-with-icon">
            <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe ici">
            <i class="fas fa-lock"></i>
        </div>
        <?php if (isset($errors['password'])): ?>
            <div class="form-error">
                <p><?= $errors['password'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <input class="form-button" type="submit" value="Se connecter">
</form>
