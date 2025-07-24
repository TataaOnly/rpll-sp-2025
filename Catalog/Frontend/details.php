<?php /* Frontend only, fetches product detail from backend */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk | PlastikHB</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #fff; }
        .header { display: flex; align-items: center; border-bottom: 1px solid #ccc; padding: 16px 32px; }
        .logo { font-size: 2rem; font-weight: bold; margin-right: 40px; }
        .nav { display: flex; gap: 32px; }
        .nav a { text-decoration: none; color: #222; font-weight: 500; font-size: 1.1rem; }
        .nav a:hover { color: #0078d7; }
        .main { padding: 32px; }
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
        .footer { border-top: 1px solid #ccc; text-align: center; padding: 16px; color: #888; margin-top: 32px; }
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
        <div class="detail-container" id="detailContainer">
            <div>Loading...</div>
        </div>
    </div>
    <div class="footer">Copyright from PlastikHB</div>
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
