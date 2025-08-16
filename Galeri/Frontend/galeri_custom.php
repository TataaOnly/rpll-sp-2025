<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <link rel="icon" type="image/png" href="../../images/icon.png">
  <link rel="stylesheet" href="css/galeri_custom.css">
  <script src="js/galeri_custom.js" defer></script>
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="../../Beranda/Frontend/beranda.php"><img src="../../images/logoBaru.png" alt=""></a></div>
      <div class="nav-links">
        <a href="../../Beranda/Frontend/beranda.php">Beranda</a>
        <a href="../../tentangkami/FrontEnd/tentangkami.php">Tentang Kami</a>
        <a href="../../Catalog/FrontEnd/shelf.php">Katalog Produk</a>
        <a href="galeri_custom.php">Galeri Custom</a>
        <a href="../../hubungikami/FrontEnd/hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <?php
    $kontak = include __DIR__ . '/../../getAllContact.php';
  ?>

  <main>
    <div class="custom-product-section">
      <div style="text-align: center;">
      
        <h2>Galeri Produk Custom PlastikHB</h2>
        <div class="custom-product-grid">
          <?php
          require_once '../../admin/Service/GambarService.php';

          $gambarService = new GambarService();
          $gambars = $gambarService->getAllImagesByProductId(1);
          foreach ($gambars as $gambar) {
              echo "<div class='custom-product'>
                      <img src='../../uploads/{$gambar['file']}' alt='Custom Product Image'>
                    </div>";
          }
          ?>
        </div>

        <div class="popup-custom-product">
            <span>&times;</span>
            <img src="../img/produk1.jpg" alt="">
        </div>

      </div>
    </div>
  </main>

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
