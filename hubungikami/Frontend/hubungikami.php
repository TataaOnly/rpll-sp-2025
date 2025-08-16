<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hubungi Kami - PlastikHB</title>
  <link rel="icon" type="image/png" href="../../images/icon.png">
  <link rel="stylesheet" href="css/hubungikami.css">
  <script src="js/hubungikami.js" defer></script>
</head>
<body>
  <header>
    <nav>
      <div class="logo"><a href="../../Beranda/Frontend/beranda.php"><img src="../../images/logoBaru.png" alt=""></a></div>
      <div class="nav-links">
        <a href="../../Beranda/Frontend/beranda.php">Beranda</a>
        <a href="../../tentangkami/Frontend/tentangkami.php">Tentang Kami</a>
        <a href="../../Catalog/Frontend/shelf.php">Katalog Produk</a>
        <a href="../../Galeri/Frontend/galeri_custom.php">Galeri Custom</a>
        <a href="hubungikami.php">Hubungi Kami</a>
      </div>
    </nav>
  </header>

  <?php
    $kontak = include __DIR__ . '/../../getAllContact.php';
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
                <img src="../../images/logoBaru.png" alt="PlastikHB" class="footer-logo">
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