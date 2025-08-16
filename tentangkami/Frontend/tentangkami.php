<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlastikHB</title>
  <link rel="icon" type="image/png" href="../../images/icon.png">
  <link rel="stylesheet" href="css/tentangkami.css">
  <script src="js/tentangkami.js" defer></script>
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="../../Beranda/Frontend/beranda.php"><img src="../../images/logoBaru.png" alt=""></a></div>
      <div class="nav-links">
        <a href="../../Beranda/Frontend/beranda.php">Beranda</a>
        <a href="tentangkami.php">Tentang Kami</a>
        <a href="../../Catalog/Frontend/shelf.php">Katalog Produk</a>
        <a href="../../Galeri/Frontend/galeri_custom.php">Galeri Custom</a>
        <a href="../../hubungikami/Frontend/hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <?php
    $kontak = include __DIR__ . '/../../getAllContact.php';
  ?>

  <main>
    <section class="sejarah-section">
      <div class="sejarah-item fade-slide-up">
        <div class="sejarah-title">
          <p>Sejarah<br>PlastikHB</p>
        </div>
        <div class="vertical-line"></div>
        <div class="sejarah-content">
          <p>Berdiri sejak tahun 2012 di Jakarta, <b>PlastikHB</b> adalah perusahaan manufaktur dan distribusi yang berfokus pada produksi berbagai jenis produk berbahan dasar plastik. Pada awalnya, perusahaan melayani kebutuhan usaha mikro dan kecil melalui penyediaan plastik kemasan sederhana di wilayah Jawa Barat dan sekitarnya.</p>
          <p>Seiring berjalannya waktu, perusahaan berkembang dengan memperluas lini produksi, tidak hanya terbatas pada kemasan, tetapi juga berbagai produk plastik fungsional untuk kebutuhan industri maupun rumah tangga. Pada tahun 2014, kapasitas produksi ditingkatkan dengan penambahan mesin blowing dan cutting, serta mulai mengoperasikan mesin cetak flexo untuk mencetak motif pada produk plastik.</p>
          <p>Pada tahun 2016, diversifikasi produk dilakukan dengan menghadirkan plastik vakum, standing pouch, hingga produk plastik pendukung industri kecil menengah (IKM). Perusahaan terus berinovasi dengan memperkenalkan varian produk plastik yang dapat digunakan pada sektor pangan, ritel, distribusi, hingga kebutuhan umum rumah tangga.</p>
          <p>Memasuki tahun 2018, jaringan distribusi PlastikHB meluas ke tingkat nasional. Produk plastik HB mulai digunakan oleh supermarket, distributor besar, dan berbagai sektor industri. Kemudian pada 2019, layanan <i>custom printing</i> resmi diperkenalkan, memungkinkan pelanggan mencetak desain, logo, dan identitas merek pada produk plastik yang mereka butuhkan.</p>
          <p>Sejak 2021, pabrik dimodernisasi dengan sistem produksi semi-otomatis, penerapan kontrol kualitas ketat, serta integrasi prinsip keberlanjutan dalam proses produksi. Hal ini menegaskan komitmen PlastikHB untuk tidak hanya menghadirkan produk plastik berkualitas, tetapi juga ramah lingkungan dan berdaya saing tinggi di pasar nasional.</p>
          <img src="../../images/pabrikPlastikHB2.jpg" class="revealing-image" alt="">
        </div>
      </div>

      <div class="sejarah-item fade-slide-up">
        <div class="sejarah-title">
          <p>Komitmen<br>PlastikHB</p>
        </div>
        <div class="vertical-line"></div>
        <div class="sejarah-content">
          <p>Sejak awal, PlastikHB berkomitmen menjadi mitra andal dalam penyediaan solusi berbahan dasar plastik, baik untuk kebutuhan kemasan maupun produk plastik serbaguna lainnya. Kami memahami bahwa setiap pelanggan memiliki kebutuhan unik, sehingga fleksibilitas dalam desain, spesifikasi, maupun kapasitas produksi menjadi bagian penting dari layanan kami.</p>
          <p>Komitmen ini diwujudkan melalui penggunaan teknologi terkini, proses produksi yang efisien, serta layanan konsultasi profesional. Setiap tahap kerja didasarkan pada detail dan kualitas, agar setiap produk tidak hanya fungsional, tetapi juga mampu mendukung daya saing usaha pelanggan di berbagai sektor.</p>
        </div>
      </div>
    </section>

    <section class="visi-misi-section">
      <div class="visi-misi-wrapper">
        <div class="visi">
          <h3>Visi</h3>
          <p>Menjadi perusahaan manufaktur dan distribusi produk berbahan dasar plastik terdepan di Indonesia, yang dikenal atas kualitas, keberagaman produk, inovasi layanan, dan komitmen terhadap keberlanjutan. PlastikHB bertekad menjadi mitra utama bagi berbagai sektor industri, ritel, dan usaha kecil menengah.</p>
        </div>
        <div class="separator-line"></div>
        <div class="misi">
          <h3>Misi</h3>
          <p>
            <ol>
              <li>Menyediakan produk plastik berkualitas tinggi dengan variasi luas sesuai kebutuhan pasar.</li>
              <li>Mengembangkan teknologi produksi modern untuk mendukung efisiensi dan inovasi.</li>
              <li>Menerapkan prinsip keberlanjutan melalui penggunaan bahan ramah lingkungan dan proses produksi yang bertanggung jawab.</li>
              <li>Mendukung UMKM serta industri nasional melalui solusi plastik yang fungsional, terjangkau, dan dapat disesuaikan.</li>
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
              Setiap produk plastik yang kami hasilkan diproduksi dengan bahan baku berkualitas tinggi dan melalui kontrol kualitas yang ketat, sehingga konsisten, tahan lama, dan aman digunakan pada berbagai sektor industri maupun rumah tangga.
            </div>
          </li>
          <li class="toggle-item">
            <div class="toggle-header">
              <strong>Fokus pada Kepuasan Pelanggan</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              PlastikHB menempatkan kepuasan pelanggan sebagai prioritas utama. Melalui layanan yang responsif, fleksibel, dan tepat waktu, kami memastikan setiap solusi plastik yang diberikan mampu memenuhi ekspektasi pelanggan.
            </div>
          </li>
          <li class="toggle-item">
            <div class="toggle-header">
              <strong>Perbaikan dan Inovasi Berkelanjutan</strong>
              <span class="arrow"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/expand-arrow--v1.png" alt="expand-arrow--v1"/></span>
            </div>
            <div class="toggle-content">
              Kami secara rutin melakukan evaluasi terhadap proses produksi dan distribusi, serta mendorong inovasi melalui riset, penggunaan teknologi terbaru, dan pengembangan tim internal. Hal ini memastikan produk PlastikHB tetap relevan dengan kebutuhan pasar yang dinamis.
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