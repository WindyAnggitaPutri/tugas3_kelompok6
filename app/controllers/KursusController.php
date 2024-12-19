<?php
// app/controllers/UserController.php
require_once '../app/models/Kursus.php';

class KursusController {
    private $kursusModel;

    public function __construct() {
        $this->kursusModel = new Kursus();
    }

    public function home(){
        require_once '../app/views/kursus/index.php';
    }

    public function index(){
        require_once '../app/views/kursus/index.php';
    }

    public function simpan(){
        $kursus = $this->kursusModel->getAlltbl_kursus();

        require_once '../app/views/kursus/index.php';
    }
    
    public function halaman_kursus() {
        $kursuss = $this->kursusModel->getAlltbl_kursus();
        require_once '../app/views/kursus/halaman_kursus.php';

    }

    public function create() {
        $users = $this->kursusModel->getAllUser();
        $materi = $this->kursusModel->getAllMateri();
        $kursus = $this->kursusModel->getAlltbl_kursus();
        require_once '../app/views/kursus/create.php';

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
        header('Location: /kursus/halaman_kursus');
    }
    // Show the edit form with the user data
    public function edit($id_kursus) {
        $kursus = $this->kursusModel->find($id_kursus); // mencari berdasarkan idnya
        $users = $this->kursusModel->getAllUser();
        $materis = $this->kursusModel->getAllMateri();
       
        // $id_kursus = $kursus['id_kursus'];
        require_once __DIR__ . '/../views/kursus/edit.php';
    }

    // Process the update request
    public function update($id_kursus, $data) {
        $updated = $this->kursusModel->update($id_kursus, $data);
        if ($updated) {
            header("Location: /kursus/halaman_kursus"); // Redirect to user list
        } else {
            echo "Failed to update kursus.";
        }
    }

    // Process delete request
    public function delete($id_kursus) {
        $deleted = $this->kursusModel->delete($id_kursus);
        if ($deleted) {
            header("Location: /kursus/halaman_kursus"); // Redirect to user list
        } else {
            echo "Failed to delete kursus.";
        }
    }
}
