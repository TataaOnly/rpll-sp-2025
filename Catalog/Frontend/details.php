<?php /* Frontend only, fetches product detail from backend */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk | PlastikHB</title>
    <link rel="stylesheet" href="css/details.css">
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
            <div class="detail-container" id="detailContainer">
                <div>Loading...</div>
            </div>
        </div>
        <div class="footer">Copyright from PlastikHB</div>
    </div>
    <script>
    function getQueryParam(name) {
        const url = new URL(window.location.href);
        return url.searchParams.get(name);
    }
    function renderDetail(product) {
        const container = document.getElementById('detailContainer');
        container.innerHTML = `
            <div class="detail-flex">
                <div class="detail-left">
                    <div class="image-box">
                        <span class="arrow left">&lt;</span>
                        <span class="image-label">Gambar</span>
                        <span class="arrow right">&gt;</span>
                    </div>
                    <div class="desc-label">Deskripsi</div>
                    <div class="desc-box">${product.deskripsi ? product.deskripsi : '-'}</div>
                </div>
                <div class="detail-right">
                    <div class="product-title">${product.nama}</div>
                    <hr class="divider">
                    <div class="info-list">
                        <span>Harga: Rp ${parseInt(product.harga).toLocaleString('id-ID')}</span>
                        <span>Stok: ${product.stok}</span>
                    </div>
                    <button class="order-btn">Order Sekarang</button>
                </div>
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
