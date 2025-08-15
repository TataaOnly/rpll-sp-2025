-- Schema for test database plastik_test (mirrors production schema minimal)
DROP TABLE IF EXISTS gambar;
DROP TABLE IF EXISTS produk;
DROP TABLE IF EXISTS kontak;

CREATE TABLE produk (
    produk_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    stok INT(255) DEFAULT 0,
    harga INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Aktif', 'Non-Aktif') DEFAULT 'Aktif'
);

CREATE TABLE gambar (
    gambar_id INT AUTO_INCREMENT PRIMARY KEY,
    file VARCHAR(255) NOT NULL,
    produk_id INT NOT NULL,
    FOREIGN KEY (produk_id) REFERENCES produk(produk_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE kontak (
    kontak_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    no_telp VARCHAR(13),
    no_wa VARCHAR(13),
    map TEXT,
    alamat VARCHAR(255),
    admin_pass VARCHAR(255) NOT NULL
);
