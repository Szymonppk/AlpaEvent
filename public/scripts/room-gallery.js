document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;
    const parts = path.split("/");
    const roomId = parts[2];

    // Nasłuchiwanie na przycisk dodawania zdjęcia
    document.getElementById('add-photo-button').addEventListener('click', () => {
        document.getElementById('photo-upload').click();
    });

    // Nasłuchiwanie na zmianę pliku
    document.getElementById('photo-upload').addEventListener('change', async (e) => {
        const file = e.target.files[0];

        if (file) {

            const formData = new FormData();
            formData.append('photo', file);
            formData.append('roomId', roomId);

            const res = await fetch('/upload-photo', {
                method: 'POST',
                body: formData
            });

            const result = await res.json();

            if (res.ok && result.status === 'success') {
                addPhotoToGallery(result.photoPath);
            } else {
                alert('Error uploading photo');
            }
        }
    });

    // Funkcja dodająca zdjęcie do galerii
    function addPhotoToGallery(photoPath) {
        const photoGallery = document.getElementById('photo-gallery');

        const photoBlock = document.createElement('div');
        photoBlock.classList.add('photo-block');

        // Dodajemy domyślne tło (np. szare), dopóki zdjęcie się nie załaduje
        

        // Czekamy, aż zdjęcie będzie w pełni załadowane, zanim ustawimy je jako tło
        console.log(photoPath);

        photoBlock.style.backgroundImage = `url("${photoPath}")`; // Ustawiamy tło po załadowaniu zdjęcia
        photoBlock.style.backgroundSize = "cover";
        photoBlock.style.backgroundPosition = "center center";

        // Dodajemy event, który po kliknięciu wyświetli zdjęcie na pełnym ekranie
        photoBlock.addEventListener('click', () => {
            showFullScreenImage(photoPath);
        });

        photoGallery.appendChild(photoBlock);
    }

    // Funkcja do pełnoekranowego widoku zdjęcia
    function showFullScreenImage(photoPath) {
        const fullScreenContainer = document.createElement('div');
        fullScreenContainer.classList.add('full-screen-container');

        const img = document.createElement('img');
        img.src = photoPath;
        img.classList.add('full-screen-image');

        const closeButton = document.createElement('button');
        closeButton.textContent = 'Close';
        closeButton.addEventListener('click', () => {
            document.body.removeChild(fullScreenContainer);
        });

        fullScreenContainer.appendChild(img);
        fullScreenContainer.appendChild(closeButton);
        document.body.appendChild(fullScreenContainer);
    }
});
