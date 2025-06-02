document.getElementById('add-photo-button').addEventListener('click', () => {
    document.getElementById('photo-upload').click(); 
});

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

function addPhotoToGallery(photoPath) {
    const photoGallery = document.getElementById('photo-gallery');
    
    const photoBlock = document.createElement('div');
    photoBlock.classList.add('photo-block');
    
    photoBlock.style.backgroundImage = `url(${photoPath})`;
    
    photoBlock.addEventListener('click', () => {
        showFullScreenImage(photoPath);
    });

    photoGallery.appendChild(photoBlock);
}

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
