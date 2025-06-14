const search_input = document.querySelector('.input');

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

async function getFriends()
{ 
    const res = await fetch('/get-friends');
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
}

async function addFriend(friendId) {
    const res = await fetch('/add-friend', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({friendId})
    });

    if (res.ok) {
        alert("Friend added!"); 
    } else {
        alert("Error adding friend.");
    }
}

getFriends();