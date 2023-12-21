<?php
require_once '../../config/koneksi.php';
class users{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function createUser($username,$password,$level){
        $query = "INSERT INTO users (USERNAME,PASSWORD,LEVEL) VALUES ('$username','$password','$level')";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function updateUser($id,$username,$password,$level){
        $query = "UPDATE users SET USERNAME = '$username', PASSWORD = '$password', LEVEL = '$level' WHERE ID_USER = '$id'";
        $result = $this->db->conn->query($query);
        
        return $result;
    }

    public function deleteUser($id){
        $query = "DELETE FROM users WHERE ID_USER = '$id'";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function readUser()
    {
        $query = "SELECT * FROM users";
        $result = $this->db->conn->query($query);

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}