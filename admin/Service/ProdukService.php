<?php
require_once("../Model/Produk.php");
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
}

?>