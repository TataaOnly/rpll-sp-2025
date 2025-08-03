<?php
require_once __DIR__ . "/../Model/Produk.php";
class ProdukService {

    private $produkModel;

    public function __construct() {
        $this->produkModel = new Produk();
    }

    public function getAllProducts() {
        return $this->produkModel->getAllProducts();
    }
    public function findProductById($id) {
        return $this->produkModel->findById($id);
    }
    public function addProduct($data) {
       return $this->produkModel->create($data);
    }

    public function updateProduct($id, $data) {
        return $this->produkModel->update($id, $data);
    }

    public function deleteProduct($id) {
        return $this->produkModel->delete($id);
    }

    public function getColumns() {
        return $this->produkModel->getColumns();
    }

    public function validateProductData($data) {
        $errors = [];
        
        if (empty($data['nama'])) {
            $errors[] = 'Product name is required';
        }
        
        if (!isset($data['harga']) || $data['harga'] <= 0) {
            $errors[] = 'Price must be greater than 0';
        }
        
        if (!isset($data['stok']) || $data['stok'] < 0) {
            $errors[] = 'Stock cannot be negative';
        }
        
        return empty($errors) ? true : $errors;
    }

    public function updateProductStatus($id, $status) {
        if (!in_array($status, ['Aktif', 'Non-Aktif'])) {
            return false;
        }
        
        $data = ['status' => $status];
        return $this->produkModel->update($id, $data);
    }
}

?>