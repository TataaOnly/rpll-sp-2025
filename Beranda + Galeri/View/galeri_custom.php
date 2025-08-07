<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <!-- <link rel="stylesheet" href="css/beranda.css"> -->
  <!-- <link rel="stylesheet" href="css/galeri_custom.css"> -->
  <script src="js/galeri_custom.js" defer></script>
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
        /* height: 10%; */
    }

    main {
        padding: 0 0 20px 0 ;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 30px;
        /* padding: 20px; */
    }

    .product-grid .product {
        /* background-color: #f2f2f2; */
        /* padding: 60px 10px; */
        margin: 0 50px;
        text-align: center;
    }

    .product img{
        width: 90%;
        height: 90%;
        border: 1px solid black;
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
        font-size: 17px;
        line-height: 1.6;
        font-weight: bold;
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

    .custom-product-section{
      position: relative;
      min-height: 100vh;
    }

    .custom-product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        padding: 40px 60px;
    }

    .custom-product {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
        overflow: hidden;
        cursor: pointer;
        aspect-ratio: 3 / 2;
    }

    .custom-product img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .custom-product:hover img {
        transform: scale(1.05);
    }


    .custom-product-grid .custom-product:hover img{
      transform: scale(1.1);
    }

    .custom-product-section .popup-custom-product{
      position: fixed;
      top: 0; left: 0;
      background-color: rgba(0, 0, 0, .9);
      height: 100%;
      width: 100%;
      z-index: 100;
      display: none;
    }

    .custom-product-section .popup-custom-product span{
      position: absolute;
      top: 0; right: 10px;
      font-size: 60px;
      font-weight: bolder;
      color: #fff;
      cursor: pointer;
      z-index: 100;
    }

    .custom-product-section .popup-custom-product img{
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      border: 5px solid #fff;
      border-radius: 5px;
      width: 750px;
      object-fit: cover;
    }

    @media (max-width: 768px){
      .custom-product-grid .custom-product img{
        width: 95%;
      }
    }

    @media (max-width: 1200px) {
      .custom-product-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 900px) {
      .custom-product-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .custom-product-grid {
        grid-template-columns: repeat(1, 1fr);
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
    <div class="custom-product-section">
      <div style="text-align: center;">
      
        <h2>Galeri Produk Custom PlastikHB</h2>
        <div class="custom-product-grid">
          <?php
          require_once '../../admin/Service/GambarService.php';

          $gambarService = new GambarService();
          $gambars = $gambarService->getAllImagesByProductId(1); // Assuming 1 is the product ID for custom products
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
