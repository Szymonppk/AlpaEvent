window.addEventListener("DOMContentLoaded", async ()=>{

    const res = await fetch('/get-events');
    

    if(!res.ok)
    {
        const text = await res.text();
        console.error("Błąd odpowiedzi",text);
        return;
    }
    const events = await res.json();
    const mainContent = document.querySelector(".main-content");


    events.forEach( event =>{

        const eventBox = document.createElement("div");
        const eventContainer = document.createElement("div");
        const eventName = document.createElement("span");
        eventName.innerHTML = event.event_name;
        eventBox.classList.add('event-box');
        eventBox.style.backgroundImage = `url('${event.photo}')`;
        eventBox.style.backgroundSize = "cover";
        eventBox.style.backgroundPosition = "center";
        eventContainer.classList.add('event-container')
        
        mainContent.appendChild(eventContainer);
        eventContainer.appendChild(eventBox);
        eventContainer.appendChild(eventName)

    })

})