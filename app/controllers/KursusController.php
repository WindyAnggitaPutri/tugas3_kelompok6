<?php
// app/controllers/UserController.php
require_once '../app/models/Kursus.php';

class KursusController {
    private $kursusModel;

    public function __construct() {
        $this->kursusModel = new Kursus();
    }

    public function simpan(){
        $kursus = $this->kursusModel->getAlltbl_kursus();

        require_once '../app/views/user/kursus.php';
    }
    
    public function index() {
        $kursus = $this->kursusModel->getAlltbl_kursus();
        require_once '../app/views/user/index.php';

    }

    public function create() {
        $users = $this->kursusModel->getAllUser();
        $materi = $this->kursusModel->getAllMateri();
        $kursus = $this->kursusModel->getAllKursus();
        require_once '../app/views/user/create.php';

    }

//     public function deskripsi(){
// $id_user = $_GET['id_user']; // Atau menggunakan $_POST atau parameter lain
// $deskripsi = isset($kursus['deskripsi']) ? $kursus['deskripsi'] : ''; // Fungsi untuk mengambil deskripsi
// $this->view('user/edit', ['deskripsi' => $deskripsi]); 

//     }

public function deskripsi(){
 // Pastikan di controller
$deskripsi = $this->kursusModel->getdeskripsiById($deskripsi); // Dapatkan data kursus berdasarkan id_kursus
// Kemudian kirim ke view
$this->view('user/edit', $kursus); // Pastikan kursus berisi deskripsi yang benar



}

    


    public function store() {
        $id_kursus = $_POST['id_kursus'];
        $id_user = $_POST['id_user'];
        $id_materi = $_POST['id_materi'];
        $judul_kursus = $_POST['judul_kursus'];
        $instruktur = $_POST['instruktur'];
        $deskripsi = $_POST['deskripsi'];
        $durasi = $_POST['durasi'];
        $this->kursusModel->add($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi);
        header('Location: /user/kursus');
    }
    // Show the edit form with the user data
    public function edit($id_kursus) {
        $kursus = $this->kursusModel->find($id_kursus); 
        $users = $this->kursusModel->getAllUser();
        $materi = $this->kursusModel->getAllMateri();
        $kursus = $this->kursusModel->getAllKursus();
        require_once __DIR__ . '/../views/user/edit.php';
    }

    // Process the update request
    public function update($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi) {
        $updated = $this->kursusModel->update($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi);
        if ($updated) {
            header("Location: /user/kursus"); // Redirect to user list
        } else {
            echo "Failed to update kursus.";
        }
    }

    // $updated = $this->kursusModel->update($id_kursus, $id_user, $id_materi, $judul_materi, $instruktur, $deskripsi, $durasi);

    // Process delete request
    public function delete($id_kursus) {
        $deleted = $this->kursusModel->delete($id_kursus);
        if ($deleted) {
            header("Location: /user/index"); // Redirect to user list
        } else {
            echo "Failed to delete kursus.";
        }
    }
}
