// ITEMS DE LA NAVIGATION & MENU MOBILE //
const navOpenHTML = document.getElementById('nav-open');
const navCloseHTML = document.getElementById('nav-close');
const navigationLinksHTML = document.getElementById('navigation-links');
const navShadowHTML = document.getElementById('nav-shadow');

/** VARIABLE QUI GÈRE L'OUVERTURE & LA FERMETURE DES SOUS-MENUS DE LA NAVIGATION */
const toggleDropdown = (dropdown) => {
    const subItemsHTML = dropdown.querySelector('.sub-items');
    const dropdownIcon = dropdown.querySelector('.fa-chevron-down');
    const maxHeight = subItemsHTML.style.maxHeight;

    // TERNAIRE POUR DÉTERMINER SI LE SOUS-MENU EST OUVERT OU FERMÉ //
    subItemsHTML.style.maxHeight = maxHeight ? null : subItemsHTML.scrollHeight + 'px';
    // TERNAIRE POUR DÉTERMINER SI LE BORD DU SOUS-MENU EST AFFICHÉ OU NON //
    subItemsHTML.classList.toggle('sub-items-border', !maxHeight);
    // TERNAIRE POUR DÉTERMINER LA ROTATION DE L'ICÔNE DU SOUS-MENU //
    dropdownIcon.style.transform = maxHeight ? 'rotate(0deg)' : 'rotate(180deg)';
    dropdown.classList.toggle('active');
};

// AJOUTE UN ÉCOUTEUR D'ÉVÉNEMENT SUR CHAQUE ÉLÉMENT DE MENU DÉROULANT //
document.querySelectorAll('.dropdown').forEach(dropdown => {
    dropdown.addEventListener('click', (event) => {
        // SI L'ÉLÉMENT CLIQUÉ EST UN LIEN DE MENU DÉROULANT //
        if (event.target.classList.contains('dropdown-toggle')) {
            // APPEL DE LA FONCTION POUR OUVRIR OU FERMER LE SOUS-MENU //
            toggleDropdown(dropdown);
        }
    });
});


// ANIMATION DU MENU MOBILE A L'OUVERTURE //
navOpenHTML.addEventListener('click', () => {
    navOpenHTML.style.display = 'none';
    navCloseHTML.style.display = 'block';
    navigationLinksHTML.classList.add('transform-x-0');
    navShadowHTML.style.opacity = '1';
    navShadowHTML.style.transition = 'opacity 1s ease-in-out';
});

// ANIMATION DU MENU MOBILE A LA FERMETURE //
navCloseHTML.addEventListener('click', () => {
    navCloseHTML.style.display = 'none';
    navOpenHTML.style.display = 'block';
    navigationLinksHTML.classList.remove('transform-x-0');
    navShadowHTML.style.opacity = '0';
});

// FERMETURE DU MENU MOBILE AU CLIQUE SUR L'OMBRE //
navShadowHTML.addEventListener('click', () => {
    navOpenHTML.style.display = 'block';
    navCloseHTML.style.display = 'none';
    navigationLinksHTML.classList.remove('transform-x-0');
    navShadowHTML.style.opacity = '0';
});


// ITEMS DE MODIFICATION DE PROFIL HTML //
const EditAvatarButtonHTML = document.getElementById('edit-avatar-btn');

const EditUsernameButtonHTML = document.getElementById('edit-username-btn');
const UsernameBackToProfileBtnHTML = document.getElementById('username-back-btn');

const EditTribeButtonHTML = document.getElementById('edit-tribe-btn');
const TribeBackToProfileBtnHTML = document.getElementById('tribe-back-btn');

const EditDescButtonHTML = document.getElementById('edit-desc-btn');
const DescBackToProfileBtnHTML = document.getElementById('desc-back-btn');

const EditInfosButtonHTML = document.getElementById('edit-infos-btn');
const InfosBackToProfileBtnHTML = document.getElementById('infos-back-btn');

const EditSignButtonHTML = document.getElementById('edit-sign-btn');
const SignBackToProfileBtnHTML = document.getElementById('sign-back-btn');

const EditAvatarFormHTML = document.getElementById('edit-avatar-form');
const UsernameFormHTML = document.getElementById('edit-username-form');
const TribeFormHTML = document.getElementById('edit-tribe-form');
const InfosFormHTML = document.getElementById('edit-infos-form');
const DescFormHTML = document.getElementById('edit-desc-form');
const SignFormHTML = document.getElementById('edit-sign-form');

// FAIT APPARAÎTRE LE FORMULAIRE DE MODIFICATION D'AVATAR //
EditAvatarButtonHTML.addEventListener('click', () => {
    EditAvatarFormHTML.classList.add('transform-x-0');
});

// FAIT APPARAÎTRE LE FORMULAIRE DE MODIFICATION DE USERNAME //
EditUsernameButtonHTML.addEventListener('click', () => {
    UsernameFormHTML.classList.add('transform-x-0');
    EditUsernameButtonHTML.style.display = 'none';
    UsernameBackToProfileBtnHTML.style.display = 'block';
});

// FAIT DISPARAÎTRE LE FORMULAIRE DE MODIFICATION DE PROFIL //
UsernameBackToProfileBtnHTML.addEventListener('click', () => {
    UsernameFormHTML.classList.remove('transform-x-0');
    UsernameBackToProfileBtnHTML.style.display = 'none';
    EditUsernameButtonHTML.style.display = 'block';
});

// FAIT APPARAÎTRE LE FORMULAIRE DE MODIFICATION DE TRIBE //
EditTribeButtonHTML.addEventListener('click', () => {
    TribeFormHTML.classList.add('transform-x-0');
    EditTribeButtonHTML.style.display = 'none';
    TribeBackToProfileBtnHTML.style.display = 'block';
});

// FAIT DISPARAÎTRE LE FORMULAIRE DE MODIFICATION DE TRIBE //
TribeBackToProfileBtnHTML.addEventListener('click', () => {
    TribeFormHTML.classList.remove('transform-x-0');
    TribeBackToProfileBtnHTML.style.display = 'none';
    EditTribeButtonHTML.style.display = 'block';
});

// FAIT APPARAÎTRE LE FORMULAIRE DE MODIFICATION DE DESCRIPTION //
EditDescButtonHTML.addEventListener('click', () => {
    DescFormHTML.classList.add('transform-x-0');
    EditDescButtonHTML.style.display = 'none';
    DescBackToProfileBtnHTML.style.display = 'block';
});

// FAIT DISPARAÎTRE LE FORMULAIRE DE MODIFICATION DE DESCRIPTION //
DescBackToProfileBtnHTML.addEventListener('click', () => {
    DescFormHTML.classList.remove('transform-x-0');
    DescBackToProfileBtnHTML.style.display = 'none';
    EditDescButtonHTML.style.display = 'block';
});

// FAIT APPARAÎTRE LE FORMULAIRE DE MODIFICATION DE SIGNATURE //
EditSignButtonHTML.addEventListener('click', () => {
    SignFormHTML.classList.add('transform-x-0');
    EditSignButtonHTML.style.display = 'none';
    SignBackToProfileBtnHTML.style.display = 'block';
});

// FAIT DISPARAÎTRE LE FORMULAIRE DE MODIFICATION DE SIGNATURE //
SignBackToProfileBtnHTML.addEventListener('click', () => {
    SignFormHTML.classList.remove('transform-x-0');
    SignBackToProfileBtnHTML.style.display = 'none';
    EditSignButtonHTML.style.display = 'block';
});

// FAIT APPARAÎTRE LE FORMULAIRE DE MODIFICATION DES INFORMATIONS //
EditInfosButtonHTML.addEventListener('click', () => {
    InfosFormHTML.classList.add('transform-x-0');
    EditInfosButtonHTML.style.display = 'none';
    InfosBackToProfileBtnHTML.style.display = 'block';
});

// FAIT DISPARAÎTRE LE FORMULAIRE DE MODIFICATION DES INFORMATIONS //
InfosBackToProfileBtnHTML.addEventListener('click', () => {
    InfosFormHTML.classList.remove('transform-x-0');
    InfosBackToProfileBtnHTML.style.display = 'none';
    EditInfosButtonHTML.style.display = 'block';
});


// ITEMS DE MESSAGES DE SUCCÈS & D'AVERTISSEMENT HTML //
const messagesHTML = document.querySelectorAll('.alert-success, .alert-warning');
/** FONCTION POUR AFFICHER LES MESSAGES DE SUCCÈS & D'AVERTISSEMENT PENDANT 3 SECONDES */
function displayMessage(alerts) {
    alerts.classList.add('fade-in');

    setTimeout(() => {
        alerts.classList.remove('fade-in');
        alerts.classList.add('fade-out');

        setTimeout(() => {
            alerts.remove();
        }, 500);
    }, 3000);
}
// POUR CHAQUE MESSAGE, APPELEZ LA FONCTION POUR AFFICHER LE MESSAGE //
for (const alert of messagesHTML) {
    displayMessage(alert);
}
