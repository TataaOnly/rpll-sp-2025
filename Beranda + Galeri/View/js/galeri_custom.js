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