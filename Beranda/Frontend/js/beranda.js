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

// Scroll Driven Animation for Product Grid
    const productGrid = document.querySelector('.product-grid');
    const products = document.querySelectorAll('.product');

    let prevScrollPos = window.pageYOffset;

    window.addEventListener('scroll', () => {
      const currentScrollPos = window.pageYOffset;
      const gridTop = productGrid.getBoundingClientRect().top;
      const gridBottom = productGrid.getBoundingClientRect().bottom;

      if (currentScrollPos > prevScrollPos) { // Scrolling down
        products.forEach((product, index) => {
          const productTop = product.getBoundingClientRect().top;

          if (productTop < window.innerHeight && productTop > 0) {
            product.style.animation = `fadeIn 0.5s ease ${index * 0.1}s forwards`;
          } else {
            product.style.animation = 'none';
          }
        });
      } else { // Scrolling up
        products.forEach((product) => {
          product.style.animation = 'none';
        });
      }

      prevScrollPos = currentScrollPos;
    });

    // Scroll Driven Animation for Footer
    const footer = document.querySelector('.footer-section');

    window.addEventListener('scroll', () => {
      const footerTop = footer.getBoundingClientRect().top;
      const footerBottom = footer.getBoundingClientRect().bottom;

      if (footerTop < window.innerHeight && footerBottom > 0) {
        footer.style.animation = 'fadeIn 1s ease forwards';
      } else {
        footer.style.animation = 'none';
      }
    });


