<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $dbname = 'plastik';
    private $user = 'root';
    private $pass = '';

    private function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->conn->connect_error) {
            error_log("Database connection failed: " . $this->conn->connect_error);
            die("System temporarily unavailable. Please try again later.");
        }

        $this->conn->set_charset('utf8mb4');
    }

        public static function getInstance() {
        if (!self::$instance) self::$instance = new Database();
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
