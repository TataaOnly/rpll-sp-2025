let products = [];

function renderProducts() {
    const grid = document.getElementById('productGrid');
    const hideHabis = document.getElementById('hide-habis').checked;
    grid.innerHTML = '';
    let found = false;
    products.forEach(row => {
        const habis = (parseInt(row.stok) <= 0 || row.status === 'Non-Aktif');
        if (hideHabis && habis) return;
        found = true;
        const card = document.createElement('div');
        card.className = 'product-card' + (habis ? ' habis' : '');
        card.setAttribute('data-habis', habis ? '1' : '0');
        card.style.cursor = 'pointer';
        card.onclick = function() {
            if (habis) {
                alert('Produk tidak tersedia atau stok habis.');
            } else {
                window.location.href = 'details.php?id=' + row.produk_id;
            }
        };
        // Render rectangular product image from DB (first image)
        let imgSrc = '../../images/noimg.png';
        if (Array.isArray(row.images) && row.images.length > 0 && row.images[0].file) {
            imgSrc = '../../uploads/' + row.images[0].file;
        }
        const img = document.createElement('img');
        img.src = imgSrc;
        img.alt = row.nama;
        img.style.width = '100%';
        img.style.height = '180px';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '8px 8px 0 0';
        card.appendChild(img);
        const footer = document.createElement('div');
        footer.className = 'product-footer';
        footer.textContent = row.nama;
        card.appendChild(footer);
        grid.appendChild(card);
    });
    if (!found) {
        grid.innerHTML = '<div>Tidak ada produk.</div>';
    }
}

function toggleHabis() {
    renderProducts();
}

fetch('../Backend/shelf_controller.php')
    .then(res => res.json())
    .then(data => { products = data; renderProducts(); })
    .catch(() => { document.getElementById('productGrid').innerHTML = '<div>Gagal memuat produk.</div>'; });

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