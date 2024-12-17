<?php
// app/models/User.php
require_once '../config/database.php';

class kursus {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAlltbl_kursus() {
        $query = $this->db->query("SELECT id_kursus,id_user, id_materi, judul_kursus, instruktur, deskripsi, durasi FROM tbl_kursus");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM tbl_kursus WHERE id_kursus = :id_kursus");
        $query->bindParam(':id_kursus', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function add($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi) {
        $query = $this->db->prepare("INSERT INTO tbl_kursus (id_kursus, id_user, id_materi, judul_kursus, instruktur, deskripsi, durasi) VALUES (:id_kursus ,:id_user, :id_materi, :judul_kursus, :instruktur, :deskripsi, :durasi)");
        $query->bindParam(':id_kursus', $id_kursus);
        $query->bindParam(':id_user', $id_user);
        $query->bindParam(':id_materi', $id_materi);
        $query->bindParam(':judul_kursus', $judul_kursus);
        $query->bindParam(':instruktur', $instruktur);
        $query->bindParam(':deskripsi', $deskripsi);
        $query->bindParam(':durasi', $durasi);
        return $query->execute();
    }

    // Update user data by ID
    public function update($id_kursus, $data) {
        $query = "UPDATE tbl_kursus SET id_kursus = :id_kursus, id_user = :id_user, id_materi = :id_materi, judul_kursus = :judul_kursus, instruktur = :instruktur, deskripsi = :deskripsi, durasi = :durasi WHERE id_kursus = :id_kursus";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_kursus', $id_kursus);
        $stmt->bindParam(':id_user', $data['id_user']);
        $stmt->bindParam(':id_materi', $data['id_materi']);
        $stmt->bindParam(':judul_kursus', $data['judul_kursus']);
        $stmt->bindParam(':instruktur', $data['instruktur']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        $stmt->bindParam(':durasi', $data['durasi']);
        return $stmt->execute();
    }

    // Delete user by ID
    public function delete($id_kursus) {
        $query = "DELETE FROM tbl_kursus WHERE id_kursus = :id_kursus";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_kursus', $id_kursus);
        return $stmt->execute();
    }
}
