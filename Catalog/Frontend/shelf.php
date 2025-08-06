<?php /* Frontend only, no PHP logic needed here */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | PlastikHB</title>
    <link rel="stylesheet" href="css/shelf.css">
</head>

<body>
    <div class="page-container">
        <div class="header">
            <div class="logo"><a href="../../Beranda + Galeri/View/beranda.php"><img src="../../images/logoBaru.png" alt="PlastikHB Logo"></a></div>
            <nav class="nav-links">
                <a href="../../Beranda + Galeri/View/beranda.php">Beranda</a>
                <a href="../../tentangkami/tentangkami.php">Tentang Kami</a>
                <a href="shelf.php">Katalog Produk</a>
                <a href="../../Beranda + Galeri/View/galeri_custom.php">Galeri Custom</a>
                <a href="../../hubungikami/hubungikami.php">Hubungi Kami</a>
            </nav>
        </div>
        <div class="main">
            <div class="catalog-title"></div>
            <div class="button-right">
                <div class="filter-row">
                    <input type="checkbox" id="hide-habis" onclick="toggleHabis()">
                    <label for="hide-habis">Sembunyikan Barang Habis</label>
                </div>
            </div>
            <div class="product-grid" id="productGrid">
                <div>Loading...</div>
            </div>
        </div>
        <div class="footer">&copy; Copyright from PlastikHB</div>
    </div>
    <script>
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
    </script>
</body>
</html>
