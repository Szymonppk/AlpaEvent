const menuOption = document.getElementById("optionsMenu");

window.addEventListener("DOMContentLoaded", async () => {

    //AJAX API

    const res = await fetch('/get-events');


    if (!res.ok) {
        const text = await res.text();
        console.error("Error", text);
        return;
    }
    const events = await res.json();
    const mainContent = document.querySelector(".main-content");


    events.forEach(event => {

        const eventBox = document.createElement("div");
        const eventContainer = document.createElement("div");
        const eventName = document.createElement("span");
        eventName.innerHTML = event.event_name;
        eventBox.classList.add('event-box');
        eventBox.style.backgroundImage = `url('${event.photo}')`;
        eventBox.style.backgroundSize = "cover";
        eventBox.style.backgroundPosition = "center";
        eventContainer.classList.add('event-container');

        eventBox.dataset.eventId = event.event_id;

        mainContent.appendChild(eventContainer);
        eventContainer.appendChild(eventBox);
        eventContainer.appendChild(eventName);
        
        eventBox.addEventListener("click", (e) => {
            
            const rect = eventBox.getBoundingClientRect();

            const eventId = eventBox.dataset.eventId;
            menuOption.dataset.eventId = eventId;

            eventContainer.appendChild(menuOption);
            menuOption.style.display = "block";
        });

    });

});

  
  
  const createBtn = document.getElementById("createRoomBtn");
  const joinBtn = document.getElementById("joinRoomBtn");

  createBtn.addEventListener("click", async () => {
    const event_id = menuOption.dataset.eventId;

    console.log("Ustawiono event ID:", event_id);
    const res = await fetch(`/create-room?event_id=${event_id}`, {
      method: 'POST'
    });

    if (res.ok) {
      const { room_id } = await res.json();
      window.location.href = `/room/${room_id}/room-dashboard`;
    } else {
      alert("Couldn't create room");
    }
  });

  joinBtn.addEventListener("click", async () => {
    const event_id = menuOption.dataset.eventId;
    
   
    const res = await fetch(`/get-first-room?event_id=${event_id}`);
    if (res.ok) {
      const { room_id } = await res.json();
      window.location.href = `/room/${room_id}/room-dashboard`;
    } else {
      alert("Couldn't find room");
    }
  });

 
  document.addEventListener("click", (e) => {
  if (!e.target.closest(".event-container")) {
    menuOption.style.display = "none";
  }

});
