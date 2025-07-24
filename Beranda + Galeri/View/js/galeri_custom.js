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
