const logout = document.querySelector("#logout");

logout.addEventListener("click",()=>{


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
        console.error("Błąd wylogowania", err);
    });
});
