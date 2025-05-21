window.addEventListener('DOMContentLoaded', () => {
    const mq = window.matchMedia('(max-width:850px)');

    function handleWithChange(e) {
        let element = document.getElementById("main-mobile") || document.getElementById("main-desktop");

        if (e.matches) {
            element.id = "main-mobile";
        } else {
            element.id = "main-desktop";
        }
    }

    const menuIcon = document.querySelector("#hamburger-menu");
    const menu = document.querySelector("#aside");
    const infoMobile = document.querySelector("#room-info-mobile");

    menuIcon.addEventListener("click", () => {

        menu.classList.toggle("show-element");
        infoMobile.classList.toggle("hide-element");
    })


    handleWithChange(mq);
    mq.addEventListener('change', handleWithChange);

    const logout = document.querySelector("#logout");

    logout.addEventListener("click", (e) => {

        e.preventDefault();

        fetch('/logout', {
            method: 'POST'
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/login";
                }
            })
            .catch(err => {
                console.error("Error", err);
            });
    });


});



