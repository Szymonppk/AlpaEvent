const search_input = document.querySelector('.input');
const roomIdAtr = document.querySelector(".room-option").getAttribute("data-room-id");
const roomId = parseInt(roomIdAtr);

search_input.addEventListener('input',async(e) => {

    const query = e.target.value;

    if(query.length <2) return;

    const res = await fetch('/search-user',{

        method:'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({query})

    });

    const users = await res.json();

    const searchContainer = document.querySelector('.search-result');
    searchContainer.innerHTML ='';

    const friendBox = document.createElement('div');
    friendBox.classList.add('friend-box');

    users.forEach(user => {
        const friendItem = document.createElement('div');
        friendItem.classList.add('friend-item');
    
        const usernameSpan = document.createElement('span');
        usernameSpan.textContent = user.username;
    
        const addButton = document.createElement('button');
        const plus = document.createElement('i');
        plus.classList.add('fa-solid', 'fa-user-plus');

        addButton.addEventListener('click', () => addFriend(user.user_id));
        addButton.appendChild(plus);
        friendItem.appendChild(usernameSpan);
        friendItem.appendChild(addButton);
    
        friendBox.appendChild(friendItem);
    });
    

    searchContainer.appendChild(friendBox);
});

window.addEventListener('DOMContentLoaded', async () => {
        const res = await fetch(`/get-participants?roomId=${roomId}`, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    });

    const friends = await res.json();

    const staticContainer = document.querySelector('.static-friend');

    friends.forEach(friend => {
        const friendBox = document.createElement('div');
        friendBox.classList.add('friend-box');

        const friendItem = document.createElement('div');
        friendItem.classList.add('friend-item');
        friendItem.textContent = friend.username;

        friendBox.appendChild(friendItem);
        staticContainer.appendChild(friendBox);
    });
});

async function addFriend(friendId) {

    console.log({ friendId, roomId });

    const res = await fetch('/add-user', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({friendId:friendId,roomId:roomId})
    });

    if (res.ok) {
        alert("Friend added!"); 
    } else {
        alert("Error adding friend.");
    }
}