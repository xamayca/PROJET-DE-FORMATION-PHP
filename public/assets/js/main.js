const bodyHTML = document.body;

// ITEMS DE LA NAVIGATION & MENU MOBILE //
const navOpenHTML = document.getElementById('nav-open');
const navCloseHTML = document.getElementById('nav-close');
const navigationLinksHTML = document.getElementById('navigation-links');
const navShadowHTML = document.getElementById('nav-shadow');

// ITEM DU FORMULAIRE DE MODIFICATION DE PROFIL //
const EditProfilbuttonHTML = document.getElementById('profile-button');
const EditProfilFormHTML = document.getElementById('edit-profile-form');
const BackToProfilButtonHTML = document.getElementById('form-profile-button');

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
    navigationLinksHTML.classList.toggle('transform-x-0');
    navShadowHTML.style.opacity = '0';
});

// FERMETURE DU MENU MOBILE AU CLIQUE SUR L'OMBRE //
navShadowHTML.addEventListener('click', () => {
    navOpenHTML.style.display = 'block';
    navCloseHTML.style.display = 'none';
    navigationLinksHTML.classList.remove('transform-x-0');
    navShadowHTML.style.opacity = '0';
});

// FAIT APPARAÎTRE LE FORMULAIRE DE MODIFICATION DE PROFIL //
EditProfilbuttonHTML.addEventListener('click', () => {
    EditProfilFormHTML.classList.add('transform-x-0');
});

// FAIT DISPARAÎTRE LE FORMULAIRE DE MODIFICATION DE PROFIL //
BackToProfilButtonHTML.addEventListener('click', () => {
    EditProfilFormHTML.classList.remove('transform-x-100');
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
