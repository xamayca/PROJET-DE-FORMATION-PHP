const dropdownsHTML = document.querySelectorAll(".dropdown");
// FONCTION QUI GÈRE L'OUVERTURE & LA FERMETURE DES SOUS MENU DE LA NAVIGATION //
const toggleDropdown = (dropdown) => {
    const subItemsHTML = dropdown.querySelector(".sub-items");
    const dropdownIcon = dropdown.querySelector(".dropdown-icon");

    if (subItemsHTML.style.maxHeight) {
        subItemsHTML.style.maxHeight = null;
        dropdownIcon.style.transform = "rotate(0deg)";
        subItemsHTML.classList.remove("sub-items-open");
        dropdown.classList.remove("active");
    } else {
        subItemsHTML.style.maxHeight = subItemsHTML.scrollHeight + "px";
        dropdownIcon.style.transform = "rotate(180deg)";
        subItemsHTML.classList.add("sub-items-open");
        dropdown.classList.add("active");
    }
};

// Attacher l'événement click à tous les dropdowns
dropdownsHTML.forEach(dropdown => {
    dropdown.addEventListener("click", function (event) {
        event.preventDefault();
        toggleDropdown(dropdown);
    });
});


