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


```php
<?php
// config/database.php
class Database {
    private $host = '160.19.166.42';
    private $db_name = '2C_klp6';
    private $username = '2C_klp6';
    private $password = 'U_23Xd1hz299OPMj';
    private $conn;
```
config/database.php digunakan untuk mengatur koneksi ke database MySQL menggunakan PHP Data Objects (PDO). File ini mengelola konfigurasi host, nama database, username, dan password untuk menghubungkan ke database.

Jalankan MySQL di host 160.19.166.42 dengan database 2C_klp6 yang sudah disiapkan.
Ubah nilai dari properti yang sudah disiapkan:

host: Alamat host server database (160.19.166.42).
db_name: Nama database yang akan digunakan (2C_klp6).
username: Username untuk mengakses database (2C_klp6).
password: Password untuk username tersebut (U_23Xd1hz299OPMj)
```php
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }

   
}

```
Gunakan metode connect() untuk mendapatkan objek koneksi database.

### Model Kursus
File `app/models/Kursus.php` adalah bagian dari aplikasi yang menangani operasi CRUD (Create, Read, Update, Delete) pada tabel `tbl_kursus` di database. File ini menggunakan PDO untuk berinteraksi dengan database.
```php
<?php
// app/models/User.php
require_once '../config/database.php';

class kursus {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }
```

## Method
1. **getAlltbl_kursus**
   ```php
   public function getAlltbl_kursus() {
        $query = $this->db->query("SELECT id_kursus,id_user, id_materi, judul_kursus, instruktur, deskripsi, durasi FROM tbl_kursus");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
   ```
   Mendapatkan semua data kursus dari tabel `tbl_kursus`.
   
3. **find($id)**  
   Mencari kursus berdasarkan `id_kursus`.

4. **add($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi)**  
   Menambahkan kursus baru ke tabel `tbl_kursus`.

5. **update($id_kursus, $data)**  
   Memperbarui data kursus berdasarkan `id_kursus`.

6. **delete($id_kursus)**  
   Menghapus kursus dari tabel `tbl_kursus` berdasarkan `id_kursus`.

## Contoh Penggunaan
### Inisialisasi Model
```php
require_once 'app/models/User.php';

$kursus = new kursus();
```
UserController
UserController adalah sebuah controller dalam aplikasi PHP MVC sederhana yang bertanggung jawab untuk mengelola operasi CRUD (Create, Read, Update, Delete) pada data pengguna. Controller ini menghubungkan model User dengan view terkait untuk memproses dan menampilkan data. 

Terdapat beberapa metode yang digunakan, yaitu :
Index: Menampilkan daftar semua pengguna.
Create: Menampilkan form untuk menambahkan pengguna baru.
Store: Menyimpan data pengguna baru ke dalam database.
Edit: Menampilkan form untuk mengedit data pengguna.
Update: Memperbarui data pengguna yang ada.
Delete: Menghapus data pengguna dari database.

1. Menampilkan Daftar Pengguna
Metode index() digunakan untuk mendapatkan semua data pengguna dari model User dan menampilkannya di view index.php.
```php
public function index() {
    $user = $this->UserModel->getAlltbl_user();
    require_once '../app/views/user/index.php';
}
```
2. Menambahkan Pengguna Baru
Menampilkan Form
Metode create() digunakan untuk menampilkan form penambahan pengguna baru.
```php
public function create() {
    require_once '../app/views/user/create.php';
}
```
Menyimpan Data
Metode store() digunakan untuk memproses data dari form dan menyimpannya ke database.
```php
public function store() {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $peran = $_POST['peran'];
    $this->UserModel->add($nama, $email, $password, $peran);
    header('Location: /user/index');
}
```
3. Mengedit Pengguna
Menampilkan Form Edit
Metode edit() digunakan untuk menampilkan form edit dengan data pengguna yang akan diubah.

php
```php
public function edit($id_user) {
    $user = $this->UserModel->find($id_user);
    require_once '../app/views/user/edit.php';
}
```
Memperbarui Data
Metode update() digunakan untuk memperbarui data pengguna berdasarkan ID.
```php
public function update($id_user, $data) {
    $updated = $this->UserModel->update($id_user, $data);
    if ($updated) {
        header("Location: /user/index");
    } else {
        echo "Failed to update user.";
    }
}
```
4. Menghapus Pengguna
Metode delete() digunakan untuk menghapus data pengguna berdasarkan ID.
```php
public function delete($id_user) {
    $deleted = $this->UserModel->delete($id_user);
    if ($deleted) {
        header("Location: /user/index");
    } else {
        echo "Failed to delete user.";
    }
}
```
#UserController
```php
<?php
// app/controllers/UserController.php
require_once '../app/models/User.php';

class UserController {
    private $UserModel;

    public function __construct() {
        $this->UserModel = new User();
    }

    public function index() {
        $user = $this->UserModel->getAlltbl_user();
        require_once '../app/views/user/index.php';

    }

    public function create() {
        require_once '../app/views/user/create.php';
    }

    public function store() {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $peran = $_POST['peran'];
        $this->UserModel->add( $nama, $email, $password, $peran);
        header('Location: /user/index');
    }
    // Show the edit form with the user data
    public function edit($id_user) {
        $user = $this->UserModel->find($id_user); // Assume find() gets user by ID
        require_once __DIR__ . '/../views/user/edit.php';
    }

    // Process the update request
    public function update($id_user, $data) {
        $updated = $this->UserModel->update($id_user, $data);
        if ($updated) {
            header("Location: /user/index"); // Redirect to user list
        } else {
            echo "Failed to update user.";
        }
    }

    // Process delete request
    public function delete($id_user) {
        $deleted = $this->UserModel->delete($id_user);
        if ($deleted) {
            header("Location: /user/index"); // Redirect to user list
        } else {
            echo "Failed to delete user.";
        }
    }
}

```
Terdapat metode yang dapat digunakan dalam userController, yaitu:

Melihat Daftar Pengguna:

Endpoint: /user/index

Mengambil data semua pengguna dari model User dan menampilkannya di view.

Menambah Pengguna Baru:

Endpoint: /user/create (form untuk menambahkan pengguna baru).

Endpoint: /user/store (proses penyimpanan data pengguna baru).

Data yang diperlukan: nama, email, password, peran.

Mengedit Pengguna:

Endpoint: /user/edit/{id_user} (form untuk mengedit pengguna).

Endpoint: /user/update (proses update data pengguna).

Data yang diperlukan: nama, email, password, peran.

Menghapus Pengguna:

Endpoint: /user/delete/{id_user}.

Menghapus data pengguna berdasarkan id_user.

Penjelasan Fungsi dalam UserController

index(): Menampilkan semua data pengguna ke view user/index.php.

create(): Menampilkan form pembuatan pengguna baru.

store(): Memproses data dari form pembuatan pengguna baru dan menyimpannya ke database.

edit($id_user): Menampilkan form edit untuk pengguna tertentu berdasarkan id_user.

update($id_user, $data): Memperbarui data pengguna tertentu di database.

delete($id_user): Menghapus data pengguna tertentu dari database.

Cara Menggunakan

Clone repository ini ke direktori server lokal Anda.

Pastikan konfigurasi database sudah benar pada file User.php (model).

Akses endpoint seperti /user/index, /user/create, atau /user/edit/{id} melalui browser atau alat pengujian API seperti Postman.

#Create.php
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
<<<<<<< HEAD
        <h2 class="text-center text-primary mb-4">Tambah Pengguna Baru</h2>
        <form action="/user/store" method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <textarea name="email" id="email" class="form-control" rows="4" placeholder="Masukkan email" required></textarea>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <div class="mb-3">
                <label for="peran" class="form-label">Peran:</label>
                <input type="text" name="peran" id="peran" class="form-control" placeholder="Masukkan peran" required>
```


Halaman ini memungkinkan pengguna untuk menambahkan data pengguna baru ke dalam sistem. Formulir yang disediakan memiliki beberapa bidang input yang wajib diisi untuk memastikan data pengguna tercatat dengan lengkap dan akurat.

## Struktur Formulir

Formulir terdiri dari beberapa bagian:

1. **Nama**
   - Label: `Nama:`
   - Input: `input` dengan tipe `text`
   - Deskripsi: Untuk memasukkan nama lengkap pengguna.
   - Placeholder: `Masukkan nama`
   - Validasi: Wajib diisi (`required`).

2. **Email**
   - Label: `Email:`
   - Input: `textarea`
   - Deskripsi: Untuk memasukkan alamat email pengguna.
   - Placeholder: `Masukkan email`
   - Validasi: Wajib diisi (`required`).

3. **Password**
   - Label: `Password:`
   - Input: `input` dengan tipe `text`
   - Deskripsi: Untuk memasukkan kata sandi pengguna.
   - Placeholder: `Masukkan password`
   - Validasi: Wajib diisi (`required`).

4. **Peran**
   - Label: `Peran:`
   - Input: `input` dengan tipe `text`
   - Deskripsi: Untuk memasukkan peran atau jabatan pengguna dalam sistem.
   - Placeholder: `Masukkan peran`
   - Validasi: Wajib diisi (`required`).


     #Edit.php
     ```php
 <h2 class="text-center text-primary mb-4">Edit User</h2>
        <form action="/user/update/<?php echo $user['id_user']; ?>" method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $user['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin diubah):</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="peran" class="form-label">Peran:</label>
                <select name="peran" id="peran" class="form-select" required>
                    <option value="instruktur" <?php echo $user['peran'] == 'instruktur' ? 'selected' : ''; ?>>Instruktur</option>
                    <option value="peserta" <?php echo $user['peran'] == 'peserta' ? 'selected' : ''; ?>>Peserta</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/user/index" class="btn btn-secondary">Back to List</a>
     ```
     Halaman ini memungkinkan pengguna untuk mengedit informasi pengguna yang sudah ada di dalam sistem. Formulir ini memuat data yang ada sebelumnya, sehingga pengguna hanya perlu memperbarui data yang diperlukan.

## Struktur Formulir

Formulir terdiri dari beberapa bagian:

1. **Nama**
   - Label: `Nama:`
   - Input: `input` dengan tipe `text`
   - Deskripsi: Untuk memperbarui nama pengguna.
   - Value: Diisi dengan nilai awal `<?php echo $user['nama']; ?>`.
   - Validasi: Wajib diisi (`required`).

2. **Email**
   - Label: `Email:`
   - Input: `input` dengan tipe `email`
   - Deskripsi: Untuk memperbarui alamat email pengguna.
   - Value: Diisi dengan nilai awal `<?php echo $user['email']; ?>`.
   - Validasi: Wajib diisi (`required`).

3. **Password**
   - Label: `Password:`
   - Input: `input` dengan tipe `password`
   - Deskripsi: Untuk memperbarui kata sandi pengguna.
   - Catatan: Jika dikosongkan, kata sandi tidak akan diperbarui.

4. **Peran**
   - Label: `Peran:`
   - Input: `select` dengan opsi berikut:
     - `Instruktur`
     - `Peserta`
   - Deskripsi: Untuk memilih peran pengguna.
   - Value: Opsi yang sesuai dengan peran saat ini akan dipilih menggunakan PHP `selected`.
   - Validasi: Wajib diisi (`required`).

## Implementasi Teknologi

- **HTML5** digunakan untuk membuat struktur halaman dan formulir.
- **PHP** digunakan untuk memuat data awal pengguna dan memproses formulir.
- **CSS Bootstrap** (versi 5.3.0) digunakan untuk mempercantik tampilan dan memberikan responsivitas.

## Aksi Formulir

- **Metode Pengiriman**: POST
- **Aksi**: `/user/update/<?php echo $user['id_user']; ?>`
- Deskripsi: Data yang diperbarui dari formulir ini akan dikirim ke rute `/user/update/{id_user}` menggunakan metode `POST` untuk disimpan ke database.

## Navigasi Tambahan

- Tombol `Update`: Untuk mengirim data yang telah diperbarui.
- Tombol `Back to List`: Untuk kembali ke halaman daftar pengguna tanpa melakukan perubahan.

  #index.php
```php
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
    <a href="/user/create" class="btn btn-primary mb-3">Tambah Pengguna Baru</a>
    <table class="table table-bordered table-hover" style="border: 2px solid rgb(80, 156, 238);">
        <thead style="background-color:rgb(80, 156, 238); color: white;">
            <tr>
                <th>No</th>    
                <th>Nama</th>
                <th>Email</th>
                <th>Password</th>
                <th>Peran</th>
                <th>Aksi</th>
                
            </tr>
        </thead>
<<<<<<< HEAD
    <tbody>
        <?php 
        $no = 1; 
        foreach ($user as $user): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($user['nama']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['password']) ?></td>
            <td><?= htmlspecialchars($user['peran']) ?></td>
            <td>
                <a href="/user/edit/<?php echo $user['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/user/delete/<?php echo $user['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```


Metode yang terdapat pada file index.php ini antara lain yaitu :
Tambah Pengguna Baru: Menambahkan pengguna baru ke dalam sistem.
Lihat Daftar Pengguna: Menampilkan daftar pengguna yang terdaftar beserta informasi seperti nama, email, password, dan peran.
Edit Pengguna: Memungkinkan administrator untuk mengubah informasi pengguna.
Hapus Pengguna: Menghapus pengguna dari sistem dengan konfirmasi sebelum tindakan diambil.
Struktur Tabel
Tabel yang ditampilkan memiliki kolom sebagai berikut:

No: Nomor urut pengguna.
Nama: Nama pengguna.
Email: Alamat email pengguna.
Password: Password pengguna.
Peran: Peran pengguna (misalnya, Admin, User).
Aksi: Tombol untuk mengedit atau menghapus pengguna.



#Create.php
```php
<!-- app/views/user/create.php -->
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
        <h2 class="text-center text-primary mb-4">Tambah Kursus Baru</h2>
        <form action="/kursus/store" method="POST" class="bg-white p-4 rounded shadow">
           
            <div class="mb-3">
                <label for="id_user" class="form-label">ID User:</label>
                <select name="id_user" id="id_user" class="form-control" required>
                    <option value="">Pilih User</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id_user']; ?>" data-user="<?php echo $user['nama']; ?>">
                            <?php echo htmlspecialchars($user['nama']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_materi" class="form-label">ID Materi:</label>
                <select name="id_materi" id="id_materi" class="form-control" required>
                    <option value="">ID Materi</option>
                    <?php foreach ($materi as $materi): ?>
                        <option value="<?php echo $materi['id_materi']; ?>" data-materi="<?php echo $materi['kursus_terkait']; ?>">
                            <?php echo htmlspecialchars($materi['kursus_terkait']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3" style="display: none;">
                <label for="judul_kursus" class="form-label">Judul Kursus :</label>
                <input type="text" name="judul_kursus" id="judul_kursus" class="form-control" placeholder="Masukkan Judul Instruksi" readonly>
               
            </div>
            <div class="mb-3" style="display: none;">
                <label for="instruktur" class="form-label">Instruktur:</label>
                <input type="text" name="instruktur" id="instruktur" class="form-control" placeholder="Masukkan nama instruksi" readonly>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Masukkan Deskripsi Kursus" required></textarea>
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi:</label>
                <input type="text" name="durasi" id="durasi" class="form-control" placeholder="Masukkan Durasi" required>
                
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('id_user').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaUser = selectedOption.getAttribute('data-user');

            document.getElementById('instruktur').value = namaUser || '';
 
        });
    </script>

<script>
        document.getElementById('id_materi').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaMateri = selectedOption.getAttribute('data-materi');

            document.getElementById('judul_kursus').value = namaMateri || '';
        });
    </script>
</body>
</html>
```
Metode yang digunakan pada file create.php ini diantaranya sebagai berikut
Dropdown Dinamis:
Dropdown ID User mengisi otomatis kolom Instruktur berdasarkan pilihan user.
Dropdown ID Materi mengisi otomatis kolom Judul Kursus berdasarkan pilihan materi.
Form Responsif:
Didukung oleh Bootstrap 5, memastikan form terlihat baik di berbagai ukuran layar.
Validasi:
Atribut required digunakan pada input form untuk memastikan data yang wajib diisi tidak kosong.
Keamanan:
Data yang ditampilkan melalui PHP menggunakan htmlspecialchars() untuk menghindari serangan XSS.
Struktur Input Form
ID User:
Dropdown untuk memilih user.
Kolom Instruktur otomatis diisi dengan nama user yang dipilih.
ID Materi:
Dropdown untuk memilih materi.
Kolom Judul Kursus otomatis diisi dengan nama kursus terkait.
Deskripsi:
Input teks area untuk memasukkan deskripsi kursus.
Durasi:
Input teks untuk memasukkan durasi kursus.
Tombol Simpan:
Mengirimkan data ke URL /kursus/store melalui metode POST.
Dependensi
Bootstrap 5:
CSS dan JS untuk tampilan dan interaktivitas modern.
CDN digunakan untuk memuat file Bootstrap:
Bootstrap CSS
Bootstrap JS
Cara Kerja JavaScript
Dropdown ID User:
Event listener mendeteksi perubahan pada dropdown.
Atribut data-user dari opsi yang dipilih digunakan untuk mengisi kolom Instruktur secara otomatis.
Dropdown ID Materi:
Event listener mendeteksi perubahan pada dropdown.
Atribut data-materi dari opsi yang dipilih digunakan untuk mengisi kolom Judul Kursus secara otomatis.
