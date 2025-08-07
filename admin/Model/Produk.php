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
        $types = '';
        $values = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $this->columns)) {
                $setParts[] = "{$key} = ?";
                
                // Fix: Better type detection
                if (is_int($value) || ($key === 'stok' && is_numeric($value))) {
                    $types .= 'i';
                    $values[] = (int)$value; // Ensure it's an integer
                } elseif (is_float($value) || ($key === 'harga' && is_numeric($value))) {
                    $types .= 'd';
                    $values[] = (float)$value; // Ensure it's a float
                } else {
                    $types .= 's';
                    $values[] = (string)$value; // Ensure it's a string
                }
            }
        }
        
        if (empty($setParts)) {
            return false; // No valid fields to update
        }

        $types .= 'i'; // Add type for id
        $values[] = (int)$id; // Ensure ID is integer

        $setQuery = implode(', ', $setParts);
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET {$setQuery} WHERE produk_id = ?");
        
        // Fix: Add error handling
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function create($data) {
        $fields = [];
        $placeholders = [];
        $types = '';
        $values = [];

        foreach ($data as $key => $value) {
            // Fix: Exclude auto-increment ID field
            if (in_array($key, $this->columns) && $key !== 'produk_id') {
                $fields[] = $key;
                $placeholders[] = '?';
                
                // Fix: Better type detection (same as update)
                if (is_int($value) || ($key === 'stok' && is_numeric($value))) {
                    $types .= 'i';
                    $values[] = (int)$value;
                } elseif (is_float($value) || ($key === 'harga' && is_numeric($value))) {
                    $types .= 'd';
                    $values[] = (float)$value;
                } else {
                    $types .= 's';
                    $values[] = (string)$value;
                }
            }
        }

        if (empty($fields)) {
            return false; // No valid fields to insert
        }

        $fieldsQuery = implode(', ', $fields);
        $placeholdersQuery = implode(', ', $placeholders);

        $stmt = $this->conn->prepare("INSERT INTO {$this->table} ({$fieldsQuery}) VALUES ({$placeholdersQuery})");
        
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $insertedId = $this->conn->insert_id;
        $stmt->close();

        return $result ? $insertedId : false;
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE produk_id = ?");
        
        if (!$stmt) {
            return false; // Prepare failed
        }
        
        $stmt->bind_param("i", (int)$id); // Fix: Ensure ID is integer
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getColumns() {
        return $this->columns;
    }
}

?>