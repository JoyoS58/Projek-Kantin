<?php
class Database
{
    private $host = 'localhost'; // Ganti dengan host database Anda
    private $username = 'root'; // Ganti dengan username database Anda
    private $password = ''; // Ganti dengan password database Anda
    private $database = 'kantindb'; // Ganti dengan nama database Anda
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function escapeString($string)
    {
        return $this->conn->real_escape_string($string);
    }

    public function executeQuery($query)
    {
        return $this->conn->query($query);
    }
}
?>