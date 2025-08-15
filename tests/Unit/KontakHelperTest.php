<?php
use PHPUnit\Framework\TestCase;

class KontakHelperTest extends TestCase {
    protected function setUp(): void {
        test_reset_db();
    }

    public function testInitializeAndUpdate(): void {
        $this->assertTrue(KontakHelper::initializeDefault());
        $k = KontakHelper::getKontak();
        $this->assertSame('PlastikHB Admin',$k['nama']);
        $this->assertTrue(KontakHelper::updateKontak(['nama'=>'Baru','alamat'=>'Alamat Baru']));
        $k2 = KontakHelper::getKontak();
        $this->assertSame('Baru',$k2['nama']);
        $this->assertSame('Alamat Baru',$k2['alamat']);
    }

    public function testPasswordLifecycle(): void {
        KontakHelper::initializeDefault();
        $this->assertTrue(KontakHelper::verifyAdminPassword('admin123'));
        $this->assertTrue(KontakHelper::updateAdminPassword('baru123'));
        $this->assertTrue(KontakHelper::verifyAdminPassword('baru123'));
        $this->assertFalse(KontakHelper::verifyAdminPassword('admin123'));
    }
}
