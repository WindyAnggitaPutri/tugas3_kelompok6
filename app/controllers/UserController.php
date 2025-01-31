<?php
// app/controllers/UserController.php
require_once '../app/models/User.php';

class UserController {
    private $UserModel;

    public function __construct() {
        $this->UserModel = new User();
    }

    public function halaman_user() {
        $user = $this->UserModel->getAlltbl_user();
        require_once '../app/views/user/halaman_user.php';
    }

    public function home(){
        require_once '../app/views/kursus/index.php';
    }

    public function create() {
        require_once '../app/views/user/create.php';
    }

    public function index(){
        require_once '../app/views/kursus/index.php';
    }

    public function store() {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $peran = $_POST['peran'];
        $this->UserModel->add( $nama, $email, $password, $peran);
        header('Location: /user/halaman_user');
    }
    // Show the edit form with the user data
    public function edit($id_user) {
        $user = $this->UserModel->find($id_user); // Assume find() gets user by ID
        $id_user = $user['id_user'];
        require_once __DIR__ . '/../views/user/edit.php';
    }

    // Process the update request
    public function update($id_user, $data) {
        $updated = $this->UserModel->update($id_user, $data);
        if ($updated) {
            header("Location: /user/halaman_user"); // Redirect to user list
        } else {
            echo "Failed to update user.";
        }
    }

    // Process delete request
    public function delete($id_user) {
        $deleted = $this->UserModel->delete($id_user);
        if ($deleted) {
            header("Location: /user/halaman_user"); // Redirect to user list
        } else {
            echo "Failed to delete user.";
        }
    }
}
