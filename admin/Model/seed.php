<?php
require_once __DIR__ . '/../Helpers/KontakHelper.php';

echo "<h2>Database Seeding</h2>";

try {
    // Initialize default contact
    if (KontakHelper::initializeDefault()) {
        echo "Default contact initialized successfully<br>";
        echo "Default login: admin123<br>";
    } else {
        echo "Failed to initialize contact<br>";
    }
    
    // You can still seed products using direct queries since they're multiple records
    require_once '../Model/config.php';
    
    $sql = "INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES
            ('custom','', 0, 0, 'Non-Aktif'),
            ('Plastik Kresek Hitam Kecil', 'Plastik kresek warna hitam ukuran kecil, ideal untuk belanja atau pembungkus barang.', 500, 1000, 'Aktif'),
            ('Plastik Kresek Putih Sedang', 'Plastik kresek warna putih ukuran sedang, cocok untuk berbagai keperluan.', 300, 2000, 'Aktif'),
            ('Plastik Kresek Hitam Besar', 'Plastik kresek warna hitam ukuran besar, cocok untuk belanja atau pembungkus barang.', 250, 1500, 'Aktif'),
            ('Plastik PP Bening 1kg', 'Plastik bening Polypropylene (PP), ideal untuk kemasan makanan kering.', 100, 12000, 'Aktif'),
            ('Roll Plastik HDPE 50cm', 'Roll plastik HDPE lebar 50cm, kuat dan fleksibel, cocok untuk industri kemasan.', 50, 55000, 'Aktif'),
            ('Plastik Vacuum Bag 20x30cm', 'Kantong plastik untuk vacuum sealer ukuran 20x30cm, cocok untuk penyimpanan makanan.', 200, 800, 'Aktif'),
            ('Kantong Sampah Plastik Jumbo', 'Kantong sampah plastik ukuran jumbo, cocok untuk penggunaan rumah tangga atau kantor.', 180, 2500, 'Aktif'),
            ('Plastik Mika Cetak Cup 12oz', 'Plastik mika transparan untuk cup minuman ukuran 12oz.', 300, 700, 'Non-Aktif'),
            ('Plastik PE Lembaran 1m x 50m', 'Lembaran plastik PE ukuran 1m x 50m, untuk pelindung bangunan atau keperluan pertanian.', 60, 100000, 'Aktif'),
            ('Plastik OPP Sachet 8x12cm', 'Plastik OPP untuk kemasan sachet makanan ringan ukuran 8x12cm.', 500, 450, 'Aktif');";

    if (mysqli_query($conn, $sql)) {
        echo "Products seeded successfully<br>";
    } else {
        echo "Failed to seed products: " . mysqli_error($conn) . "<br>";
    }
    
    mysqli_close($conn);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

echo "<br><a href='../index.php'>← Back to Login</a>";
?>
