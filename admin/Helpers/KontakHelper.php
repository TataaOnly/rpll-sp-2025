<?php
require_once __DIR__ . '/../Model/Database.php';

class KontakHelper {
    private static $conn;

    private static function getConnection() {
        if (self::$conn === null) {
            self::$conn = Database::getInstance()->getConnection();
        }
        return self::$conn;
    }


    public static function getKontak() {
        $conn = self::getConnection();

        $result = $conn->query("SELECT kontak_id, nama, email, no_telp, no_wa, map, alamat FROM kontak LIMIT 1");
        if (!$result) {
            return false;
        }

        return $result->fetch_assoc();
    }

    public static function getAdminPassword() {
        $conn = self::getConnection();

        $result = $conn->query("SELECT admin_pass FROM kontak LIMIT 1");
        if (!$result) {
            return false; // Error executing query
        }
        $kontak = $result->fetch_assoc();
        if (!$kontak || !isset($kontak['admin_pass'])) {
            return false; // No admin password set
        }
        return $kontak['admin_pass'];
    }

    public static function updateKontak($data) {
        $conn = self::getConnection();

        $fields = [];
        $values = [];
        $types = '';
        
        $sql = "DESCRIBE kontak";
        $result = $conn->query($sql);
        if (!$result) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            $field = $row['Field'];
            if (isset($data[$field])) {
                if($field == 'kontak_id') {
                    continue; // Skip primary key
                }
                $fields[] = "$field = ?";
                $values[] = $data[$field];
                $types .= $row['Type'] === 'int' ? 'i' : 's'; // Assuming int or string types
            }
        }

        if (empty($fields)) {
            return false; // No fields to update
        }

        $sql = "UPDATE kontak SET " . implode(', ', $fields) . " LIMIT 1";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return false; // Error preparing statement
        }
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public static function verifyAdminPassword($password) {
        // INPUT VALIDATION
        if (empty($password) || !is_string($password)) {
            return false;
        }
        
        $hashedPassword = self::getAdminPassword();
        
        if (!$hashedPassword) {
            error_log("KontakHelper: No admin password available for verification");
            return false;
        }

        return password_verify($password, $hashedPassword);
    }

    public static function updateAdminPassword($password) {
        $conn = self::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE kontak SET admin_pass = ? LIMIT 1");
        if (!$stmt) {
            return false; // Error preparing statement
        }

        $stmt->bind_param('s', $hashedPassword);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public static function initializeDefault(){
        $conn = self::getConnection();
        
        // Check if kontak already exists
        $result = $conn->query("SELECT COUNT(*) as count FROM kontak");
        if (!$result) {
            return false; // Error checking existing records
        }
        
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return true; // Kontak already initialized
        }

        // Create default contact
        $default_data = [
            'nama' => 'PlastikHB Admin',
            'email' => 'admin@plastikhb.com',
            'no_telp' => '081234567890',
            'no_wa' => '081234567890',
            'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0104676903975!2d107.6160988!3d-6.889348799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e655d336aaab%3A0xc48b605e8e3d2915!2sInstitut%20Teknologi%20Harapan%20Bangsa!5e0!3m2!1sen!2sid!4v1753878291876!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'alamat' => 'Alamat Toko',
            'admin_pass' => password_hash('admin123', PASSWORD_DEFAULT)
        ];
        
        $sql = "INSERT INTO kontak (nama, email, no_telp, no_wa, map, alamat, admin_pass) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("sssssss", 
            $default_data['nama'],
            $default_data['email'], 
            $default_data['no_telp'],
            $default_data['no_wa'],
            $default_data['map'],
            $default_data['alamat'],
            $default_data['admin_pass']
        );
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
}

?>