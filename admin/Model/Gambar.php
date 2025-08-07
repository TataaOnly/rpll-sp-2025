<?php

require_once 'Database.php'; 
class Gambar {
    private $conn;
    private $table = 'gambar';
    private $columns = [];

    public function __construct() {
        // Fix: Add error handling for Database connection
        try {
            $this->conn = Database::getInstance()->getConnection();
            $this->loadColumns();
        } catch (Exception $e) {
            throw new Exception("Failed to initialize Gambar class: " . $e->getMessage());
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

    public function getColumns() {
        return $this->columns;
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE gambar_id = ?");
        
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

    public function findByProdukId($produk_id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE produk_id = ? ORDER BY gambar_id DESC");
        
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("i", $produk_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        return $data;
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE gambar_id = ?");
        
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close(); 
        
        return $result;
    }

    public function deleteMultiple($ids) {
        if (empty($ids)) {
            return false;
        }
        
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $types = str_repeat('i', count($ids));
        
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE gambar_id IN ({$placeholders})");
        
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param($types, ...$ids);
        $result = $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
        
        return $result ? $affected_rows : false;
    }


    public function create($data) {
        $fields = [];
        $placeholders = [];
        $types = '';
        $values = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $this->columns) && $key !== 'gambar_id') {
                $fields[] = $key;
                $placeholders[] = '?';
                if ($key === 'produk_id' && is_numeric($value)) {
                    $types .= 'i';
                    $values[] = (int)$value;
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
        
        if( !$stmt) {
            return false; // Error preparing statement
        }

        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $insertedId = $this->conn->insert_id;
        $stmt->close();

        return $result ? $insertedId : false;
    }

    public function update($id, $data) {
        $fields = [];
        $types = '';
        $values = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $this->columns)) {
                $fields[] = "{$key} = ?";
                if ($key === 'produk_id' && is_numeric($value)) {
                    $types .= 'i';
                    $values[] = (int)$value;
                } else {
                    $types .= 's';
                    $values[] = (string)$value;
                }
            }
        }

        if (empty($fields)) {
            return false; // No valid fields to update
        }

        $fieldsQuery = implode(', ', $fields);
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET {$fieldsQuery} WHERE gambar_id = ?");
        
        if (!$stmt) {
            return false; // Error preparing statement
        }

        $values[] = $id; // Add ID to the end of values
        $types .= 'i'; // Add type for ID
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function deleteByProdukId($produk_id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE produk_id = ?");
        
        if (!$stmt) {
            return false; // Error preparing statement
        }
        
        $stmt->bind_param("i", $produk_id);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
}
    
?>