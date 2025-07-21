-- Table 1: Produk (Products)
CREATE TABLE produk (
    produk_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    stok INT(255) DEFAULT 0,
    harga INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Aktif', 'Non-Aktif') DEFAULT 'Aktif'
);

-- Table 2: Gambar (Images)
CREATE TABLE gambar (
    gambar_id INT AUTO_INCREMENT PRIMARY KEY,
    file VARCHAR(255) NOT NULL COMMENT 'File path or filename',
    produk_id INT NOT NULL,
    FOREIGN KEY (produk_id) REFERENCES produk(produk_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table 3: Kontak (Contact)
CREATE TABLE kontak (
    kontak_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    no_telp VARCHAR(13),
    no_wa VARCHAR(13),
    map VARCHAR(255) COMMENT 'Map coordinates or URL',
    alamat VARCHAR(255)
    admin_pass varchar(255) NOT NULL
);
