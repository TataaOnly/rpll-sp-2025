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

    .logo{
      padding-right: 0;
      margin-right: 0;
    }

    .logo img{
      width: 20%;
    }

    main {
      padding: 0 0 20px 0;
    }

    .sejarah-section {
      padding: 50px 80px;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
    }

    .sejarah-item {
      display: flex;
      margin-bottom: 50px; 
    }

    .sejarah-title {
      flex: 1;
      text-align: right;
      padding-right: 20px;
      display: flex;
      flex-direction: column;
      /* justify-content: center; */
    }

    .sejarah-title p {
      margin: 0;
      line-height: 1.2;
      font-size: 34px;
    }

    .vertical-line {
      width: 1px;
      background-color: #444;
      margin: 0 20px;
      height: 200px; /* ← Ubah sesuai kebutuhan */
    }

    .sejarah-content {
      flex: 3;
      padding-left: 30px;
      /* border-left: 1px solid #444; */
    }

    .sejarah-content p {
      padding-right: 150px;
    }

    .sejarah-content p:nth-child(1) {
      font-size: larger;
      font-weight: bold;
    }

    .sejarah-content img {
      width: 60%;
      height: auto;
      border-radius: 5px;
    }

    .revealing-image {
      view-timeline-name: --revealing-image;
      view-timeline-axis: block;
      animation: linear reveal both;
      animation-timeline: --revealing-image;
      animation-range: entry 25% cover 50%;
    }

    .fade-slide-up {
      opacity: 0;
      transform: translateY(40px);
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      will-change: opacity, transform;
    }

    .fade-slide-up.show {
      opacity: 1;
      transform: translateY(0);
    }

    @keyframes reveal {
      from {
        opacity: 0;
        clip-path: inset(45% 20% 45% 20%);
      }
      to {
        opacity: 1;
        clip-path: inset(0% 0% 0% 0%);
      }
    }

    .visi-misi-section {
      background-color: #e5e5e5;
      padding: 50px 100px;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
      /* min-width: 80%; */
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

    .misi ol{
      padding-left: 20px;
      
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
      font-size: 17px;
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
      font-size: 17px;
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
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="../Beranda + Galeri/View/beranda.php"><img src="../images/logoBaru.png" alt=""></a></div>
      <div class="nav-links">
        <a href="../Beranda + Galeri/View/beranda.php">Beranda</a>
        <a href="tentangkami.php">Tentang Kami</a>
        <a href="../Catalog/Frontend/shelf.php">Katalog Produk</a>
        <a href="../Beranda + Galeri/View/galeri_custom.php">Galeri Custom</a>
        <a href="../hubungikami/hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <main>
    <section class="sejarah-section">
      <div class="sejarah-item fade-slide-up">
        <div class="sejarah-title">
          <p>Sejarah<br>PlastikHB</p>
        </div>
        <div class="vertical-line"></div>
        <div class="sejarah-content">
          <p>Berdiri sejak tahun 2012, PlastikHB adalah sebuah perusahaan manufaktur dan distribusi yang secara khusus bergerak di bidang produksi plastik kemasan. Perusahaan ini mengawali langkah dari skala yang relatif kecil di kota Bandung, dengan fokus utama pada penyediaan plastik kemasan sederhana bagi para pelaku usaha mikro dan kecil yang beroperasi di wilayah Jawa Barat dan sekitarnya.</p>
          <p>Seiring berjalannya waktu, perusahaan terus berinovasi dan berkembang untuk memenuhi permintaan pasar yang meningkat. Pada tahun 2014, kapasitas produksi diperluas dengan penambahan mesin blowing dan cutting, serta mulai mengoperasikan mesin cetak flexo untuk memproduksi kemasan bermotif. Dua tahun kemudian, tepatnya pada 2016, dilakukan diversifikasi produk dengan memproduksi plastik vakum dan plastik standing pouch untuk kebutuhan pengemasan makanan dan industri kecil menengah (IKM).</p>
          <p>Memasuki tahun 2018, produk berhasil menembus pasar nasional. Melalui distribusi ke berbagai kota besar di Indonesia, kemasan mulai digunakan oleh ritel skala nasional, seperti supermarket dan distributor kemasan.</p>
          <p>Pada tahun 2019, secara resmi ditawarkan layanan custom printing, memungkinkan pelanggan mencetak logo dan desain merek mereka sendiri. Layanan ini dapat diterapkan untuk kemasan produk makanan, pakaian, maupun produk retail lainnya.</p>
          <p>Pada tahun 2021, dilakukan modernisasi pabrik dengan sistem produksi semi-otomatis serta penerapan kontrol kualitas yang lebih ketat. Selain itu, juga mulai diterapkan prinsip keberlanjutan dalam proses produksi untuk mendukung kelestarian lingkungan.</p>
          <img src="../images/pabrikPlastikHB2.jpg" class="revealing-image" alt="" >
        </div>
      </div>
      <div class="sejarah-item fade-slide-up">
        <div class="sejarah-title">
          <p>Komitmen<br>PlastikHB</p>
        </div>
        <div class="vertical-line"></div>
        <div class="sejarah-content">
          <p>Sejak awal pendirian, PlastikHB telah berkomitmen penuh untuk menjadi mitra yang dapat diandalkan. Tidak hanya menyediakan produk kemasan standar, tetapi juga melayani pesanan produk custom yang dirancang secara spesifik untuk memenuhi kebutuhan unik setiap konsumen.</p>
          <p>Komitmen terhadap kepuasan pelanggan diwujudkan melalui proses produksi yang fleksibel, konsultasi desain yang profesional, serta ketepatan waktu dalam pengiriman. Setiap tahapan dikerjakan dengan perhatian terhadap detail, guna memastikan bahwa solusi kemasan yang diberikan tidak hanya fungsional tetapi juga mampu meningkatkan nilai jual produk pelanggan.</p>
          <!-- <img src="../images/pabrikPlastikHB2.jpg" class="revealing-image" alt=""> -->
        </div>
      </div>
    </section>

    <section class="visi-misi-section">
      <div class="visi-misi-wrapper">
        <div class="visi">
          <h3>Visi</h3>
          <p>Menjadi perusahaan produsen dan penyedia kemasan plastik terdepan di Indonesia yang dikenal luas atas kualitas produk, inovasi layanan, komitmen terhadap keberlanjutan, dan kepuasan pelanggan. Kami bertekad untuk terus berkembang sebagai mitra utama bagi pelaku usaha dari skala kecil hingga besar, serta turut berkontribusi dalam membangun industri kemasan nasional yang lebih efisien, profesional, dan ramah lingkungan.</p>
        </div>
        <div class="separator-line"></div>
        <div class="misi">
          <h3>Misi</h3>
          <p>
            <ol>
              <li>Menyediakan produk plastik berkualitas tinggi sesuai dengan kebutuhan pelanggan.</li>
              <li>Meningkatkan layanan dan teknologi produksi untuk memenuhi permintaan pasar yang dinamis.</li>
              <li>Berkomitmen terhadap prinsip berkelanjutan dengan menghadirkan opsi produk ramah lingkungan.</li>
              <li>Memberdayakan UMKM melalui kemasan berkualitas dan layanan custom yang terjangkau.</li>
            </ol>
          </p>
        </div>
      </div>

      <div class="kebijakan-umum">
        <h3>Kebijakan Umum</h3>
        <ul>
          <li class="toggle-item active">
            <div class="toggle-header">
              <strong>Berkomitmen terhadap Kualitas Produk</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              Komitmen penuh untuk hanya memproduksi dan menyediakan produk plastik yang memenuhi standar mutu tinggi, mulai dari bahan baku pilihan, proses produksi yang terkontrol, hingga pemeriksaan kualitas akhir. Setiap produk diuji secara ketat agar konsisten, tahan lama, dan aman digunakan oleh pelanggan di berbagai sektor industri.
            </div>
          </li>
          <li class="toggle-item">
            <div class="toggle-header">
              <strong>Memprioritaskan utama kepuasaan utama</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              Kepuasan pelanggan adalah pusat dari setiap proses bisnis. Melalui pendekatan yang responsif, layanan yang ramah, dan sistem umpan balik yang terbuka, kami secara aktif mendengarkan kebutuhan pelanggan dan berusaha memberikan solusi kemasan yang tepat waktu, fleksibel, dan sesuai harapan.
            </div>
          </li>
          <li class="toggle-item">
            <div class="toggle-header">
              <strong>Perbaikan Berkelanjutan</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              PlastikHB senantiasa menjalankan evaluasi rutin terhadap seluruh proses operasional, mulai dari desain produk hingga distribusi. Kami mendorong inovasi, penggunaan teknologi terbaru, serta pelatihan internal bagi seluruh tim agar kualitas produk dan layanan terus meningkat dan tetap relevan terhadap dinamika pasar.
            </div>
          </li>
        </ul>
      </div>
    </section>

    <div class="tagline fade-slide-up">
      “Mudah, Cepat, dan Sesuai Pesanan Anda.”
    </div>
  </main>


  <footer class="footer-section">
      <div class="footer-overlay">
        <div class="footer-content">
            <div class="footer-left">
                <img src="../images/logo.png" alt="PlastikHB" class="footer-logo">
                <p>
                    Melayani dengan kualitas, tumbuh dengan kepercayaan, dan bergerak untuk masa depan yang lebih hijau.<br>
                    Kami percaya bahwa industri plastik masa depan harus berkelanjutan. Setiap produk kami adalah langkah kecil menuju bumi yang lebih bersih dan sehat.
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

  // Scroll animation that works in both directions (down & up)
  const fadeEls = document.querySelectorAll('.fade-slide-up');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
      } else {
        entry.target.classList.remove('show');
      }
    });
  }, {
    threshold: 0.2
  });

  fadeEls.forEach(el => observer.observe(el));
  </script>
</body>
</html>