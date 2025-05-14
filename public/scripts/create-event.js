const event_photo_input = document.getElementById('event-photo');
const preview = document.getElementById('preview');
const menuIcon = document.querySelector(".mobile-icons");
const menu = document.querySelector("#mobile-menu");
const form = document.querySelector("#event-form");


event_photo_input.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'flex';
        }

        reader.readAsDataURL(file);
    }
});

menuIcon.addEventListener("click", () => {  

    menu.classList.toggle("show-element");


});


function initMap()
{
const input = document.getElementById('event_location');
const autocomplete = new google.maps.places.Autocomplete(input, {
  types: ['geocode'],
  fields: ['formatted_address', 'geometry']
});
}

