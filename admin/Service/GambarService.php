<?php
require_once("../Model/Gambar.php");

class GambarService {
    private $gambarModel;

    public function __construct() {
        $this->gambarModel = new Gambar();
    }

    public function getAllImagesByProductId($productId) {
        return $this->gambarModel->findByProdukId($productId);
    }

    public function addImage($data) {
        return $this->gambarModel->create($data);
    }

    // Enhanced delete - returns file info for controller to handle cleanup
    public function deleteImage($id) {
        $image = $this->gambarModel->findById($id);
        if (!$image) {
            return false;
        }
        
        $result = $this->gambarModel->delete($id);
        return $result ? $image['file'] : false; // Return filename for controller cleanup
    }

    // Enhanced bulk delete - returns file list for controller cleanup
    public function deleteImages($ids) {
        if (empty($ids)) {
            return false;
        }
        
        // Get file names before deletion
        $files = [];
        foreach ($ids as $id) {
            $image = $this->gambarModel->findById($id);
            if ($image) {
                $files[] = $image['file'];
            }
        }
        
        $result = $this->gambarModel->deleteMultiple($ids);
        return $result ? $files : false; // Return filenames for controller cleanup
    }

    public function deleteImagesByProductId($productId) {
        // Get files before deletion for controller cleanup
        $images = $this->gambarModel->findByProdukId($productId);
        $files = array_column($images, 'file');
        
        $result = $this->gambarModel->deleteByProdukId($productId);
        return $result ? $files : false;
    }

    public function getImageById($id) {
        return $this->gambarModel->findById($id);
    }

    public function getColumns() {
        return $this->gambarModel->getColumns();
    }

    public function updateImage($id, $data) {
        return $this->gambarModel->update($id, $data);
    }

    // Validation only - no file operations
    public function validateImageFile($file) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $max_size = 10 * 1024 * 1024; // 10MB
        
        $errors = [];
        
        if (!in_array($file['type'], $allowed_types)) {
            $errors[] = "Invalid file type. Allowed: JPEG, PNG, GIF, WebP";
        }
        
        if ($file['size'] > $max_size) {
            $errors[] = "File too large. Maximum size: 10MB";
        }
        
        return empty($errors) ? true : $errors;
    }
}
?>