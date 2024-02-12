    <div id="user-profile">

        <div class="profile-header">

            <!-- AFFICHE LE RÔLE DE L'UTILISATEUR -->
            <span>
                <?php echo isset($userData['role_name']) ?
                    htmlspecialchars($userData['role_name']) :
                    'Rôle non défini'; ?>
            </span>

            <img class="avatar" src="<?php echo isset($userData['avatar']) ?
                htmlspecialchars($userData['avatar']) :
                'assets/img/avatar-default.png'; ?>"
                 alt="Avatar de l'utilisateur">

                <h1>
                    <?php echo isset($userData['username']) ?
                     htmlspecialchars($userData['username']) :
                        'Utilisateur'; ?>
                </h1>

                <?php if (isset($userData['tribe'])) : ?>

                    <span>Tribu <?php echo htmlspecialchars($userData['tribe']); ?></span>
                <?php else : ?>
                    <span>Pas encore de tribu</span>
                <?php endif; ?>
        </div>




        <div class="profile-section">
            <?php echo isset($userData['description']) ?
                htmlspecialchars($userData['description']) :
                'Vous n\'avez pas encore de description';
            ?>
        </div>

        <div class="profile-section">
            <ul>
                <h2>Informations du compte</h2>
                <?php if (isset($userData['username']) && isset($userData['role_name'])) : ?>
                    <li>
                        <p>Nom d'utilisateur: <?php echo htmlspecialchars($userData['username']); ?></p>
                    </li>
                    <li>
                        <p>Role: <?php echo ucfirst(htmlspecialchars($userData['role_name'])); ?></p>
                    </li>
                <?php else : ?>
                    <li>
                        <p>Aucune information de compte disponible.</p>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

            <div class="profile-section">

                <p>Nom d'utilisateur:<?php echo isset($userData['username']) ? htmlspecialchars($userData['username']) : 'Vous n\'avez pas encore de nom d\'utilisateur'; ?></p>
                <p>Email:<?php echo isset($userData['email']) ? htmlspecialchars($userData['email']) : 'Vous n\'avez pas encore d\'email'; ?></p>
                <?php if (isset($userData['birthdate_fr'])) : ?>
                    <p>Date de Naissance: <?php echo htmlspecialchars($userData['birthdate_fr']); ?></p>
                <?php endif; ?>
                <p>Inscrit depuis: <?php echo isset($userData['registerDate_fr']) ? htmlspecialchars($userData['registerDate_fr']) : 'Non défini'; ?></p>
                <h2>Autres Informations</h2>
                <p>Téléphone: <?php echo isset($userData['phone']) ? htmlspecialchars($userData['phone']) : 'Non défini'; ?></p>
            </div>

        <div class="profile-section">
                <?php if (isset($userData['signature'])) : ?>
                   <span>" <?php echo htmlspecialchars($userData['signature']); ?> "</span>
                <?php else : ?>
                    <span>" Vous n'avez pas encore de signature "</span>
               <?php endif; ?>
        </div>

            <input class="profil-button" type="submit" value="Modifier mon profil">

                <?php echo isset($userData['role_name']) ?
                    ucfirst(htmlspecialchars($userData['role_name'])) :
                    'Non défini'; ?>

                <?php echo isset($userData['registerDate_fr']) ?
                    'Inscrit depuis ' . htmlspecialchars($userData['registerDate_fr']) :
                    'Non défini'; ?>


    </div>


