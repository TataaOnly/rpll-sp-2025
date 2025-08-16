<?php
use PHPUnit\Framework\TestCase;

class GambarTest extends TestCase {
    protected function setUp(): void {
        test_reset_db();
        $c = Database::getInstance()->getConnection();
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('custom','Custom',0,0,'Aktif')");
        $c->query("INSERT INTO produk (nama, deskripsi, stok, harga, status) VALUES ('Produk A','Desc A',10,1000,'Aktif')");
    }

    public function testImageCrud(): void {
        $g = new Gambar();
        $id1 = $g->create(['file'=>'a.png','produk_id'=>2]);
        $id2 = $g->create(['file'=>'b.png','produk_id'=>2]);
        $this->assertIsInt($id1);
        $this->assertIsInt($id2);
        $f1 = $g->findById($id1);
        $this->assertSame('a.png',$f1['file']);
        $list = $g->findByProdukId(2);
        $this->assertCount(2,$list);
        $this->assertTrue($g->update($id1,['file'=>'a2.png']));
        $this->assertSame('a2.png',$g->findById($id1)['file']);
        $this->assertTrue($g->delete($id2));
        $this->assertCount(1,$g->findByProdukId(2));
        $this->assertTrue($g->deleteByProdukId(2));
        $this->assertCount(0,$g->findByProdukId(2));
    }
}
