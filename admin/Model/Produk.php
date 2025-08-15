<?php

require_once 'Database.php'; 
class Produk {
    
    private $conn;
    private $table = 'produk';
    private $columns = [];

    public function __construct() {
        // Fix: Add error handling for Database connection
        try {
            $this->conn = Database::getInstance()->getConnection();
            $this->loadColumns();
        } catch (Exception $e) {
            throw new Exception("Failed to initialize Produk class: " . $e->getMessage());
        }
    }

    private function loadColumns() {
        // Fix: Add error handling for DESCRIBE query
        $stmt = $this->conn->query("DESCRIBE {$this->table}");
        if (!$stmt) {
            throw new Exception("Failed to load table columns: " . $this->conn->error);
        }
        
        while ($row = $stmt->fetch_assoc()) {
            $this->columns[] = $row['Field'];
        }
    }

    public function getAllProducts() {
        $query = "SELECT * FROM {$this->table} WHERE produk_id > 1 ORDER BY produk_id ASC"; // Skip first product (ID = 1)
        $result = $this->conn->query($query);
        
        // Fix: Add error handling
        if (!$result) {
            return false;
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllProductsIncludingCustom() {
        $query = "SELECT * FROM {$this->table} ORDER BY produk_id"; // Include all products
        $result = $this->conn->query($query);
        
        // Fix: Add error handling
        if (!$result) {
            return false;
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCustomProduct() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE produk_id = 1 OR nama = 'custom' LIMIT 1");
        
        if (!$stmt) {
            return false;
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        
        return $data;
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE produk_id = ?");
        
        // Fix: Add error handling
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close(); // Fix: Add cleanup
        
        return $data;
    }

    public function update($id, $data) {
        $setParts = [];
        $values = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $this->columns)) {
                // Fix: Better type detection and safe value handling
                if (is_int($value) || ($key === 'stok' && is_numeric($value))) {
                    $setParts[] = "{$key} = " . (int)$value;
                } elseif (is_float($value) || ($key === 'harga' && is_numeric($value))) {
                    $setParts[] = "{$key} = " . (float)$value;
                } else {
                    $setParts[] = "{$key} = '" . $this->conn->real_escape_string((string)$value) . "'";
                }
            }
        }
        
        if (empty($setParts)) {
            return false; // No valid fields to update
        }

        $setQuery = implode(', ', $setParts);
        $query = "UPDATE {$this->table} SET {$setQuery} WHERE produk_id = " . (int)$id;
        
        return $this->conn->query($query) !== false;
    }

    public function create($data) {
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            // Fix: Exclude auto-increment ID field
            if (in_array($key, $this->columns) && $key !== 'produk_id') {
                $fields[] = $key;
                
                // Fix: Better type detection and safe value handling
                if (is_int($value) || ($key === 'stok' && is_numeric($value))) {
                    $values[] = (int)$value;
                } elseif (is_float($value) || ($key === 'harga' && is_numeric($value))) {
                    $values[] = (float)$value;
                } else {
                    $values[] = "'" . $this->conn->real_escape_string((string)$value) . "'";
                }
            }
        }

        if (empty($fields)) {
            return false; // No valid fields to insert
        }

        $fieldsQuery = implode(', ', $fields);
        $valuesQuery = implode(', ', $values);

        $query = "INSERT INTO {$this->table} ({$fieldsQuery}) VALUES ({$valuesQuery})";
        
        if ($this->conn->query($query)) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE produk_id = " . (int)$id;
        return $this->conn->query($query) !== false;
    }

    public function getColumns() {
        return $this->columns;
    }
}

?>