<?php /* Frontend only, fetches product detail from backend */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk | PlastikHB</title>
    <link rel="icon" type="image/png" href="../../images/icon.png">
    <!-- <link rel="stylesheet" href="css/details.css"> -->
    <script src="js/details.js" defer></script>
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

        h2,
        h3 {
            text-transform: uppercase;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        h3 {
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

        .logo img {
            width: 20%;
        }

        .main {
            padding: 32px 32px 20px 32px;
        }

        .detail-flex {
            display: flex;
            gap: 40px;
            align-items: flex-start;
            width: 100%;
        }

        .detail-left {
            flex: 1 1 320px;
            max-width: 320px;
            display: flex;
            flex-direction: column;
        }

        .image-box {
            width: 100%;
            aspect-ratio: 1/1;
            border: 1px solid #bbb;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 24px;
            position: relative;
        }

        .arrow {
            font-size: 1.5rem;
            color: #888;
            cursor: pointer;
            user-select: none;
            margin: 0 8px;
        }

        .image-label {
            flex: 1;
            text-align: center;
            color: #444;
        }

        .desc-label {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .desc-box {
            min-height: 48px;
            font-size: 1rem;
            color: #222;
            background: #fafbfc;
            border-radius: 4px;
            padding: 10px 12px;
            border: 1px solid #eee;
        }

        .detail-right {
            flex: 2 1 400px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-width: 0;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .divider {
            border: none;
            border-top: 1px solid #bbb;
            margin: 8px 0 24px 0;
            width: 100%;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 1.1rem;
            margin-bottom: 32px;
        }

        .order-btn {
            background: #4ad97f;
            color: #222;
            border: none;
            border-radius: 16px;
            padding: 12px 40px;
            font-size: 1.2rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            align-self: flex-end;
        }

        .order-btn:hover {
            background: #36b96a;
        }

        .order-link {
            align-self: flex-end;
        }
    
        .page-container {
            padding: 0 2vw;
            width: 100%;
            box-sizing: border-box;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 32px;
            padding: 32px 0;
        }

        .product-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: box-shadow 0.2s;
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .product-footer {
            padding: 16px;
            font-weight: bold;
            text-align: center;
            width: 100%;
            color: #222;
            background: #f7faff;
        }

        button, .main button {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 200px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 15px;
            font-weight: bolder;
            transition: background 0.2s;
        }

        .button-right {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            width: 100%;
            margin-bottom: 18px;
        }

        .button-right button {
            margin: 0;
            display: inline-block;
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
            background: url('../../images/pabrikPlastikHB.jpg') center/cover no-repeat;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .footer-overlay {
            background-color: rgba(148, 163, 248, 0.8);
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
            background-color: #0056b3;
            text-align: center;
            padding: 15px 0;
            font-size: 18px;
            font-weight: bold;
        }


        .filter-row input[type="checkbox"] {
            margin-right: 8px;
            transform: scale(2.5)
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><a href="../../Beranda/Frontend/beranda.php"><img src="../../images/logoBaru.png" alt=""></a></div>
            <div class="nav-links">
                <a href="../../Beranda/Frontend/beranda.php">Beranda</a>
                <a href="../../tentangkami/Frontend/tentangkami.php">Tentang Kami</a>
                <a href="shelf.php">Katalog Produk</a>
                <a href="../../Galeri/Frontend/galeri_custom.php">Galeri Custom</a>
                <a href="../../hubungikami/Frontend/hubungikami.php">Hubungi Kami</a>
            </div>
        </nav>
    </header>

    <?php
        $kontak = include __DIR__ . '/../../getAllContact.php';
    ?>

    <div class="main">
        <div class="detail-container" id="detailContainer">
            <div>Loading...</div>
        </div>
    </div>

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
