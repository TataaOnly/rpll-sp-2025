<?php
use PHPUnit\Framework\TestCase;

class ServiceLayerTest extends TestCase {
    protected function setUp(): void {
        test_reset_db();
        $c = Database::getInstance()->getConnection();
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('custom','Custom',0,0,'Aktif')");
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('Produk A','Desc A',10,1000,'Aktif')");
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('Produk B','Desc B',0,2000,'Non-Aktif')");
    }

    public function testServiceFlows(): void {
        $produkService = new ProdukService();
        $gambarService = new GambarService();
        $this->assertCount(2, $produkService->getAllProducts());
        $this->assertCount(3, $produkService->getAllProductsIncludingCustom());
        $this->assertSame('custom', $produkService->getCustomProduct()['nama']);
        $newId = $produkService->addProduct(['nama'=>'Produk C','deskripsi'=>'Desc C','stok'=>3,'harga'=>1500,'status'=>'Aktif']);
        $this->assertIsInt($newId);
        $this->assertTrue($produkService->updateProduct($newId,['stok'=>8]));
        $this->assertSame(8,(int)$produkService->findProductById($newId)['stok']);
        $val = $produkService->validateProductData(['stok'=>-1]);
        $this->assertIsArray($val);
        $img1 = $gambarService->addImage(['file'=>'x.png','produk_id'=>$newId]);
        $img2 = $gambarService->addImage(['file'=>'y.png','produk_id'=>$newId]);
        $this->assertIsInt($img1); $this->assertIsInt($img2);
        $this->assertCount(2,$gambarService->getAllImagesByProductId($newId));
        $deletedFilename = $gambarService->deleteImage($img1);
        $this->assertIsString($deletedFilename);
        $this->assertCount(1,$gambarService->getAllImagesByProductId($newId));
        $bulk = $gambarService->deleteImages([$img2]);
        $this->assertIsArray($bulk);
        $this->assertCount(0,$gambarService->getAllImagesByProductId($newId));
    }
}
