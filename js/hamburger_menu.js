// js/hamburger_menu.js
document.addEventListener("DOMContentLoaded", function() {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const sidebar = document.querySelector('nav.sidebar');

    hamburgerMenu.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
});
