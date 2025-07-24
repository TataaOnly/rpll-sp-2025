<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <link rel="stylesheet" href="css/beranda.css">
  <link rel="stylesheet" href="css/galeri_custom.css">
  <script src="js/galeri_custom.js"></script>
</head>
<body>
  <header>
    <nav>
      <div class="logo">PlastikHB</div>
      <div>
        <a href="#">Beranda</a>
        <a href="#">Tentang Kami</a>
        <a href="#">Katalog Produk</a>
        <a href="#">Galeri Custom</a>
        <a href="#">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="product-section">
      <center>
        <h2>Galeri Produk Custom PlastikHB</h2>
        <div class="product-grid">
          <?php
            require_once "../Model/config.php";

            $sql = "
              SELECT gambar.*, produk.nama 
              FROM gambar 
              JOIN produk ON gambar.produk_id = produk.produk_id 
              WHERE produk.kategori = 'Custom' 
              ORDER BY gambar.gambar_id
            ";

            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                $index = 0;
                while ($row = $result->fetch_assoc()) {
                  $hiddenClass = $index >= 8 ? "hidden-product" : "";
                  echo "
                    <div class='product $hiddenClass'>
                      <img src='../img/{$row['file']}' alt='Gambar Produk Custom'>
                      <p>{$row['nama']}</p>
                    </div>
                  ";
                  $index++;
                }
            } else {
                echo "<p>Tidak ada produk custom yang ditemukan.</p>";
            }

            $conn->close();
          ?>
        </div>
        <button><a href="#"><i>Selengkapnya</i></a></button>
      </center>
    </div>
  </main>

  <footer>
    Footer
  </footer>

  <script>
    const images = document.querySelectorAll('.image-container img');
    const dots = document.querySelectorAll('.image-container .dot');
    let currentIndex = 0;

    function showImage(index) {
      images.forEach((img, i) => {
        img.style.opacity = i === index ? '1' : '0';
      });
      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
      });
      currentIndex = index;
    }

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        showImage(index);
      });
    });

    function cycleImages() {
      currentIndex = (currentIndex + 1) % images.length;
      showImage(currentIndex);
    }

    setInterval(cycleImages, 5000);
  </script>
</body>
</html>
