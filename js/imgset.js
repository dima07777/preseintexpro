function openImageDialog() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = e => {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const img = new Image();
            img.src = reader.result;
            img.id = 'outputImage';
            
            const square = document.getElementById('square');
            square.innerHTML = '';
            square.appendChild(img);
        };

        reader.readAsDataURL(file);
    };
    input.click();
}