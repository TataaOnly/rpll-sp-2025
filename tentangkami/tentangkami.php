<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <!-- <link rel="stylesheet" href="css/beranda.css"> -->
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
      padding: 0 0 20px 0;
    }

    .sejarah-section {
      display: flex;
      padding: 50px 60px;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
    }

    .sejarah-title {
      flex: 1;
      text-align: right;
      padding-right: 20px;
      font-weight: bold;
      font-size: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .sejarah-title p {
      margin: 0;
      line-height: 1.2;
      font-size: 24px;
    }

    .sejarah-content {
      flex: 3;
      padding-left: 30px;
      border-left: 1px solid #444;
    }

    .sejarah-content p{
      padding-right: 150px;
    }

    .visi-misi-section {
      background-color: #e5e5e5;
      padding: 50px 100px;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
    }

    .visi-misi-wrapper {
      display: flex;
      gap: 40px;
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .visi, .misi  {
      flex: 1;
    }

    .visi{
      text-align: right;
    }

    .misi {
      text-align: left;
    }

    .visi-misi-wrapper h3{
      margin: 10px 0;
      text-transform: none;
      font-size: 24px;
    }

    .visi-misi-wrapper .separator-line {
      width: 1px;
      background-color: #999;
    }

    .kebijakan-umum h3 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      text-transform: none;
    }

    .kebijakan-umum ul {
      list-style: none;
      padding-left: 0;
    }

    .kebijakan-umum li {
      font-size: 15px;
      margin: 15px 0;
    }

    .toggle-header {
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .arrow {
      transition: transform 0.3s ease;
    }

    .toggle-item.active .arrow {
      transform: rotate(180deg);
    }

    .toggle-content {
      max-height: 0;
      overflow: hidden;
      padding: 0;
      opacity: 0;
      margin: 10px 0;
      transition:
        max-height 1s ease,
        padding 1s ease,
        opacity 1s ease;
    }

    .toggle-item.active .toggle-content {
      max-height: 300px; 
      opacity: 1;
    }

    .tagline {
      text-align: center;
      color: blue;
      font-weight: bold;
      font-style: italic;
      font-size: 25px;
      margin: 30px 0;
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

    .footer-section {
        position: relative;
        background: url('../images/pabrikPlastikHB.jpg') center/cover no-repeat;
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
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="../Beranda + Galeri/View/beranda.php"><img src="../images/logoBaru.png" alt=""></a></div>
      <div class="nav-links">
        <a href="../Beranda + Galeri/View/beranda.php">Beranda</a>
        <a href="tentangkami.php">Tentang Kami</a>
        <a href="../Catalog/FrontEnd/shelf.php">Katalog Produk</a>
        <a href="../Beranda + Galeri/View/galeri_custom.php">Galeri Custom</a>
        <a href="../hubungikami/View/hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <main>
    <section class="sejarah-section">
      <div class="sejarah-title">
        <p>Sejarah<br>PlastikHB</p>
      </div>
      <div class="sejarah-content">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <br>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      </div>
    </section>

    <section class="visi-misi-section">
      <div class="visi-misi-wrapper">
        <div class="visi">
          <h3>Visi</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="separator-line"></div>
        <div class="misi">
          <h3>Misi</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
      </div>

      <div class="kebijakan-umum">
        <h3>Kebijakan Umum</h3>
        <ul>
          <li class="toggle-item">
            <div class="toggle-header">
              <strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              Penjelasan lengkap untuk poin pertama ini, bisa berupa paragraf panjang atau komponen lainnya.
            </div>
          </li>
          <li class="toggle-item">
            <div class="toggle-header">
              <strong>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              Detail dari sejarah penggunaannya sejak abad ke-16.
            </div>
          </li>
          <li class="toggle-item">
            <div class="toggle-header">
              <strong>Lorem Ipsum passages, and more recently with desktop publishing software.</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              Bagaimana Lorem Ipsum digunakan dalam software modern saat ini.
            </div>
          </li>
        </ul>
      </div>
    </section>

    <div class="tagline">
      “Mudah, Cepat, dan Sesuai Pesanan Anda.”
    </div>
  </main>


  <footer class="footer-section">
      <div class="footer-overlay">
        <div class="footer-content">
            <div class="footer-left">
                <img src="../images/logo.png" alt="PlastikHB" class="footer-logo">
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
                include '../admin/Helpers/KontakHelper.php';
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

  <script>
    document.querySelectorAll('.toggle-header').forEach(header => {
      header.addEventListener('click', () => {
        const parent = header.parentElement;
        parent.classList.toggle('active');
      });
    });
  </script>
</body>
</html>