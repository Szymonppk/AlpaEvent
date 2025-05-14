const menuIcon = document.querySelector(".mobile-icons");
const menu = document.querySelector("#mobile-menu");
const searchBar = document.querySelector(".search-bar");
const searchIcon = document.querySelector(".fa-magnifying-glass");
const boxText = document.querySelectorAll(".box-tekst");
const homeBox1 = document.querySelector("#home-box-1");
const homeBox2 = document.querySelector("#home-box-2");
const homeBox3 = document.querySelector("#home-box-3");
const username_letters = document.querySelector(".username-letters");
const username = username_letters.dataset.username;
const welcome_message = "Hello, " + username + "!";
let index_l = 0;

function typeWriter()
{
    if(index_l < welcome_message.length)
    {
        username_letters.innerHTML += welcome_message.charAt(index_l);
        index_l++;
        setTimeout(typeWriter,100);
    }
}

menuIcon.addEventListener("click", () => {

    menu.classList.toggle("show-element");
    searchBar.classList.toggle("hide-element");
    searchIcon.classList.toggle("hide-element");

});

homeBox1.addEventListener("mouseenter",()=> {

    boxText[0].classList.add("hide-element");
});

homeBox2.addEventListener("mouseenter",()=> {

    boxText[1].classList.add("hide-element");
});

homeBox3.addEventListener("mouseenter",()=> {

    boxText[2].classList.add("hide-element");
});

homeBox1.addEventListener("mouseleave",()=> {

    boxText[0].classList.toggle("hide-element");
});

homeBox2.addEventListener("mouseleave",()=> {

    boxText[1].classList.toggle("hide-element");
});

homeBox3.addEventListener("mouseleave",()=> {

    boxText[2].classList.toggle("hide-element");
});

homeBox2.addEventListener("click",()=>{

    alert("First create an event or choose one that already exists");
});

typeWriter();