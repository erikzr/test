const canvas = document.getElementById('signature');
const ctx = canvas.getContext('2d');

let isDrawing = false;

// Set up canvas
ctx.strokeStyle = 'black';
ctx.lineWidth = 2;
ctx.lineCap = 'round';

// Start drawing
canvas.addEventListener('mousedown', (e) => {
    isDrawing = true;
    ctx.beginPath();
    ctx.moveTo(e.offsetX, e.offsetY);
});

// Draw on canvas
canvas.addEventListener('mousemove', (e) => {
    if (isDrawing) {
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
    }
});

// Stop drawing
canvas.addEventListener('mouseup', () => {
    isDrawing = false;
});

// Clear canvas
document.getElementById('clear').addEventListener('click', () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
});

// Save signature as image
document.getElementById('save').addEventListener('click', () => {
    const dataURL = canvas.toDataURL('image/png');
    const signatureImage = document.getElementById('signatureImage');
    signatureImage.src = dataURL;
    signatureImage.style.display = 'block';
});
