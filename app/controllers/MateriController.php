<?php
// app/controllers/UserController.php
require_once '../app/models/materi.php';

class materiController {
    private $materiModel;

    
    public function __construct() {
        $this->materiModel = new Materi();
    }
    // DITANYAAINNNN!!
    public function halaman_materi() {
        $materis = $this->materiModel->getAllMateri();
        require_once '../app/views/materi/halaman_materi.php';

    }

    public function home(){
        require_once '../app/views/kursus/index.php';
    } 

    public function create() {
        require_once '../app/views/materi/create.php';
    }

    public function index(){
        require_once '../app/views/kursus/index.php';
    }

    public function store() {
        $id_materi = $_POST['id_materi'];
        $judul_materi = $_POST['judul_materi'];
        $konten = $_POST['konten'];
        $kursus_terkait = $_POST['kursus_terkait'];
        $this->materiModel->add($id_materi, $judul_materi, $konten, $kursus_terkait);
        header('Location: /materi/halaman_materi');
    }
    // menampilkan form edit berdasarkan data dengan mengambil id_materi
    public function edit($id_materi) {
        $materi = $this->materiModel->find($id_materi); // mencari berdasarkan idnya
        require_once __DIR__ . '/../views/materi/edit.php';
    }

    // proses menjalankan update 
    public function update($id_materi, $data) {
        $updated = $this->materiModel->update($id_materi, $data);
        if ($updated) {
            header("Location: /materi/halaman_materi"); // Redirect ke index materi untuk menampilkan list
        } else {
            echo "Failed to update materi.";
        }
    }

    // proses mendelete data 
    public function delete($id_materi) {
        $deleted = $this->materiModel->delete($id_materi);
        if ($deleted) {
            header("Location: /materi/halaman_materi"); // redirect ke index untuk menampiilkan list 
        } else {
            echo "Failed to delete user."; //output apabila data tidak berhasil dihapus
        }
    }
}
