const images = document.querySelectorAll('.image-container img');
const dots = document.querySelectorAll('.image-container .dot');
let currentIndex = 0;

function showImage(index) {
  images.forEach((img, i) => {
    img.style.opacity = i === index ? '1' : '0';
  });
  dots.forEach((dot, i) => {
    dot.classList.toggle('active', i === index);
  });
  currentIndex = index;
}

dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    showImage(index);
  });
});

function cycleImages() {
  currentIndex = (currentIndex + 1) % images.length;
  showImage(currentIndex);
}

setInterval(cycleImages, 5000);


