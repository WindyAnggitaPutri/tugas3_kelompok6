<?php
// app/models/User.php
require_once '../config/database.php';

class kursus {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAlltbl_kursus() {
        // $query = $this->db->query("SELECT id_kursus,id_user, id_materi, judul_kursus, instruktur, deskripsi, durasi FROM tbl_kursus");
        $query = $this->db->query("SELECT k.id_kursus, u.id_user, m.id_materi, m.kursus_terkait as judul_kursus, u.nama as instruktur , k.deskripsi, k.durasi
        from tbl_kursus k 
        join tbl_user u on k.id_user = u.id_user 
        join tbl_materi m on k.id_materi = m.id_materi
        where  u.peran = 'instruktur'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUser(){
        $query = $this->db->query("SELECT * FROM tbl_user where peran = 'instruktur'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMateri(){
        $query = $this->db->query("SELECT * FROM tbl_materi");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllKursus(){
        $query = $this->db->query("SELECT * FROM tbl_kursus");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getInstruktor(){
    //     $query = $this->db->prepare("SELECT nama,id_user from tbl_user where peran = 'instruktur'");
    //     return $query->fetchAll(PDO::FETCH_ASSOC);
    // }


    // public function getAlltbl_materi(){
    //     $query = $this->db->query("SELECT u.id_user, u.nama, m.id_materi, m.kursus_terkait, k.id_kursus, k.judul_kursus, k.instruktur, k.deskripsi, k.durasi 
    //     FROM tbl_materi m JOIN tbl_kursus k JOIN tbl_user u
    //     ON k.id_user= u.id_user and k.id_materi = m.id_materi")
    //     return $query->fetchAll(PDO::FETCH_ASSOC);
    // }

  


    public function find($id_kursus) {
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
    public function update($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi) {
        $query = "UPDATE tbl_kursus SET id_kursus = :id_kursus, id_user = :id_user, id_materi = :id_materi, judul_kursus = :judul_kursus, instruktur = :instruktur, deskripsi = :deskripsi, durasi = :durasi WHERE id_kursus = :id_kursus";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id_kursus', $id_kursus);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_materi', $materi);
        $stmt->bindParam(':judul_kursus', $judul_kursus);
        $stmt->bindParam(':instruktur', $instruktur);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':durasi', $durasi);
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
