const menuIcon = document.querySelector(".mobile-icons");
const menu = document.querySelector("#mobile-menu");
const searchBar = document.querySelector(".search-bar");
const searchIcon = document.querySelector(".fa-magnifying-glass");

menuIcon.addEventListener("click", () => {

    menu.classList.toggle("show-element");
    searchBar.classList.toggle("hide-element");
    searchIcon.classList.toggle("hide-element");

});


