window.addEventListener('DOMContentLoaded', async () => {
    initResponsiveHandling();
    initMenuToggle();
    getRoomInfo();
    initLogout();
});


function initResponsiveHandling() {
    const mq = window.matchMedia('(max-width:850px)');

    const handleWithChange = (e) => {
        const element = document.getElementById("main-mobile") || document.getElementById("main-desktop");
        if (!element) return;

        element.id = e.matches ? "main-mobile" : "main-desktop";
    };

    handleWithChange(mq);
    mq.addEventListener('change', handleWithChange);
}


function initMenuToggle() {
    const menuIcon = document.querySelector("#hamburger-menu");
    const menu = document.querySelector("#aside");
    const infoMobile = document.querySelector("#room-info-mobile");

    if (!menuIcon || !menu || !infoMobile) return;

    menuIcon.addEventListener("click", () => {
        menu.classList.toggle("show-element");
        infoMobile.classList.toggle("hide-element");
    });
}

async function getRoomInfo()
{
    const path = window.location.pathname;
    const parts = path.split("/");
    const roomId = parts[2];
    const res = await fetch(`/get-room-by-id?room_id=${roomId}`);
    const photo_desktop = document.querySelector("#user-room-photo");
    const photo_mobile = document.querySelector("#user-room-photo-mobile");
    const room_name = document.querySelectorAll(".room-name");
    const room_localisation = document.querySelector(".room-localisation");
    const room_date = document.querySelector(".room-date");
    const room_type = document.querySelector(".room-type");
    
    console.log(photo_desktop);
    if(!res.ok)
    {
        const error_text = res.text();
        console.error("Error",error_text);
        return;
    }

    const room_info = await res.json();
    console.log("room_info:", room_info);

    photo_desktop.style.backgroundImage = `url('/${room_info.photo}')`;
    photo_desktop.style.backgroundSize = "cover";
    photo_desktop.style.backgroundPosition = "center";
    photo_mobile.style.backgroundImage = `url('/${room_info.photo}')`;
    photo_mobile.style.backgroundSize = "cover";
    photo_mobile.style.backgroundPosition = "center";
    room_localisation.innerHTML = room_info.event_location;
    room_date.innerHTML = room_info.event_date;
    room_type.innerHTML = room_info.event_type;
    room_name.forEach(el => el.innerHTML =room_info.event_name);

}


function initLogout() {
    const logout = document.querySelector("#logout");
    if (!logout) return;

    logout.addEventListener("click", (e) => {
        e.preventDefault();

        fetch('/logout', { method: 'POST' })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/login";
                }
            })
            .catch(err => {
                console.error("Błąd podczas wylogowania:", err);
            });
    });
}

