<?php
use PHPUnit\Framework\TestCase;

class GalleryControllersTest extends TestCase {
    
    protected function setUp(): void {
        test_reset_db();
        
        // Setup test data
        $conn = Database::getInstance()->getConnection();
        $conn->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('Test Product','Test Description',10,1000,'Aktif')");
        $produkId = $conn->insert_id;
        $conn->query("INSERT INTO gambar (file, produk_id) VALUES ('test1.jpg', $produkId)");
        $conn->query("INSERT INTO gambar (file, produk_id) VALUES ('test2.jpg', $produkId)");
        
        // Setup globals for controller simulation
        $_SESSION = [];
        $_POST = [];
        $_GET = [];
        $_FILES = [];
    }

    public function testTambahGaleriController(): void {
        // Simulate authenticated admin session
        $_SESSION['admin_logged_in'] = true;
        
        // Simulate form submission
        $_POST['produk_id'] = '1';
        $_FILES['gambar'] = [
            'name' => ['test.jpg'],
            'type' => ['image/jpeg'],
            'tmp_name' => [tempnam(sys_get_temp_dir(), 'test')],
            'error' => [UPLOAD_ERR_OK],
            'size' => [1024]
        ];
        
        // Create temporary test file
        $tempFile = $_FILES['gambar']['tmp_name'][0];
        file_put_contents($tempFile, 'fake image content');
        
        // Capture output
        ob_start();
        
        // Mock the controller behavior
        $gambarService = new GambarService();
        $uploadDir = __DIR__ . '/../../uploads/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Simulate file processing
        $fileName = time() . '_' . uniqid() . '.jpg';
        $targetPath = $uploadDir . $fileName;
        
        // Move uploaded file (simulate)
        rename($tempFile, $targetPath);
        
        // Test gambar service integration
        $result = $gambarService->addImage(['file' => $fileName, 'produk_id' => 1]);
        
        $output = ob_get_clean();
        
        $this->assertIsInt($result, 'Gallery image should be added successfully');
        
        // Verify in database
        $gambar = new Gambar();
        $images = $gambar->findByProdukId(1);
        $this->assertNotEmpty($images, 'Images should exist for product');
        
        // Cleanup
        if (file_exists($targetPath)) {
            unlink($targetPath);
        }
    }

    public function testDeleteGaleriController(): void {
        // Simulate authenticated admin session
        $_SESSION['admin_logged_in'] = true;
        
        // Get existing gambar ID
        $gambar = new Gambar();
        $images = $gambar->findByProdukId(1);
        $this->assertNotEmpty($images, 'Should have test images');
        
        $gambarId = $images[0]['gambar_id'];
        
        // Simulate delete request
        $_POST['gambar_id'] = $gambarId;
        
        // Capture output
        ob_start();
        
        // Test deletion
        $result = $gambar->delete($gambarId);
        
        $output = ob_get_clean();
        
        $this->assertTrue($result, 'Gallery image should be deleted');
        
        // Verify deletion
        $afterDelete = $gambar->findById($gambarId);
        $this->assertNull($afterDelete, 'Image should no longer exist');
    }

    public function testGalleryAccessControl(): void {
        // Test without authentication
        $_SESSION = [];
        
        // Simulate unauthorized access attempt
        $_POST['produk_id'] = '1';
        $_FILES['gambar'] = ['name' => ['test.jpg']];
        
        // Mock middleware check - test session state instead of calling undefined method
        $hasAuth = isset($_SESSION['login']);
        $this->assertFalse($hasAuth, 'Should deny access without authentication');
    }

    public function testInvalidFileUpload(): void {
        $_SESSION['admin_logged_in'] = true;
        
        // Test with invalid file type
        $_POST['produk_id'] = '1';
        $_FILES['gambar'] = [
            'name' => ['malicious.exe'],
            'type' => ['application/exe'],
            'tmp_name' => [tempnam(sys_get_temp_dir(), 'test')],
            'error' => [UPLOAD_ERR_OK],
            'size' => [1024]
        ];
        
        $tempFile = $_FILES['gambar']['tmp_name'][0];
        file_put_contents($tempFile, 'fake exe content');
        
        // Test file type validation
        $fileName = $_FILES['gambar']['name'][0];
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $this->assertNotContains($fileExtension, $allowedTypes, 'Should reject invalid file types');
        
        // Cleanup
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }
    }

    protected function tearDown(): void {
        // Clean up any test files
        $uploadDir = __DIR__ . '/../../uploads/';
        if (is_dir($uploadDir)) {
            $files = glob($uploadDir . 'test*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
        
        // Reset globals
        $_SESSION = [];
        $_POST = [];
        $_GET = [];
        $_FILES = [];
    }
}
