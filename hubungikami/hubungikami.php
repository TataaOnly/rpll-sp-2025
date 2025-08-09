<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hubungi Kami - PlastikHB</title>
  <link rel="icon" type="image/png" href="../images/icon.png">
  <link rel="stylesheet" href="hubungikami.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="../Beranda + Galeri/View/beranda.php"><img src="../images/logoBaru.png" alt=""></a></div>
      <div class="nav-links">
        <a href="../Beranda + Galeri/View/beranda.php">Beranda</a>
        <a href="../tentangkami/tentangkami.php">Tentang Kami</a>
        <a href="../Catalog/Frontend/shelf.php">Katalog Produk</a>
        <a href="../Beranda + Galeri/View/galeri_custom.php">Galeri Custom</a>
        <a href="hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

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
            <p><?php echo htmlspecialchars($kontak['email']); ?></p>
        </div>
        <div class="contact-card">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/phone.png" alt="phone"/>
            <h4>Nomor Telepon</h4>
            <p><?php echo htmlspecialchars($kontak['no_telp']); ?> (phone)<br><?php echo htmlspecialchars($kontak['no_wa']); ?> (WhatsApp)</p>
            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $kontak['no_wa']); ?>?text=Halo,%20saya%20ingin%20bertanya%20tentang%20produk%20PlastikHB" 
               class="whatsapp-btn" 
               target="_blank" 
               rel="noopener noreferrer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="16" height="16" />
                Chat WhatsApp
            </a>
        </div>
        <div class="contact-card">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/address--v1.png" alt="address--v1"/>
            <h4>Alamat</h4>
            <p><?php echo htmlspecialchars($kontak['alamat']); ?></p>
        </div>
        </div>
    </section>

    <section class="map-section">
        <?php echo $kontak['map']; ?>
    </section>
    </main>

  <footer class="footer-section">
      <div class="footer-overlay">
        <div class="footer-content">
            <div class="footer-left">
                <img src="../images/logoBaru.png" alt="PlastikHB" class="footer-logo">
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
    // Scroll Driven Animation for Footer
    const footer = document.querySelector('.footer-section');

    window.addEventListener('scroll', () => {
        const footerTop = footer.getBoundingClientRect().top;
        const footerBottom = footer.getBoundingClientRect().bottom;

        if (footerTop < window.innerHeight && footerBottom > 0) {
        footer.style.animation = 'fadeIn 1s ease forwards';
        } else {
        footer.style.animation = 'none';
        }
    });
  </script>
</body>
</html>