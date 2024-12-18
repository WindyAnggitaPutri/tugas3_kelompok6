<?php
// app/models/User.php
require_once '../config/database.php';

class Materi {
    private $db;
    // mengkoneksikan database dalam file database.php
    public function __construct() {
        $this->db = (new Database())->connect();
    }
    // fect assoc untuk mengembalikan hasil dalam bentuk array asosiatif. data disusun dalam array asosiatif
    // dengan nama kolom sebagai kunci
    public function getAllMateri() {
        $query = $this->db->query("SELECT * FROM tbl_materi");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    //mengambil data dari table databse dengan menggunakan id_materi
    public function find($id_materi) {
        $query = $this->db->prepare("SELECT * FROM tbl_materi WHERE id_materi = :id_materi");
        $query->bindParam(':id_materi', $id_materi, PDO::PARAM_INT); //mengikat parameter
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // metod untuk menambahkan data pada table
    public function add($id_materi, $judul_materi, $konten, $kursus_terkait) {
        $query = $this->db->prepare("INSERT INTO tbl_materi (id_materi, judul_materi, konten, kursus_terkait) VALUES (:id_materi, :judul_materi, :konten, :kursus_terkait)");
        $query->bindParam(':id_materi', $id_materi);
        $query->bindParam(':judul_materi', $judul_materi);
        $query->bindParam(':konten', $konten);
        $query->bindParam(':kursus_terkait', $kursus_terkait);
        return $query->execute();
    }

    // mengedit data dengan menggunakan id table
    public function update( $id_materi, $data) {
        $query = "UPDATE tbl_materi SET judul_materi = :judul_materi, konten = :konten, kursus_terkait= :kursus_terkait WHERE id_materi = :id_materi";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':judul_materi', $data['judul_materi']);
        $stmt->bindParam(':konten', $data['konten']);
        $stmt->bindParam(':kursus_terkait', $data['kursus_terkait']);
        $stmt->bindParam(':id_materi', $id_materi);
        return $stmt->execute();
    }

    // menghapus data dengan menggunakan id table
    public function delete($id_materi) {
        $query = "DELETE FROM tbl_materi WHERE id_materi = :id_materi";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_materi', $id_materi);
        return $stmt->execute();
    }
}
