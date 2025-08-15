<?php
// PHPUnit bootstrap
require_once __DIR__ . '/../admin/Model/Database.php';
require_once __DIR__ . '/../admin/Helpers/KontakHelper.php';
require_once __DIR__ . '/../admin/Helpers/ErrorHandler.php';
require_once __DIR__ . '/../admin/Model/Produk.php';
require_once __DIR__ . '/../admin/Model/Gambar.php';
require_once __DIR__ . '/../admin/Service/ProdukService.php';
require_once __DIR__ . '/../admin/Service/GambarService.php';
require_once __DIR__ . '/../admin/Middleware/AuthMiddleware.php';

// Utility to reset DB state
function test_reset_db() : void {
    $conn = Database::getInstance()->getConnection();
    $conn->query('SET FOREIGN_KEY_CHECKS=0');
    foreach (['gambar','produk','kontak'] as $t) { $conn->query("TRUNCATE $t"); }
    $conn->query('SET FOREIGN_KEY_CHECKS=1');
}
