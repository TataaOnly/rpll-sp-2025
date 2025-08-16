document.addEventListener("DOMContentLoaded", function () {
  const loadMoreBtn = document.getElementById("loadMoreBtn");
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", function () {
      const hiddenProducts = document.querySelectorAll(".hidden-product");
      hiddenProducts.forEach((el) => el.classList.remove("hidden-product"));
      this.style.display = "none"; 
    });
  }
});

document.querySelectorAll('.custom-product-grid .custom-product img').forEach(image => {
  image.onclick = () => {
    document.querySelector('.popup-custom-product').style.display = 'block';
    document.querySelector('.popup-custom-product img').src = image.getAttribute('src');
  }
});

document.querySelector('.popup-custom-product span').onclick = () =>{
  document.querySelector('.popup-custom-product').style.display = 'none';
}

// Scroll Driven Animation for Product Grid
const productGrid = document.querySelector('.product-grid');
const plastic_products = document.querySelectorAll('.product-card');

window.addEventListener('scroll', () => {
const gridTop = productGrid.getBoundingClientRect().top;
const gridBottom = productGrid.getBoundingClientRect().bottom;

plastic_products.forEach((product, index) => {
    const productTop = product.getBoundingClientRect().top;

    if (productTop < window.innerHeight && productTop > 0) {
    product.style.animation = `slideIn 0.5s ease ${index * 0.1}s forwards`;
    } else {
    product.style.animation = 'none';
    }
});
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