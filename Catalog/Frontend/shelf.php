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
        }

        header {
            background-color: #0056b3;
            color: #fff;
            padding: 0 30px 0 30px;
        }

        h2,
        h3 {
            text-transform: uppercase;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        h3 {
            margin: 50px 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 0 5px;
            position: relative;
            color: inherit;
            text-decoration: none;
            transition: color 0.4s ease;
        }

        .nav-links a::after {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #75b6fc;
            transition: width 0.4s ease;
        }

        .nav-links a:hover {
            color: #75b6fc;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .logo img {
            width: 20%;
        }

        .main {
            padding: 32px 32px 20px 32px;
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

        .footer-section {
            position: relative;
            background: url('../../images/pabrikPlastikHB.jpg') center/cover no-repeat;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .footer-overlay {
            background-color: rgba(148, 163, 248, 0.8);
            /* Warna ungu transparan */
            padding: 60px 60px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1200px;
            margin: 0 auto;
            color: black;
        }

        .footer-left {
            width: 60%;
        }

        .footer-left .footer-logo {
            max-width: 200px;
            /* margin-bottom: 15px; */
            margin: 20px 0;
            height: 100%;
        }

        .footer-left p {
            font-size: 14px;
            line-height: 1.6;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        .footer-right {
            width: 35%;
        }

        .footer-right h3 {
            font-size: 20px;
            font-weight: bold;
            color: black;
            margin-bottom: 10px;
        }

        .footer-right p {
            color: black;
            font-size: 16px;
            line-height: 1.5;
        }

        .footer-bottom {
            background-color: #0056b3;
            /* biru */
            text-align: center;
            padding: 15px 0;
            font-size: 18px;
            font-weight: bold;
        }

        .filter-row input[type="checkbox"] {
            margin-right: 8px;
            transform: scale(2.5)
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo"><a href="../../Beranda + Galeri/View/beranda.php"><img src="../../images/logoBaru.png" alt=""></a></div>
            <div class="nav-links">
                <a href="../../Beranda + Galeri/View/beranda.php">Beranda</a>
                <a href="../../tentangkami/View/tentangkami.php">Tentang Kami</a>
                <a href="shelf.php">Katalog Produk</a>
                <a href="../../Beranda + Galeri/View/galeri_custom.php">Galeri Custom</a>
                <a href="../../hubungikami.php">Hubungi Kami</a>
            </div>
        </nav>
    </header>

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
    <footer class="footer-section">
      <div class="footer-overlay">
        <div class="footer-content">
            <div class="footer-left">
                <img src="../../images/logoBaru.png" alt="PlastikHB" class="footer-logo">
                <p>
                    LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD 
                    TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA.<br>
                    LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD 
                    TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA.<br>
                    LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD 
                    TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA.
                </p>
            </div>

            <div class="footer-right">
                <h3>Hubungi kami</h3>
                <p>Jl. lorem ipsum blablabal No. 111,<br>Bandung 40111
                <br>+62 11 1111111 (phone)
                <br>+62 22 2222222 (WhatsApp)
                <br>loremipsum@gmail.com</p>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        Copyright &copy; 2025 PlastikHB
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
            .then(data => {
                products = data;
                renderProducts();
            })
            .catch(() => {
                document.getElementById('productGrid').innerHTML = '<div>Gagal memuat produk.</div>';
            });
    </script>
</body>

</html>