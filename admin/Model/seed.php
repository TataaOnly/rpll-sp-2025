
<?php
include_once("../Model/config.php");

// Sample data - modify as needed
$nama = "Admin User";
$email = "admin@example.com";
$no_telp = "081234567890";
$no_wa = "081234567890";
$map = "https://maps.google.com/...";
$alamat = "Jl. Contoh No. 123, Jakarta";

// Set your admin password here
$plain_password = "admin123"; // Change this to your desired password
$admin_pass = password_hash($plain_password, PASSWORD_DEFAULT);

// Prepare the SQL query
$sql = "INSERT INTO kontak (nama, email, no_telp, no_wa, map, alamat, admin_pass) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssssss", $nama, $email, $no_telp, $no_wa, $map, $alamat, $admin_pass);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Kontak entry created successfully!<br>";
        echo "Email: $email<br>";
        echo "Password: $plain_password<br>";
        echo "Hashed password: $admin_pass<br>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

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
mysqli_query($conn, $sql);

mysqli_close($conn);
?>