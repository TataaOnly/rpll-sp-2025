<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <link rel="icon" type="image/png" href="../../images/icon.png">
  <link rel="stylesheet" href="css/beranda.css">
  <script src="js/beranda.js" defer ></script>
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="beranda.php"><img src="../../images/logoBaru.png" alt="PlastikHB"></a></div>
      <div class="nav-links">
        <a href="beranda.php">Beranda</a>
        <a href="../../tentangkami/FrontEnd/tentangkami.php">Tentang Kami</a>
        <a href="../../Catalog/FrontEnd/shelf.php">Katalog Produk</a>
        <a href="../../Galeri/FrontEnd/galeri_custom.php">Galeri Custom</a>
        <a href="../../hubungikami/FrontEnd/hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="about-us">
        <h2>Tentang Kami</h2>
        <p><b>PlastikHB</b> adalah produsen plastik kemasan yang berdiri sejak 2012 di Jakarta, dengan fokus awal pada kebutuhan usaha mikro dan kecil di Jawa Barat. Seiring waktu, perusahaan terus berkembang, memperluas kapasitas produksi, dan melakukan diversifikasi produk seperti plastik vakum dan standing pouch. Kini, produk telah menjangkau pasar nasional dan didukung layanan custom printing serta sistem produksi modern yang menerapkan kontrol kualitas dan prinsip keberlanjutan.</p>
        <button><a href="../../tentangkami/FrontEnd/tentangkami.php">Jelajahi Kami</a></button>
      </div>
      <div class="image-container">
        <img src="../../images/pabrikPlastikHB3.jpg" alt="Gambar Produk 1">
        <img src="../../images/pabrikPlastikHB4.jpg" alt="Gambar Produk 2">
        <img src="../../images/pabrikPlastikHB5.jpg" alt="Gambar Produk 3">
        <div class="dot-container">
          <div class="dot active" onclick="showImage(0)"></div>
          <div class="dot" onclick="showImage(1)"></div>
          <div class="dot" onclick="showImage(2)"></div>
        </div>
      </div>
    </div>

    <div class="partner">
      <div style="text-align: center;">
        <h3>Mitra Kami</h3>
      </div>
      <div class="slider" style="
        --width: 100px;
        --height: 50px;
        --quantity: 10;
      ">
        <div class="list">
          <div class="item" style="--position: 1"><img src="../../images/borma.jpg" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 2"><img src="../../images/yogya.png" alt="Gambar Produk 2"></div>
          <div class="item" style="--position: 3"><img src="../../images/aquviva.webp" alt="Gambar Produk 3"></div>
          <div class="item" style="--position: 4"><img src="../../images/sidomuncul.png" alt="Gambar Produk 4"></div>
          <div class="item" style="--position: 5"><img src="../../images/wedrink.jpg" alt="Gambar Produk 5"></div>
          <div class="item" style="--position: 6"><img src="../../images/alfamart.png" alt="Gambar Produk 6"></div>
          <div class="item" style="--position: 7"><img src="../../images/aoka.jpg" alt="Gambar Produk 7"></div>
          <div class="item" style="--position: 8"><img src="../../images/SoSoft.webp" alt="Gambar Produk 8"></div>
          <div class="item" style="--position: 9"><img src="../../images/phd.jpg" alt="Gambar Produk 9"></div>
          <div class="item" style="--position: 10"><img src="../../images/yakult.png" alt="Gambar Produk 10"></div>    
        </div>
      </div> 
    </div>

    <?php
      $kontak = include __DIR__ . '/../../getAllContact.php';
    ?>

    <div class="product-section">
        <h2>Spesialisasi Produk Plastik PlastikHB</h2>
        <div class="product-grid">
            <?php
            require_once '../Backend/productController.php';
            $controller = new ProductController();
            $products = $controller->getProductsWithImage();

            foreach ($products as $product) {
                if ($product['id']) {
                    echo "<div class='product'>
                            <a href='../../Catalog/FrontEnd/details.php?id={$product['id']}' title='{$product['name']}'>
                                <img src='{$product['image']}' alt='{$product['name']}' onerror=\"this.src='../../images/icon.png'\">
                            </a>
                          </div>";
                } else {
                    echo "<div class='product'></div>";
                }
            }
            ?>
        </div>
        <button>
            <a href="../../Catalog/FrontEnd/shelf.php"><i>Jelajahi Produk Kami</i></a>
        </button>
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

  <script>
    
  </script>
</body>
</html>