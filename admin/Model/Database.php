<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host;
    private $dbname;
    private $user;
    private $pass;

    private function __construct() {
        // Allow overriding via environment variables for flexibility and tests
        $this->host   = getenv('DB_HOST') ?: 'localhost';
        $this->user   = getenv('DB_USER') ?: 'root';
        $this->pass   = getenv('DB_PASS') ?: '';
        // If running in tests (TEST_ENV defined) use test DB name by default
        if (defined('TEST_ENV') && TEST_ENV === true) {
            $this->dbname = getenv('DB_NAME') ?: 'plastik_test';
        } else {
            $this->dbname = getenv('DB_NAME') ?: 'plastik';
        }

        $this->conn = @new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->conn->connect_error) {
            error_log("Database connection failed ({$this->host}/{$this->dbname}): " . $this->conn->connect_error);
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
