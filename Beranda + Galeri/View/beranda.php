<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <link rel="stylesheet" href="css/beranda.css">
  <script src="js/beranda.js" defer ></script>
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
    <div class="container">
      <div class="about-us">
        <h2>Tentang Kami</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <button><a href="#">Jelajahi Kami</a></button>
      </div>
      <div class="image-container">
        <img src="../img/ATCY2.jpg" alt="Gambar Produk 1">
        <img src="../img/ATCY3.jpg" alt="Gambar Produk 2">
        <img src="../img/ATCY4.jpg" alt="Gambar Produk 3">
        <div class="dot-container">
          <div class="dot active" onclick="showImage(0)"></div>
          <div class="dot" onclick="showImage(1)"></div>
          <div class="dot" onclick="showImage(2)"></div>
        </div>
      </div>
    </div>

    <div class="partner">
      <center>
        <h3>Mitra Kami</h3>
      </center>
      <div class="slider" style="
        --width: 100px;
        --height: 50px;
        --quantity: 10;
      ">
        <div class="list">
          <div class="item" style="--position: 1"><img src="../img/BMW-M_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 2"><img src="../img/DHL_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 3"><img src="../img/EstrellaGalicia_Logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 4"><img src="../img/MICHELIN_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 5"><img src="../img/sponsor-qatar.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 6"><img src="../img/Tissot_Main_Sponsor.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 7"><img src="../img/DHL_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 8"><img src="../img/EstrellaGalicia_Logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 9"><img src="../img/MICHELIN_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 10"><img src="../img/sponsor-qatar.webp" alt="Gambar Produk 1"></div>    
        </div>
      </div> 
    </div>

    <div class="product-section">
      <center>
        <h2>Spesialisasi Produk Plastik PlastikHB</h2>
        <div class="product-grid">
          <?php
            require_once "../Model/config.php";

            $sql = "Select * from gambar ORDER BY gambar_id LIMIT 8";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <div class ='product'><img src='../img/".$row['file']."'></div>
                    ";
                }
            } else {
                echo "Tidak ada produk yang ditemukan.";
            }
        ?>
        </div>
         <button><a href="#"><i>Jelajahi Produk Kami</i></a></button>
      </center>
    </div>
  </main>

  <footer>
    Footer
  </footer>
</body>
</html>