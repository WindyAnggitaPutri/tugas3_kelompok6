# Praktikum Pemgrograman Web 2 - Politeknik Negeri Cilacap

## Informasi Umum
Proyek ini merupakan tugas dalam mata kuliah Praktikum Pemrograman Web 2 sesuai dengan studi kasus yang diberikan oleh Pengampu yaitu Sistem Manajemen Kelas Online

## Deskripsi Proyek
Proyek ini melibatkan implementasi operasi CRUD (Create, Read, Update, Delete) untuk pengelolaan data, termasuk koneksi ke database menggunakan PDO dan pengelolaan data pada database 2C_klp6..

## Tujuan
Tujuan dari praktikum ini adalah untuk memberikan pemahaman yang lebih baik tentang arsitektur MVC dalam pengembangan aplikasi web dan untuk meningkatkan kemampuan mahasiswa dalam menerapkan konsep OOP serta melakukan operasi CRUD (Create, Read, Update, Delete) pada data.

## Tech Stack
- **Bahasa Pemrograman:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Version Control:** Git (GitLab)
- **Web Server:** Apache (dengan .htaccess untuk pengaturan URL)

## Struktur Proyek
```plaintext
mvc-sample/
├── app/
│   ├── controllers/
│   │   └── UserController.php         # Controller untuk mengelola logika pengguna
│   ├── models/
│   │   └── User.php                   # Model untuk mengelola data pengguna
│   └── views/
│       └── user/
│           ├── index.php              # View untuk menampilkan daftar dan manajemen pengguna
│           ├── edit.php               # Edit untuk menampilkan halaman edit pengguna            
│           └── create.php             # View untuk menampilkan form pembuatan pengguna baru
├── config/
│   └── database.php                   # Konfigurasi database
├── public/
│   ├── .htaccess                      # Pengaturan URL rewrite
│   └── index.php                      # Entry point aplikasi
├── .htaccess                          # Pengaturan URL rewrite
└── routes.php                         # Mendefinisikan rute untuk aplikasi
```

## Cara Menjalankan Proyek
1. **Clone Repository:**
   ```bash
   git clone https://gitlab.com/praktisi-mengajar/politeknik-negeri-cilacap/pemrograman-web/mvc-sample.git
   cd mvc-sample
   ```
2. **Jika menggunakan virtual host pada apache xampp:**
   Untuk menjalankan proyek ini pada Apache XAMPP, Anda perlu membuat virtual host:

   - Edit File Konfigurasi Apache: Buka file httpd-vhosts.conf di lokasi berikut:
        ```php 
        C:\xampp\apache\conf\extra\httpd-vhosts.conf 
        ```
   - Tambahkan Konfigurasi Virtual Host: Tambahkan konfigurasi berikut di bagian bawah file:
        ```php 
        <VirtualHost *:80>
            DocumentRoot "C:/xampp/htdocs/mvc-sample/public"
            ServerName mvc-sample.local
            <Directory "C:/xampp/htdocs/mvc-sample/public">
                AllowOverride All
                Require all granted
            </Directory>
        </VirtualHost>
        ```
    - Edit File Hosts: Tambahkan entri baru pada file hosts di sistem windows :
        ```plaintext
        C:\Windows\System32\drivers\etc\hosts
        ```

    - Tambahkan baris berikut di bagian bawah:
        ```php 
        127.0.0.1 mvc-sample.local
        ```

    - Restart Apache: Setelah konfigurasi selesai, restart Apache melalui XAMPP Control Panel.

    - Akses Proyek: Buka browser dan akses aplikasi di http://mvc-sample.local.

3. **Jika menggunakan perintah php -S localhost:8080:**
    Saat menjalankan aplikasi PHP dengan perintah ```php -S localhost:8080```
    server built-in PHP hanya memahami struktur dasar dan tidak mendukung pengaturan URL rewriting seperti pada file ```.htaccess``` di Apache. Oleh karena itu, aplikasi tidak dapat menangani rute dinamis dengan benar dan akan menampilkan ```"Not Found"``` saat mengakses URL selain ```index.php``` langsung.

    Langkah yang harus diikuti:
    - Navigasi ke direktori ```mvc-sample``` dan jalankan server dari dalam folder ```public```, agar ```index.php``` langsung menjadi entry point untuk aplikasi:
        ```php
        cd mvc-sample/public
        php -S localhost:8080
        ```
    - Akses Proyek: Buka browser dan akses aplikasi di ```localhost:8080```.

## Kontribusi
Jika ingin berkontribusi pada proyek ini, silakan buat branch baru dan kirim pull request.

## Lisensi
Proyek ini dilisensikan under MIT License.

* create.php
  
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi Baru</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h2 class="text-center text-primary mb-4">Tambah Materi Baru</h2>
        <form action="/materi/store" method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="judul_materi" class="form-label">Judul Materi:</label>
                <input type="text" name="judul_materi" id="judul_materi" class="form-control" placeholder="Masukkan judul materi" required>
            </div>
            <div class="mb-3">
                <label for="konten" class="form-label">Konten:</label>
                <textarea name="konten" id="konten" class="form-control" rows="4" placeholder="Masukkan konten materi" required></textarea>
            </div>
            <div class="mb-3">
                <label for="kursus_terkait" class="form-label">Kursus Terkait:</label>
                <input type="text" name="kursus_terkait" id="kursus_terkait" class="form-control" placeholder="Masukkan kursus terkait" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
"create/materi.php" digunakan sebagai form input menambahkan data materi baru, menggunakan bootstrap untuk desain form ubtuk tampilan yang responsif.
tombol simpan mengirimkan data ke endpoint /materi/store dengan metode store

* edit.php

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h2 class="text-center text-primary mb-4">Edit Materi</h2>
        <form action="/materi/update/<?php echo $materi['id_materi']; ?>" method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="judul_materi" class="form-label">Judul Materi:</label>
                <input type="text" name="judul_materi" id="judul_materi" class="form-control" value="<?php echo $materi['judul_materi']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="konten" class="form-label">Konten:</label>
                <textarea name="konten" id="konten" class="form-control" rows="4" required><?php echo $materi['konten']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="kursus_terkait" class="form-label">Kursus Terkait:</label>
                <input type="text" name="kursus_terkait" id="kursus_terkait" class="form-control" value="<?php echo $materi['kursus_terkait']; ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/materi/index" class="btn btn-secondary">Back to List</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
"edit.php" digunakan sebagai formulir untuk mengedit data materi yang sudah ada. data yang ditampilkan diambil dari database berdasarkan ID materi.
tombol update mengirimkan perubahan data ke endpoint /materi/update/(id_materi) dengan metode POST.

* index.php

```php
<!-- app/views/user/index.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Materi</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menambahkan beberapa kustomisasi jika diperlukan */
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4" style="color:rgb(80, 156, 238);">Daftar Materi</h2>
    <a href="/materi/create" class="btn btn-primary mb-3">Tambah Materi Baru</a>
    <table class="table table-bordered table-hover" style="border: 2px solid rgb(80, 156, 238);">
        <thead style="background-color:rgb(80, 156, 238); color: white;">
            <tr>
                <th>ID Materi</th>
                <th>Judul Materi</th>
                <th>Konten</th>
                <th>Kursus Terkait</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materis as $materi): ?>
                <tr>
                    <td><?= htmlspecialchars($materi['id_materi']) ?></td>
                    <td><?= htmlspecialchars($materi['judul_materi']) ?></td>
                    <td><?= htmlspecialchars($materi['konten']) ?></td>
                    <td><?= htmlspecialchars($materi['kursus_terkait']) ?></td>
                    <td>
                        <a href="/materi/edit/<?= $materi['id_materi']; ?>" class="btn btn-warning btn-sm">Edit</a> |
                        <a href="/materi/delete/<?= $materi['id_materi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
```
"app/views/materi/index.php" untuk menampilkan daaftar semua materi yang ada di database dalam bentuk table yang responsif.
menggunakan table dinamis yang menampilkan ID materi, Judul Materi, Konten, Kursus Terkait dan aksi hapus dan edit. tombol edit mengarahkann ke halaman edit untuk memperbarui data, dan tombol hapus untuk menghapus data materi dari database.

foreach ($materis as $materi) looping dta yang diambi dari database untuk ditampikan dalam bentuk table.

```php
<?php
// app/models/User.php
require_once '../config/database.php';

class Materi {
    private $db;
    // mengkoneksikan database dalam file database.php
    public function __construct() {
        $this->db = (new Database())->connect();
    }
```
require_once untuk mengimpor database.php yang berisi koneksi ke daatabase, berisi kelas database dengan metode connect() untuk membuat koneksi ke database dengan menggunakan PDO.

membuat kelas dengan nama Materi menggunakan properti $db untuk menyimpan objek koneksi ke database
metode __construct() dipanggil secara otomatis ketika objek dari kelas materi dibuat

new Database() membuat objek baru dari kelas Database yang didefinisikan di database.php

```php
public function getAllMateri() {
        $query = $this->db->query("SELECT * FROM tbl_materi");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
```
public function getAllMateri() dapat diakses diluar kelas memiliki fungsi mengambil semua kolom data dari tbl_materi 

fetchAll(PDO::FETCH_ASSOC) digunakan mengambil semua baris dalam bentuk array asosiatiif.

```php
public function find($id_materi) {
        $query = $this->db->prepare("SELECT * FROM tbl_materi WHERE id_materi = :id_materi");
        $query->bindParam(':id_materi', $id_materi, PDO::PARAM_INT); //mengikat parameter
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
```
metode public find menerima parameter $id_materi yang di cari dalam tbl_materi

SQL mengambil semua kolom (*) dari tbl_materi dimana id_materi cocok dengan nilai paarameter :id_materi

bindParam() mengikat nilai ke placeholder :id_materi

execute(), Metode ini menjalankan query SQL yang telah dipersiapkan dengan nilai parameter yang sudah diikat.

```php
public function add($id_materi, $judul_materi, $konten, $kursus_terkait) {
        $query = $this->db->prepare("INSERT INTO tbl_materi (id_materi, judul_materi, konten, kursus_terkait) VALUES (:id_materi, :judul_materi, :konten, :kursus_terkait)");
        $query->bindParam(':id_materi', $id_materi);
        $query->bindParam(':judul_materi', $judul_materi);
        $query->bindParam(':konten', $konten);
        $query->bindParam(':kursus_terkait', $kursus_terkait);
        return $query->execute();
    }
```
metode public add menerima parameter $id_materi, $judul_materi, $konten, $kursus_terkait.

mengambil semua kolom(*) dari tbl_materi 
execute() Menjalankan query SQL yang telah dipersiapkan dengan nilai parameter yang telah diikat.
return, Mengembalikan nilai true jika eksekusi berhasil, atau false jika gagal.

```php
public function update( $id_materi, $data) {
        $query = "UPDATE tbl_materi SET judul_materi = :judul_materi, konten = :konten, kursus_terkait= :kursus_terkait WHERE id_materi = :id_materi";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':judul_materi', $data['judul_materi']);
        $stmt->bindParam(':konten', $data['konten']);
        $stmt->bindParam(':kursus_terkait', $data['kursus_terkait']);
        $stmt->bindParam(':id_materi', $id_materi);
        return $stmt->execute();
    }
```
public function update digunakn sebagai metode melakukan operasi pembaharuan pada database.Fungsi ini menerima ID dari record yang akan diperbarui ($id_materi) dan array data baru ($data) yang berisi nilai-nilai yang akan diupdate pada kolom judul_materi, konten, dan kursus_terkait. Fungsi ini menyiapkan dan menjalankan query SQL, memperbarui record di mana id_materi sesuai dengan ID yang diberikan.

bindParam() digunakan untuk mengikat nilai dari array $data dan $id_materi ke placeholder pada query.

```php
   public function delete($id_materi) {
        $query = "DELETE FROM tbl_materi WHERE id_materi = :id_materi";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_materi', $id_materi);
        return $stmt->execute();
    }
}
```
public function delete adalah metode yang digunakn untuk menghapus data dari database dengan mengambil id_materi yang akan dihapus.  Fungsi ini menerima ID dari materi yang akan dihapus ($id_materi), menyiapkan dan menjalankan query SQL untuk menghapus record yang memiliki ID tersebut. Jika penghapusan berhasil, fungsi ini mengembalikan true; jika tidak, akan mengembalikan false.

```php
<?php
// app/controllers/UserController.php
require_once '../app/models/materi.php';

class materiController {
    private $materiModel;

    
    public function __construct() {
        $this->materiModel = new Materi();
    }
 
    public function index() {
        $materis = $this->materiModel->getAllMateri();
        require_once '../app/views/materi/index.php';

    }
```
$materiModel Variabel ini adalah objek dari kelas Materi.
__construct(), Konstruktor ini akan dipanggil ketika objek materiController dibuat. Di dalam konstruktor, objek Materi diinisialisasi dan disimpan dalam variabel $materiModel

getAllMateri() Ini adalah metode yang dipanggil dari objek Materi yang menghubungkan ke model Materi untuk mengambil semua data materi dari database.
$materis Variabel yang menyimpan hasil yang dikembalikan dari metode getAllMateri(). Hasil ini kemungkinan berupa daftar materi yang nantinya akan ditampilkan di halaman web.

Metode index() pada controller materiController digunakan untuk mengambil data materi dari model Materi dan menampilkan hasilnya di halaman index.php. Fungsi ini menghubungkan antara model dan tampilan (view), mengambil data dari database dan menampilkannya kepada pengguna.

```php
public function create() {
        require_once '../app/views/materi/create.php';
    }
```
public function create() akan mengarahkan ke halaman create

```php
public function store() {
        $id_materi = $_POST['id_materi'];
        $judul_materi = $_POST['judul_materi'];
        $konten = $_POST['konten'];
        $kursus_terkait = $_POST['kursus_terkait'];
        $this->materiModel->add($id_materi, $judul_materi, $konten, $kursus_terkait);
        header('Location: /materi/index');
    }
```
fungsi public function store digunakan untuk menyimpan data baruu ke dalam database
$_POST['id_materi']: Mengambil nilai ID materi yang dimasukkan oleh pengguna.
$_POST['judul_materi']: Mengambil judul materi.
$_POST['konten']: Mengambil konten materi.
$_POST['kursus_terkait']: Mengambil nama kursus terkait yang berhubungan dengan materi.

$this->materiModel->add(...): Di sini, metode add() dari objek materiModel dipanggil untuk menambahkan data materi baru ke dalam database.

fungsi store akan mengarahkan kembali ke halaman index materi

```php
public function edit($id_materi) {
        $materi = $this->materiModel->find($id_materi); // mencari berdasarkan idnya
        require_once __DIR__ . '/../views/materi/edit.php';
    }
```
public function edit mengambil data denganparameter $id_materi dan menampilkan halaman edit untuk materi yang akan diubah
fungsi find() dipanggil dari objek materiModel. Fungsi ini bertujuan untuk mencari data materi berdasarkan ID ($id_materi).
fungsi edit akan langsung mengarahkan je halaman edit.

```php
// proses menjalankan update 
    public function update($id_materi, $data) {
        $updated = $this->materiModel->update($id_materi, $data);
        if ($updated) {
            header("Location: /materi/index"); // Redirect ke index materi untuk menampilkan list
        } else {
            echo "Failed to update materi.";
        }
    }
```
public function update digunakan untuk memperbarui data materu yag mengarahkan langsung ke halaman lain 
fungsi update() dipanggil dari objek materiModel untuk memperbarui data materi yang sudah ada di database.
Memanggil metode update() pada model materiModel untuk memperbarui data materi di database berdasarkan ID dan data baru, jika pembaruan berhasil akan diarahkan ke halaman index materi untuk melihat daftar materi yang telah diperbarui

```php
public function delete($id_materi) {
        $deleted = $this->materiModel->delete($id_materi);
        if ($deleted) {
            header("Location: /materi/index"); // redirect ke index untuk menampiilkan list 
        } else {
            echo "Failed to delete user."; //output apabila data tidak berhasil dihapus
        }
    }
}
```
public function delete merupakan proses untuk menghapus data dalam database dengan mem,eriksa $id_materi, jika proses berhasil akan mengarhkan ke laman index.
