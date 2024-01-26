const bodyHTML = document.body;
const dropdownsHTML = document.querySelectorAll('.dropdown');
const navOpenHTML = document.getElementById('nav-open');
const navCloseHTML = document.getElementById('nav-close');
const navigationLinksHTML = document.getElementById('navigation-links');

// SE DÉCLENCHE UNIQUEMENT SUR LES RESOLUTION INFÉRIEUR A 768px //
if (window.innerWidth <= 768) {
    /** FONCTION QUI GÈRE L'OUVERTURE & LA FERMETURE DES SOUS-MENUS DE LA NAVIGATION */
    const toggleDropdown = (dropdown) => {
        const subItemsHTML = dropdown.querySelector('.sub-items');
        const dropdownIcon = dropdown.querySelector('.fa-chevron-down');

        if (subItemsHTML.style.maxHeight) {
            subItemsHTML.style.maxHeight = null;
            dropdownIcon.style.transform = 'rotate(0deg)';
            subItemsHTML.classList.remove('sub-items-border');
            dropdown.classList.remove('active');
        } else {
            subItemsHTML.style.maxHeight = subItemsHTML.scrollHeight + 'px';
            dropdownIcon.style.transform = 'rotate(180deg)';
            subItemsHTML.classList.add('sub-items-border');
            dropdown.classList.add('active');
        }
    };


    dropdownsHTML.forEach(dropdown => {
        dropdown.addEventListener('click', function (event) {
            // SI LE CLIC EST FAIT SUR AUTRE CHOSE QU'UN DROPDOWN MENU, NE RIEN FAIRE //
            if (!event.target.classList.contains('dropdown-toggle')) {
                return;
            }
            // ANNULE LE COMPORTEMENT PAR DÉFAUT DES ELEMENTS HTML LORS D'INTERACTION //
            event.preventDefault();
            toggleDropdown(dropdown);
        });
    });

    // AJOUTE DES STYLES / CLASS A L'OUVERTURE DU MENU MOBILE //
    navOpenHTML.addEventListener('click', function () {
        navOpenHTML.style.display = 'none';
        navCloseHTML.style.display = 'block';
        navigationLinksHTML.classList.add('d-initial');
        bodyHTML.style.overflow = 'hidden';
    });

    // RETIRE DES STYLES / CLASS A L'OUVERTURE DU MENU MOBILE //
    navCloseHTML.addEventListener('click', function () {
        navCloseHTML.style.display = 'none';
        navOpenHTML.style.display = 'block';
        navigationLinksHTML.classList.remove('d-initial');
        bodyHTML.style.overflow = '';
    });

}