<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <!-- <link rel="stylesheet" href="css/beranda.css"> -->
  <script src="js/beranda.js" defer ></script>
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

    h2, h3{
      text-transform: uppercase;
      font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    h3{
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

    .logo img{
      width: 20%;
    }

    main {
      padding: 0 0 20px 0 ;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 30px;
      margin: 20px 50px;
      /* padding: 20px; */
    }

    .product-grid .product {
      /* background-color: #f2f2f2; */
      /* padding: 60px 10px; */
      text-align: center;
    }

    .product img{
        width: 100%;
        height: 100%;
        /* border: 1px solid black; */
    }

    .hidden-product {
      display: none;
    }
      
    .container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
        padding: 30px 60px;
        margin: 0;
        background-color: #75b6fc;
    }

    .about-us {
        padding: 20px;
    }

    .image-container {
        position: relative;
        height: 400px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease;
        position: absolute;
        opacity: 0;
    }

    .image-container img:first-child {
      opacity: 1;
    }

    .image-container .dot-container {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
    }

    .image-container .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #ccc;
        transition: background-color 0.5s ease;
    }

    .image-container .dot.active {
        background-color: #0056b3;
    }

    .partner{
        background-color: #f3f3f6;
        padding: 20px 70px 70px 70px;
    }

    .slider{
        width: 100%;
        /* border: 1px solid red; */
        height: var(--height); 
        overflow: hidden;
        mask-image: linear-gradient(
            to right, 
            transparent, 
            black 10%, 
            black 90%, 
            transparent 100%
        );
    }

    .slider .list{
        display: flex;
        width: 100%;
        min-width: calc(var(--quantity) * var(--width));
        position: relative;
    }

    .slider .list .item{
        width: var(--width);
        height: var(--height);
        position: absolute;
        left: 100%;
        animation: autoRun 10s linear infinite;
        animation-delay: calc(10s / var(--quantity) * (var(--position) - 1));
        transition: filter 0.5s;
    }

    .slider .list .item img{
        width: 100%;
    }

    .slider:hover .item{
        animation-play-state: paused!important;
        filter: grayscale(1);
    }

    .slider:hover .item:hover{
        filter: grayscale(0);
    }

    button{
        background-color: #0056b3;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        width: 200px;
        font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    button a {
        color: white;
        text-decoration: none;
        font-size: 15px;
        font-weight: bolder;
    }

    button:hover {
        background-color: #004494;
    }

    .about-us button{
        transition: border 1s ease;
    }

    .about-us button:hover{
        border: 1px solid #fff;
    }

    .footer-section {
        position: relative;
        background: url('../../images/pabrikPlastikHB.jpg') center/cover no-repeat;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    .footer-overlay {
        background-color: rgba(148, 163, 248, 0.8); /* Warna ungu transparan */
        padding: 60px 60px;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: 0 auto;
        color: black; /* sesuai gambar */
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
        background-color: #0056b3; /* biru */
        text-align: center;
        padding: 15px 0;
        font-size: 18px;
        font-weight: bold;
    }

    @keyframes carousel {
        0% { transform: translateX(0); }
        100% { transform: translateX(-75%); }
    }

    @keyframes autoRun {
        from{
            left: 100%;
        }to{
            left: calc(var(--width) * -1 );
        }
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="beranda.php"><img src="../../images/logoBaru.png" alt=""></a></div>
      <div class="nav-links">
        <a href="beranda.php">Beranda</a>
        <a href="../../tentangkami/tentangkami.php">Tentang Kami</a>
        <a href="#">Katalog Produk</a>
        <a href="galeri_custom.php">Galeri Custom</a>
        <a href="../../hubungikami/hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="about-us">
        <h2>Tentang Kami</h2>
        <p>PlastikHB adalah produsen plastik kemasan yang berdiri sejak 2012 di Bandung, dengan fokus awal pada kebutuhan usaha mikro dan kecil di Jawa Barat. Seiring waktu, perusahaan terus berkembang, memperluas kapasitas produksi, dan melakukan diversifikasi produk seperti plastik vakum dan standing pouch. Kini, produk telah menjangkau pasar nasional dan didukung layanan custom printing serta sistem produksi modern yang menerapkan kontrol kualitas dan prinsip keberlanjutan.</p>
        <button><a href="../../tentangkami/tentangkami.php">Jelajahi Kami</a></button>
      </div>
      <div class="image-container">
        <img src="../images/ATCY2.jpg" alt="Gambar Produk 1">
        <img src="../images/ATCY3.jpg" alt="Gambar Produk 2">
        <img src="../images/ATCY4.jpg" alt="Gambar Produk 3">
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
          <div class="item" style="--position: 1"><img src="../images/BMW-M_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 2"><img src="../images/DHL_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 3"><img src="../images/EstrellaGalicia_Logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 4"><img src="../images/MICHELIN_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 5"><img src="../images/sponsor-qatar.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 6"><img src="../images/Tissot_Main_Sponsor.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 7"><img src="../images/DHL_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 8"><img src="../images/EstrellaGalicia_Logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 9"><img src="../images/MICHELIN_logo.webp" alt="Gambar Produk 1"></div>
          <div class="item" style="--position: 10"><img src="../images/sponsor-qatar.webp" alt="Gambar Produk 1"></div>    
        </div>
      </div> 
    </div>

    <div class="product-section">
      <center>
        <h2>Spesialisasi Produk Plastik PlastikHB</h2>
        <div class="product-grid">
          <!-- <?php
            // require_once "../Model/config.php";

            // $sql = "Select * from gambar ORDER BY gambar_id LIMIT 8";
            // $result = $conn->query($sql);
            // if ($result->num_rows > 0) {
            //     while($row = $result->fetch_assoc()) {
            //         echo "
            //             <div class ='product'><img src='../".$row['file']."'></div>
            //         ";
            //     }
            // } else {
            //     echo "Tidak ada produk yang ditemukan.";
            // }
            ?> -->
            <div class ='product'><img src='../images/produk1.jpg'></div>
            <div class ='product'><img src='../images/produk2.jpg'></div>
            <div class ='product'><img src='../images/produk3.jpeg'></div>
            <div class ='product'><img src='../images/produk4.jpg'></div>
            <div class ='product'><img src='../images/produk5.jpg'></div>
            <div class ='product'><img src='../images/produk6.jpg'></div>
            <div class ='product'><img src='../images/produk7.jpg'></div>
            <div class ='product'><img src='../images/produk8.jpg'></div>
        </div>
         <button><a href="#"><i>Jelajahi Produk Kami</i></a></button>
      </center>
    </div>
  </main>

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
  </footer>
</body>
</html>