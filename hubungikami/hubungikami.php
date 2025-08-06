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

    .contact-section {
      background-color: #e5e5e5;
      text-align: center;
      padding: 50px 30px;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
    }

    .contact-section h3 {
      font-size: 18px;
      margin: 20px 0;
      text-transform: uppercase;
      font-weight: normal;
    }

    .contact-subtitle {
      font-size: 22px;
      font-weight: bold;
      margin: 10px 0 15px 0;
    }

    .contact-description {
      max-width: 700px;
      margin: 0 auto 40px auto;
      font-size: 16px;
      color: #333;
    }

    .contact-cards {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 40px;
    }

    .contact-card {
      background-color: white;
      border: 1px solid #ccc;
      padding: 30px 20px;
      width: 250px;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
      text-align: center;
    }

    .contact-card h4 {
      margin-top: 15px;
      margin-bottom: 10px;
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .contact-card p {
      margin: 0;
      font-size: 14px;
    }

    .contact-icon {
      width: 40px;
      height: auto;
    }

    .map-section {
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
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
      color: black; 
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
        <a href="../tentangkami/tentangkami.php">Tentang Kami</a>
        <a href="#">Katalog Produk</a>
        <a href="../Beranda + Galeri/View/galeri_custom.php">Galeri Custom</a>
        <a href="hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <main>
    <section class="contact-section">
        <h3>Hubungi Kami</h3>
        <p class="contact-subtitle">
        Kami di sini untuk menjawab setiap pertanyaan Anda. <br>
        Mari mulai percakapan hari ini!
        </p>
        <p class="contact-description">
        Silakan hubungi kami untuk pertanyaan, pemesanan, atau konsultasi kebutuhan produk plastik. Kami akan merespons dalam waktu kurang dari 1×24 jam.
        </p>
        
        <div class="contact-cards">
        <div class="contact-card">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/new-post.png" alt="new-post"/>
            <h4>Email Kami</h4>
            <p>loremipsum@gmail.com</p>
        </div>
        <div class="contact-card">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/phone.png" alt="phone"/>
            <h4>Nomor Telepon</h4>
            <p>+62 11 1111111 (phone)<br>+62 22 2222222 (WhatsApp)</p>
        </div>
        <div class="contact-card">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/address--v1.png" alt="address--v1"/>
            <h4>Alamat</h4>
            <p>Jl. lorem Ipsum blablabla No. 111<br>Bandung 40111</p>
        </div>
        </div>
    </section>

    <section class="map-section">
        <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.010512233106!2d107.61352387479221!3d-6.889343467415119!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e655d336aaab%3A0xc48b605e8e3d2915!2sInstitut%20Teknologi%20Harapan%20Bangsa!5e0!3m2!1sen!2sid!4v1753889943241!5m2!1sen!2sid" 
        width="100%" 
        height="450" 
        style="border:0;" allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>
    </main>

  <footer class="footer-section">
      <div class="footer-overlay">
        <div class="footer-content">
            <div class="footer-left">
                <img src="../images/logoBaru.png" alt="PlastikHB" class="footer-logo">
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