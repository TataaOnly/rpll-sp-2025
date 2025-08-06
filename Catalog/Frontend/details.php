<?php /* Frontend only, fetches product detail from backend */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk | PlastikHB</title>
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

        .detail-container { display: flex; gap: 40px; max-width: 1100px; margin: 0 auto; }
        .image-section { flex: 1; display: flex; flex-direction: column; align-items: center; }
        .image-box { width: 300px; height: 250px; border: 1px solid #aaa; display: flex; align-items: center; justify-content: center; position: relative; margin-bottom: 16px; }
        .arrow { position: absolute; top: 50%; transform: translateY(-50%); font-size: 2rem; color: #888; cursor: pointer; user-select: none; }
        .arrow.left { left: 10px; }
        .arrow.right { right: 10px; }
        .image-label { color: #888; font-size: 1.1rem; }
        .desc-label { margin-top: 16px; font-weight: bold; font-size: 1.1rem; }
        .desc-box { margin-top: 4px; color: #444; }
        .info-section { flex: 2; display: flex; flex-direction: column; }
        .product-title { font-size: 2rem; font-weight: bold; margin-bottom: 8px; }
        .divider { border: none; border-top: 1px solid #ccc; margin: 8px 0 16px 0; }
        .info-list { margin-bottom: 32px; }
        .info-list span { display: block; font-size: 1.1rem; margin-bottom: 8px; }
        .order-btn { align-self: flex-end; background: #4cd964; color: #fff; border: none; border-radius: 20px; padding: 12px 32px; font-size: 1.2rem; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        .order-btn:hover { background: #38b653; }
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
        <div class="detail-container" id="detailContainer">
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
    function getQueryParam(name) {
        const url = new URL(window.location.href);
        return url.searchParams.get(name);
    }
    function renderDetail(product) {
        const container = document.getElementById('detailContainer');
        container.innerHTML = `
            <div class="image-section">
                <div class="image-box">
                    <span class="arrow left">&lt;</span>
                    <span class="image-label">Gambar</span>
                    <span class="arrow right">&gt;</span>
                </div>
                <div class="desc-label">Deskripsi</div>
                <div class="desc-box">${product.deskripsi ? product.deskripsi : '-'}</div>
            </div>
            <div class="info-section">
                <div class="product-title">${product.nama}</div>
                <hr class="divider">
                <div class="info-list">
                    <span>Harga: Rp ${parseInt(product.harga).toLocaleString('id-ID')}</span>
                    <span>Stok: ${product.stok}</span>
                </div>
                <button class="order-btn">Order Sekarang</button>
            </div>
        `;
    }
    function renderError(msg) {
        document.getElementById('detailContainer').innerHTML = `<div style="color:red;">${msg}</div>`;
    }
    const id = getQueryParam('id');
    if (!id) {
        renderError('ID produk tidak ditemukan di URL.');
    } else {
        fetch('../Backend/detail_controller.php?id=' + encodeURIComponent(id))
            .then(res => res.json())
            .then(data => {
                if (data && !data.error) renderDetail(data);
                else renderError(data.error || 'Produk tidak ditemukan.');
            })
            .catch(() => renderError('Gagal memuat detail produk.'));
    }
    </script>
</body>
</html>
