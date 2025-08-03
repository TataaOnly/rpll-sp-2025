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

    .product-section {
      text-align: center;
      padding: 20px;
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
      transition: transform 0.3s ease;
    }

    .product:hover {
      transform: translateY(-5px);
    }

    .product a {
      display: block;
      text-decoration: none;
      color: inherit;
    }

    .product img{
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
        transition: opacity 0.3s ease;
        /* border: 1px solid black; */
    }

    .product img:hover {
        opacity: 0.8;
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
        <a href="../../Catalog/FrontEnd/shelf.php">Katalog Produk</a>
        <a href="galeri_custom.php">Galeri Custom</a>
        <a href="../../hubungikami/hubungikami.php">Hubungi Kami</a>
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
      <div style="text-align: center;">
        <h3>Mitra Kami</h3>
      </div>
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
        <h2>Spesialisasi Produk Plastik PlastikHB</h2>
        <div class="product-grid">
          <?php
            require_once '../../admin/Service/ProdukService.php';
            require_once '../../admin/Service/GambarService.php';
            
            $produkService = new ProdukService();
            $gambarService = new GambarService();
            $products = $produkService->getAllProducts();
            
            if ($products && count($products) > 0) {
                // Display up to 8 products from database
                $displayCount = 0;
                foreach ($products as $product) {
                    if ($displayCount >= 8) break; // Limit to 8 products
                    
                    $produk_id = $product['produk_id'];
                    $productName = htmlspecialchars($product['nama']);
                    
                    // Get first image for this product
                    $images = $gambarService->getAllImagesByProductId($produk_id);
                    $imageSrc = '';
                    if ($images && count($images) > 0) {
                        $imageSrc = '../../uploads/' . $images[0]['file'];
                    } else {
                        $imageSrc = '../../images/icon.png';
                    }
                    
                    echo "<div class='product'>
                            <a href='../../Catalog/Frontend/details.php?id={$produk_id}' title='{$productName}'>
                                <img src='{$imageSrc}' alt='{$productName}' onerror=\"this.src='../../images/icon.png'\">
                            </a>
                          </div>";
                    $displayCount++;
                }
                
                // Fill remaining slots with empty divs
                for ($i = $displayCount; $i < 8; $i++) {
                    echo "<div class='product'></div>";
                }
            } else {
                // If no products, show 8 empty slots
                for ($i = 0; $i < 8; $i++) {
                    echo "<div class='product'></div>";
                }
            }
            ?>
        </div>
         <button><a href="../../Catalog/Frontend/shelf.php"><i>Jelajahi Produk Kami</i></a></button>
    </div>
  </main>

  <footer class="footer-section">
      <div class="footer-overlay">
        <div class="footer-content">
            <div class="footer-left">
                <img src="../../images/logo.png" alt="PlastikHB" class="footer-logo">
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
                <?php
                include '../../admin/Helpers/KontakHelper.php';
                $kontak = KontakHelper::getKontak();
                if (!$kontak) {
                    // Default contact data as fallback
                    $kontak = [
                        'nama' => 'PlastikHB Admin',
                        'email' => 'admin@plastikhb.com',
                        'no_telp' => '081234567890',
                        'no_wa' => '081234567890',
                        'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0104676903975!2d107.6160988!3d-6.889348799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e655d336aaab%3A0xc48b605e8e3d2915!2sInstitut%20Teknologi%20Harapan%20Bangsa!5e0!3m2!1sen!2sid!4v1753878291876!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                        'alamat' => 'Alamat Toko Plastik',
                    ];
                }
                
                // Ensure all required fields exist with safe defaults
                $kontak = array_merge([
                    'nama' => 'PlastikHB',
                    'email' => 'info@plastikhb.com',
                    'no_telp' => 'Tidak tersedia',
                    'no_wa' => 'Tidak tersedia',
                    'alamat' => 'Alamat belum diatur',
                    'map' => '<p>Peta belum tersedia</p>'
                ], $kontak);
                ?>
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