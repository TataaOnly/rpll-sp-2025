<?php
require_once '../../admin/Service/ProdukService.php';
require_once '../../admin/Service/GambarService.php';

class ProductController {
    private $produkService;
    private $gambarService;

    public function __construct() {
        $this->produkService = new ProdukService();
        $this->gambarService = new GambarService();
    }

    public function getProductsWithImage($limit = 8) {
        $products = $this->produkService->getAllProducts();
        $result = [];

        if ($products && count($products) > 0) {
            $count = 0;
            foreach ($products as $product) {
                if ($count >= $limit) break;

                $produk_id = $product['produk_id'];
                $images = $this->gambarService->getAllImagesByProductId($produk_id);

                $result[] = [
                    'id' => $produk_id,
                    'name' => htmlspecialchars($product['nama']),
                    'image' => ($images && count($images) > 0) 
                        ? '../../uploads/' . $images[0]['file'] 
                        : '../../images/icon.png'
                ];

                $count++;
            }
        }

        // Jika kurang dari $limit, tambahkan slot kosong
        while (count($result) < $limit) {
            $result[] = [
                'id' => null,
                'name' => '',
                'image' => '../../images/icon.png'
            ];
        }

        return $result;
    }
}
