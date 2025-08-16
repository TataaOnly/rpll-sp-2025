<?php
use PHPUnit\Framework\TestCase;

class ProdukTest extends TestCase {
    protected function setUp(): void {
        test_reset_db();
        $c = Database::getInstance()->getConnection();
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('custom','Custom',0,0,'Aktif')");
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('Produk A','Desc A',10,1000,'Aktif')");
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('Produk B','Desc B',5,2000,'Non-Aktif')");
    }

    public function testGetAllSkipsCustom(): void {
        $p = new Produk();
        $all = $p->getAllProducts();
        $this->assertCount(2, $all);
        $this->assertSame('Produk A', $all[0]['nama']);
    }

    public function testGetAllIncludingCustom(): void {
        $p = new Produk();
        $all = $p->getAllProductsIncludingCustom();
        $this->assertCount(3, $all);
    }

    public function testCreateUpdateDelete(): void {
        $p = new Produk();
        $id = $p->create(['nama'=>'Produk C','deskripsi'=>'Desc C','stok'=>7,'harga'=>3000,'status'=>'Aktif']);
        $this->assertIsInt($id);
        $found = $p->findById($id);
        $this->assertSame('Produk C', $found['nama']);
        $this->assertTrue($p->update($id,['stok'=>15,'harga'=>3500]));
        $after = $p->findById($id);
        $this->assertSame(15, (int)$after['stok']);
        $this->assertSame(3500, (int)$after['harga']);
        $this->assertTrue($p->delete($id));
        $this->assertNull($p->findById($id));
    }
}
