const menuOption = document.getElementById("optionsMenu");

window.addEventListener("DOMContentLoaded", async () => {

    const res = await fetch('/get-events');


    if (!res.ok) {
        const text = await res.text();
        console.error("Błąd odpowiedzi", text);
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

        eventBox.dataset.eventId = event.id;

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
    const eventId = menuOption.dataset.eventId;

    
    const res = await fetch(`/create-room?event_id=${eventId}`, {
      method: 'POST'
    });

    if (res.ok) {
      const { roomId } = await res.json();
      window.location.href = `/room/${roomId}`;
    } else {
      alert("Couldn't create room");
    }
  });

  joinBtn.addEventListener("click", async () => {
    const eventId = menuOption.dataset.eventId;

   
    const res = await fetch(`/get-first-room?event_id=${eventId}`);
    if (res.ok) {
      const { roomId } = await res.json();
      window.location.href = `/room/${roomId}`;
    } else {
      alert("Couldn't find room");
    }
  });

 
  document.addEventListener("click", (e) => {
  if (!e.target.closest(".event-container")) {
    menuOption.style.display = "none";
  }

});
