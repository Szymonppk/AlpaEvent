const logout = document.querySelector("#logout");



const deleteBtn = document.querySelector(".button-delete");

deleteBtn.addEventListener("submit",(e) =>{


    if(!confirm('Are you sure you want to delete your account?'))
    {
        e.preventDefault();
    };
})


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
        console.error("Error", err);
    });
});
