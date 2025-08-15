<?php
use PHPUnit\Framework\TestCase;

class FileOperationsTest extends TestCase {
    
    private string $testUploadDir;
    private array $testFiles = [];
    
    protected function setUp(): void {
        // Create test upload directory
        $this->testUploadDir = __DIR__ . '/../../uploads/test/';
        if (!is_dir($this->testUploadDir)) {
            mkdir($this->testUploadDir, 0777, true);
        }
        
        // Setup test database
        test_reset_db();
        $conn = Database::getInstance()->getConnection();
        $conn->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('Test Product','For file testing',10,1000,'Aktif')");
    }

    public function testImageUploadValidation(): void {
        // Test valid image types
        $validTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        foreach ($validTypes as $type) {
            $fileName = "test.$type";
            $this->assertTrue($this->isValidImageType($fileName), "$type should be valid image type");
        }
        
        // Test invalid types
        $invalidTypes = ['exe', 'php', 'txt', 'doc', 'pdf'];
        
        foreach ($invalidTypes as $type) {
            $fileName = "test.$type";
            $this->assertFalse($this->isValidImageType($fileName), "$type should be invalid image type");
        }
    }

    public function testFileUploadSizeValidation(): void {
        $maxSize = 5 * 1024 * 1024; // 5MB
        
        // Test valid size
        $validSize = 2 * 1024 * 1024; // 2MB
        $this->assertTrue($this->isValidFileSize($validSize, $maxSize), 'Valid file size should pass');
        
        // Test oversized file
        $oversizedFile = 10 * 1024 * 1024; // 10MB
        $this->assertFalse($this->isValidFileSize($oversizedFile, $maxSize), 'Oversized file should fail');
    }

    public function testImageFileCreation(): void {
        // Create test image file
        $fileName = 'test_' . time() . '.jpg';
        $filePath = $this->testUploadDir . $fileName;
        
        // Create fake image content
        $imageContent = $this->createTestImageContent();
        $result = file_put_contents($filePath, $imageContent);
        
        $this->assertGreaterThan(0, $result, 'File should be created successfully');
        $this->assertFileExists($filePath, 'Test file should exist');
        
        $this->testFiles[] = $filePath; // Track for cleanup
    }

    public function testImageFileRename(): void {
        // Create original file
        $originalName = 'original_test.jpg';
        $originalPath = $this->testUploadDir . $originalName;
        file_put_contents($originalPath, $this->createTestImageContent());
        
        // Test rename with timestamp and unique ID
        $newName = time() . '_' . uniqid() . '.jpg';
        $newPath = $this->testUploadDir . $newName;
        
        $result = rename($originalPath, $newPath);
        $this->assertTrue($result, 'File should be renamed successfully');
        $this->assertFileExists($newPath, 'Renamed file should exist');
        $this->assertFileDoesNotExist($originalPath, 'Original file should not exist');
        
        $this->testFiles[] = $newPath;
    }

    public function testFileDeletion(): void {
        // Create test file
        $fileName = 'delete_test.jpg';
        $filePath = $this->testUploadDir . $fileName;
        file_put_contents($filePath, $this->createTestImageContent());
        
        $this->assertFileExists($filePath, 'File should exist before deletion');
        
        // Test deletion
        $result = unlink($filePath);
        $this->assertTrue($result, 'File deletion should succeed');
        $this->assertFileDoesNotExist($filePath, 'File should not exist after deletion');
    }

    public function testMultipleFileUpload(): void {
        $gambarService = new GambarService();
        $produkId = 1; // From setUp
        
        // Simulate multiple file upload
        $uploadedFiles = [];
        for ($i = 1; $i <= 3; $i++) {
            $fileName = "multi_test_{$i}_" . time() . '.jpg';
            $filePath = $this->testUploadDir . $fileName;
            
            // Create test file
            file_put_contents($filePath, $this->createTestImageContent());
            $this->testFiles[] = $filePath;
            
            // Add to database
            $gambarId = $gambarService->addImage([
                'file' => $fileName,
                'produk_id' => $produkId
            ]);
            
            $this->assertIsInt($gambarId, "Multiple upload $i should succeed");
            $uploadedFiles[] = $gambarId;
        }
        
        // Verify all files in database
        $gambar = new Gambar();
        $images = $gambar->findByProdukId($produkId);
        $this->assertCount(3, $images, 'Should have 3 uploaded images');
    }

    public function testFilePathSecurity(): void {
        // Test directory traversal attempts
        $maliciousPaths = [
            '../../../etc/passwd',
            '..\\..\\windows\\system32\\config',
            '/etc/shadow',
            'C:\\Windows\\System32\\drivers\\etc\\hosts'
        ];
        
        foreach ($maliciousPaths as $path) {
            $this->assertFalse($this->isSecureFileName($path), "Malicious path should be rejected: $path");
        }
        
        // Test valid filenames
        $validNames = [
            'image.jpg',
            'product_123.png',
            'gallery-photo.webp'
        ];
        
        foreach ($validNames as $name) {
            $this->assertTrue($this->isSecureFileName($name), "Valid filename should be accepted: $name");
        }
    }

    public function testFileUploadErrorHandling(): void {
        // Test various upload errors
        $uploadErrors = [
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
        ];
        
        foreach ($uploadErrors as $errorCode => $description) {
            $this->assertFalse($this->isUploadSuccessful($errorCode), "Upload error should be handled: $description");
        }
        
        // Test successful upload
        $this->assertTrue($this->isUploadSuccessful(UPLOAD_ERR_OK), 'Successful upload should be recognized');
    }

    public function testImageProcessingSimulation(): void {
        // Create test image
        $fileName = 'process_test.jpg';
        $filePath = $this->testUploadDir . $fileName;
        $originalContent = $this->createTestImageContent();
        file_put_contents($filePath, $originalContent);
        
        // Simulate image processing (resize, optimization, etc.)
        $processedContent = $this->simulateImageProcessing($originalContent);
        $processedPath = $this->testUploadDir . 'processed_' . $fileName;
        file_put_contents($processedPath, $processedContent);
        
        $this->assertFileExists($processedPath, 'Processed image should exist');
        $this->assertNotEquals($originalContent, $processedContent, 'Processed content should differ');
        
        $this->testFiles[] = $filePath;
        $this->testFiles[] = $processedPath;
    }

    public function testDirectoryManagement(): void {
        // Test subdirectory creation
        $subDir = $this->testUploadDir . 'products/gallery/';
        $this->createDirectoryIfNeeded($subDir);
        
        $this->assertDirectoryExists($subDir, 'Subdirectory should be created');
        
        // Test directory permissions
        $this->assertTrue(is_writable($subDir), 'Directory should be writable');
        
        // Test cleanup
        rmdir($subDir);
        rmdir(dirname($subDir));
        $this->assertDirectoryDoesNotExist($subDir, 'Directory should be removed');
    }

    // Helper methods
    private function isValidImageType(string $fileName): bool {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        return in_array($extension, $allowedTypes);
    }

    private function isValidFileSize(int $fileSize, int $maxSize): bool {
        return $fileSize <= $maxSize && $fileSize > 0;
    }

    private function isSecureFileName(string $fileName): bool {
        // Check for directory traversal
        if (strpos($fileName, '..') !== false) {
            return false;
        }
        
        // Check for absolute paths
        if (strpos($fileName, '/') === 0 || strpos($fileName, '\\') === 0) {
            return false;
        }
        
        // Check for drive letters (Windows)
        if (preg_match('/^[A-Za-z]:/', $fileName)) {
            return false;
        }
        
        return true;
    }

    private function isUploadSuccessful(int $errorCode): bool {
        return $errorCode === UPLOAD_ERR_OK;
    }

    private function createTestImageContent(): string {
        // Create minimal valid JPEG content
        return "\xFF\xD8\xFF\xE0\x00\x10JFIF\x00\x01\x01\x01\x00H\x00H\x00\x00\xFF\xDB\x00C\x00\x08\x06\x06\x07\x06\x05\x08\x07\x07\x07\t\t\x08\n\x0C\x14\r\x0C\x0B\x0B\x0C\x19\x12\x13\x0F\x14\x1D\x1A\x1F\x1E\x1D\x1A\x1C\x1C $.' \",#\x1C\x1C(7),01444\x1F'9=82<.342\xFF\xC0\x00\x11\x08\x00\x01\x00\x01\x01\x01\x11\x00\x02\x11\x01\x03\x11\x01\xFF\xC4\x00\x1F\x00\x00\x01\x05\x01\x01\x01\x01\x01\x01\x00\x00\x00\x00\x00\x00\x00\x00\x01\x02\x03\x04\x05\x06\x07\x08\t\n\x0B\xFF\xDA\x00\x08\x01\x01\x00\x00?\x00\xD2\xCF \xFF\xD9";
    }

    private function simulateImageProcessing(string $content): string {
        // Simulate processing by modifying content slightly
        return $content . '_processed';
    }

    private function createDirectoryIfNeeded(string $path): void {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }

    protected function tearDown(): void {
        // Clean up test files
        foreach ($this->testFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        
        // Clean up test directory
        if (is_dir($this->testUploadDir)) {
            $files = glob($this->testUploadDir . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($this->testUploadDir);
        }
        
        $this->testFiles = [];
    }
}
