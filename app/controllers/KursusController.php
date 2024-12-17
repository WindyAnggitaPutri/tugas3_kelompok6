<?php
// app/controllers/UserController.php
require_once '../app/models/Kursus.php';

class KursusController {
    private $kursusModel;

    public function __construct() {
        $this->kursusModel = new Kursus();
    }

    public function index() {
        $kursus = $this->kursusModel->getAlltbl_kursus();
        require_once '../app/views/user/index.php';

    }

    public function create() {
        require_once '../app/views/user/create.php';
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
        header('Location: /user/index');
    }
    // Show the edit form with the user data
    public function edit($id_kursus) {
        $kursus = $this->kursusModel->find($id_kursus); // Assume find() gets user by ID
        require_once __DIR__ . '/../views/user/edit.php';
    }

    // Process the update request
    public function update($id_kursus, $data) {
        $updated = $this->kursusModel->update($id_kursus, $data);
        if ($updated) {
            header("Location: /user/index"); // Redirect to user list
        } else {
            echo "Failed to update kursus.";
        }
    }

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
