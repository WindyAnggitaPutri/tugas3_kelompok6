<?php
// app/models/User.php
require_once '../config/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAlltbl_user() {
        $query = $this->db->query("SELECT * FROM tbl_user");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id_user) {
        $query = $this->db->prepare("SELECT * FROM tbl_user WHERE id_user = :id_user");
        $query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function add($nama, $email, $password, $peran) {

        $query = $this->db->prepare("INSERT INTO tbl_user (nama, email, password, peran) VALUES (:nama, :email, :password, :peran)");
        $query->bindParam(':nama', $nama);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);
        $query->bindParam(':peran', $peran);
        return $query->execute();
    }

    public function update($id_user, $data) {
        $query = "UPDATE tbl_user SET nama = :nama, email = :email, password = :password, peran = :peran WHERE id_user = :id_user";
        $stmt = $this->db->prepare($query);

        $nama = $data['nama'];
        $email = $data['email'];
        $password = $data['password'];
        $peran = $data['peran'];

        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':peran', $peran);

        return $stmt->execute();
    }

    public function delete($id_user) {
        $query = "DELETE FROM tbl_user WHERE id_user = :id_user";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        return $stmt->execute();
    }
}
