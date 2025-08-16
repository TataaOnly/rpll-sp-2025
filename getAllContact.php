<?php
  require_once 'admin/Helpers/KontakHelper.php';
  $kontak = KontakHelper::getKontak();
  if (!$kontak) {
      // Default contact data as fallback
      $kontak = [
          'nama' => 'PlastikHB Admin',
          'email' => 'admin@plastikhb.com',
          'no_telp' => '081234567890',
          'no_wa' => '081234567890',
          'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0104676903975!2d107.6160988!3d-6.889348799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e655d336aaab%3A0xc48b605e8e3d2915!2sInstitut%20Teknologi%20Harapan%20Bangsa!5e0!3m2!1sen!2sid!4v1753878291876!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
          'alamat' => 'Alamat Toko Plastik',
      ];
  }
  
  // Ensure all required fields exist with safe defaults
  $kontak = array_merge([
      'nama' => 'PlastikHB',
      'email' => 'info@plastikhb.com',
      'no_telp' => 'Tidak tersedia',
      'no_wa' => 'Tidak tersedia',
      'alamat' => 'Alamat belum diatur',
      'map' => '<p>Peta belum tersedia</p>'
  ], $kontak);

  return $kontak;
?>