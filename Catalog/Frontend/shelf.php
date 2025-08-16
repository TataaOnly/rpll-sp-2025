<?php /* Frontend only, no PHP logic needed here */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | PlastikHB</title>
    <link rel="icon" type="image/png" href="../../images/icon.png">
    <link rel="stylesheet" href="css/shelf.css">
    <script src="js/shelf.js" defer></script>
</head>

<body>
    <header>
        <nav>
            <div class="logo"><a href="../../Beranda/Frontend/beranda.php"><img src="../../images/logoBaru.png" alt=""></a></div>
            <div class="nav-links">
                <a href="../../Beranda/Frontend/beranda.php">Beranda</a>
                <a href="../../tentangkami/Frontend/tentangkami.php">Tentang Kami</a>
                <a href="shelf.php">Katalog Produk</a>
                <a href="../../Galeri/Frontend/galeri_custom.php">Galeri Custom</a>
                <a href="../../hubungikami/Frontend/hubungikami.php">Hubungi Kami</a>
            </div>
        </nav>
    </header>

    <?php
        $kontak = include __DIR__ . '/../../getAllContact.php';
    ?>

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
    <footer class="footer-section">
      <div class="footer-overlay">
        <div class="footer-content">
            <div class="footer-left">
                <img src="../../images/logo.png" alt="PlastikHB" class="footer-logo">
                <p>
                    Melayani dengan kualitas, tumbuh dengan kepercayaan, dan bergerak untuk masa depan yang lebih hijau.<br>
                    Kami percaya bahwa industri plastik masa depan harus berkelanjutan. Setiap produk kami adalah langkah kecil menuju bumi yang lebih bersih dan sehat.
                </p>
            </div>

            <div class="footer-right">
                <h3>Hubungi kami</h3>
                <p><?php echo htmlspecialchars($kontak['alamat']); ?>
                <br><?php echo htmlspecialchars($kontak['no_telp']); ?> (phone)
                <br><?php echo htmlspecialchars($kontak['no_wa']); ?> (WhatsApp)
                <br><?php echo htmlspecialchars($kontak['email']); ?></p>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        Copyright &copy; 2025 PlastikHB
    </div>
  </footer>
</body>
</html>