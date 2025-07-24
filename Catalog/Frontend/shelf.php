<?php /* Frontend only, no PHP logic needed here */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | PlastikHB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 16px 32px;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            margin-right: 40px;
        }

        .nav {
            display: flex;
            gap: 32px;
        }

        .nav a {
            text-decoration: none;
            color: #222;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .nav a:hover {
            color: #0078d7;
        }

        .main {
            padding: 32px;
        }

        .catalog-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 24px;
        }

        .filter-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 16px;
            gap: 8px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 32px;
            max-width: 900px;
            margin: 0 auto 32px auto;
        }

        .product-card {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            position: relative;
            overflow: hidden;
        }

        .product-card .product-footer {
            background: #29aafc;
            color: #fff;
            text-align: center;
            padding: 12px 0;
            font-weight: 500;
            border-top: 1px solid #eee;
        }

        .product-card.habis {
            background: #eee;
        }

        .product-card.habis::before {
            content: 'Habis';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-20deg);
            color: #888;
            font-size: 2rem;
            font-weight: bold;
            opacity: 0.5;
            pointer-events: none;
        }

        .footer {
            border-top: 1px solid #ccc;
            text-align: center;
            padding: 16px;
            color: #888;
            margin-top: 32px;
        }

        .filter-row input[type="checkbox"] {
            margin-right: 8px;
            transform: scale(2.5)
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">PlastikHB</div>
        <nav class="nav">
            <a href="#">Beranda</a>
            <a href="#">Tentang Kami</a>
            <a href="#">Katalog Produk</a>
            <a href="#">Galeri Custom</a>
            <a href="#">Hubungi Kami</a>
        </nav>
    </div>
    <div class="main">
        <div class="catalog-title">Katalog Produk</div>
        <div class="filter-row">
            <input type="checkbox" id="hide-habis" onclick="toggleHabis()">
            <label for="hide-habis">Sembunyikan Barang Habis</label>
        </div>
        <div class="product-grid" id="productGrid">
            <div>Loading...</div>
        </div>
    </div>
    <div class="footer">&copy; Copyright from PlastikHB</div>
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
            // pasang image disini if needed
            // const img = document.createElement('img');
            // img.src = row.image_url;
            // img.alt = row.nama;
            // card.appendChild(img);
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
