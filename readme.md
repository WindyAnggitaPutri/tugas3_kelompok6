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

# PRAKTIKUM PWEB2
### KursusController
```php
require_once '../app/models/Kursus.php';
```
Berfungsi untuk memuat model kursus, controller iniagar dapat menggunakkan fungsi-fungsi yang ada di dalam model untuk berinteraksi dengan database

```php
class KursusController {
    private $kursusModel;

}
```

Berfungsi untuk membuat class untuk menyimpan model kursus

```php
public function __construct() {
        $this->kursusModel = new Kursus();
    }
```
construct yang berfungsi untuk menginisialisasi model kursus, konstruktor diaktifkan saat controller dibuat agar dapat menggunakan semua metode yang ada

```php
public function home() {
        require_once '../app/views/kursus/index.php';
    }
```
Metode ini dibuat untuk agar dapat kembali ke halaman utama atau index

```php
 public function index() {
        require_once '../app/views/kursus/index.php';
    }
```
Metode ini dibuat untuk memuat tampilan halaman utama

```php
public function simpan() {
        $kursus = $this->kursusModel->getAlltbl_kursus(); 
        require_once '../app/views/kursus/index.php';
    }
```
metode ini dibuat untuk mengambil semua data kursus, memudahkan pengguna untuk melihat semua data yang ada di dalam table kursus

```php
 public function halaman_kursus() {
        $kursuss = $this->kursusModel->getAlltbl_kursus(); 
        require_once '../app/views/kursus/halaman_kursus.php';
    }
```
metod yang dibuat untuk menampilkan halaman yang menampilkan table tabel kursus, memudahkan mengakses lebih mudah

```php
public function create() {
        $users = $this->kursusModel->getAllUser(); // Mengambil semua pengguna
        $materi = $this->kursusModel->getAllMateri(); // Mengambil semua materi
        $kursus = $this->kursusModel->getAlltbl_kursus(); // Mengambil semua kursus
        require_once '../app/views/kursus/create.php';
    }

```

berfunngsi untuk menyediakan semua infomasi yang dibutuhkan pennguna agar dapat mengisi form dengan benar

```php
public function store() {
        // Melakukan pengambilan data
        $id_kursus = $_POST['id_kursus'];
        $id_user = $_POST['id_user'];
        $id_materi = $_POST['id_materi'];
        $judul_kursus = $_POST['judul_kursus'];
        $instruktur = $_POST['instruktur'];
        $deskripsi = $_POST['deskripsi'];
        $durasi = $_POST['durasi'];

        // Menambahkan kursus baru ke dalam database
        $this->kursusModel->add($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi);
        header('Location: /kursus/halaman_kursus'); // Redirect ke halaman kursus
    }
```
Memastikan bahwa data yang dimasukkan oleh pengguna tersimpan dengan baik dan pengguna diarahkan kembali ke halaman daftar kursus untuk melihat hasilnya

```php
public function edit($id_kursus) {
        $kursus = $this->kursusModel->find($id_kursus); // Untuk mencari kursus berdasarkan ID
        $users = $this->kursusModel->getAllUser(); // untuk mengambil semua pengguna
        $materis = $this->kursusModel->getAllMateri(); // untuk meengambil semua materi
        require_once __DIR__ . '/../views/kursus/edit.php'; // Memuat formulir edit
    }
```
Metode ini dibuat untuk mengambil data kursus berdasarkan ID untuk ditampilkan di formulir edit dan memudahkan pengguna untuk memperbarui informasi kursus yang sudah ada.

```php
public function update($id_kursus, $data) {
        $updated = $this->kursusModel->update($id_kursus, $data); // Memperbarui kursus di database
        if ($updated) {
            header("Location: /kursus/halaman_kursus"); // Redirect ke halaman kursus
        } else {
            echo "Gagal memperbarui kursus."; // Menampilkan pesan kesalahan
        }
    }
```
berfungsi untuk memperbarui data kursus di database dengan data terbaru daroi formulir edit lalu menjaga data tetap terkni dan baru atau update

```php
public function delete($id_kursus) {
        $deleted = $this->kursusModel->delete($id_kursus); // Menghapus kursus dari database
        if ($deleted) {
            header("Location: /kursus/halaman_kursus"); // Redirect ke halaman kursus
        } else {
            echo "Gagal menghapus kursus."; // Menampilkan pesan kesalahan
        }
    }
```

berfugsi untuk agar saat ingin menghapus data dapat menggunkannya berdasarkan id yang diberikan, pennguna dapat mengelola daftar kursus dengan menggunkan hapus untuk tidak lagi diperlukan
