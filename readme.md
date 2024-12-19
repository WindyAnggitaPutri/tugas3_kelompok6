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
## KURSUS
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
        $id_kursus = $_POST['id_kursus'];
        $id_user = $_POST['id_user'];
        $id_materi = $_POST['id_materi'];
        // $judul_kursus = $_POST['judul_kursus'];
        // $instruktur = $_POST['instruktur'];
        $deskripsi = $_POST['deskripsi'];
        $durasi = $_POST['durasi'];
        $this->kursusModel->add($id_kursus, $id_user, $id_materi, $deskripsi, $durasi);
        header('Location: /kursus/halaman_kursus');
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
        $updated = $this->kursusModel->update($id_kursus, $data);
        if ($updated) {
            header("Location: /kursus/halaman_kursus"); // Redirect to user list
        } else {
            echo "Failed to update kursus.";
        }
    }
```
berfungsi untuk memperbarui data kursus di database dengan data terbaru dari formulir edit lalu menjaga data tetap terkini dan baru atau update

```php
// Process delete request
    public function delete($id_kursus) {
        $deleted = $this->kursusModel->delete($id_kursus);
        if ($deleted) {
            header("Location: /kursus/halaman_kursus"); // Redirect to user list
        } else {
            echo "Failed to delete kursus.";
        }
    }
```

berfugsi untuk agar saat ingin menghapus data dapat menggunkannya berdasarkan id yang diberikan, pennguna dapat mengelola daftar kursus dengan menggunkan hapus untuk tidak lagi diperlukan

### Kursus (didalam folder model)
``` php
<?php
// app/models/User.php
require_once '../config/database.php';
```
Berguna untuk menghubungkannya ke database, memuat konfigurasi dan koneksi


``` php
class kursus {
    private $db;
}
```
metode ini berfungsi untuk berinteraksi dengan table tbl_kursus, class ini mendefinisikan model untuk kursus


``` php
 public function __construct() {
        $this->db = (new Database())->connect();
    }
```
kontruk ini menginisialisasi koneksi database saat objek dari kelas kursus dibuat, agar setiap metode dalam kelas ini dapat menggunakan koneksi yang sama

``` php
public function getAlltbl_kursus() {
        $query = $this->db->query("SELECT k.id_kursus, u.id_user, m.id_materi, m.kursus_terkait as judul_kursus, u.nama as instruktur , k.deskripsi, k.durasi
        from tbl_kursus k 
        join tbl_user u on k.id_user = u.id_user 
        join tbl_materi m on k.id_materi = m.id_materi
        where  u.peran = 'instruktur'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
```
berfungs untuk mengambil semua data dari database, termasuk instruktur dan kursus terkait 


``` php
public function getAllUser(){
        $query = $this->db->query("SELECT * FROM tbl_user where peran = 'instruktur'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
```
berfungsi untuk mengambil seua pengguna yang memiliki peran intrukur

``` php
 public function getAllMateri(){
        $query = $this->db->query("SELECT * FROM tbl_materi");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

```
mengambil semua data materi yang ada dalam database

``` php
public function getAllKursus(){
        $query = $this->db->query("SELECT * FROM tbl_kursus");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
```
mengambil semua data yang terdapat dalam databae, dan untuk menampilkan semua kursus yang ada

``` php
public function find($id_kursus) {
        $query = $this->db->prepare("SELECT * FROM tbl_kursus WHERE id_kursus = :id_kursus");
        $query->bindParam(':id_kursus', $id_kursus, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
```
metode yang berfungsi untuk mencari dan mengambil data berdasarkan if yang ada, yang memudahkan untuk mendapatkan detail tertentu saat melakukan edit


``` php
  public function add($id_kursus, $id_user, $id_materi, $deskripsi, $durasi) {
        $query = $this->db->prepare("INSERT INTO tbl_kursus (id_kursus, id_user, id_materi,  deskripsi, durasi) VALUES (:id_kursus ,:id_user, :id_materi, :deskripsi, :durasi)");
        $query->bindParam(':id_kursus', $id_kursus);
        $query->bindParam(':id_user', $id_user);
        $query->bindParam(':id_materi', $id_materi);
        // $query->bindParam(':judul_kursus', $judul_kursus);
        // $query->bindParam(':instruktur', $instruktur);
        $query->bindParam(':deskripsi', $deskripsi);
        $query->bindParam(':durasi', $durasi);
        return $query->execute();
    }
berfungsi untuk menambahkan kursus baru dalam database dengan data yang diberikan

```php
public function update($id_kursus, $data) {
        $query = "UPDATE tbl_kursus SET  id_user = :id_user, id_materi = :id_materi, deskripsi = :deskripsi, durasi = :durasi WHERE id_kursus = :id_kursus";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id_kursus', $id_kursus);
        $stmt->bindParam(':id_user', $data['id_user']);
        $stmt->bindParam(':id_materi', $data['id_materi']);
        // $stmt->bindParam(':judul _kursus', $data['judul_kursus']);
        // $stmt->bindParam(':instruktur', $data['instruktur']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        $stmt->bindParam(':durasi', $data['durasi']);
        return $stmt->execute();
    }
    }
```
berfungsi untuk memperbarui data yang ada dalam database berdasarkan id


```php
 public function delete($id_kursus) {
        $query = "DELETE FROM tbl_kursus WHERE id_kursus = :id_kursus";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_kursus', $id_kursus);
        return $stmt->execute();
    }
```
metode untuk hapus agar dapat menghapus data dalam database berdasarkkan id 

### Create (Viewas)
```php
 <form action="/kursus/store" method="POST" class="bg-white p-4 rounded shadow">
           
            <div class="mb-3">
                <label for="id_user" class="form-label">ID User:</label>
                <select name="id_user" id="id_user" class="form-control" required>
                    <option value="">Pilih User</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id_user']; ?>" data-user="<?php echo $user['nama']; ?>">
                            <?php echo htmlspecialchars($user['id_user']); ?>
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
                            <?php echo htmlspecialchars($materi['id_materi']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="judul_kursus" class="form-label">Judul Kursus :</label>
                <input type="text" name="judul_kursus" id="judul_kursus" class="form-control" placeholder="Masukkan Judul Instruksi" readonly>
               
            </div>
            <div class="mb-3">
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
```
Code di atas dibuat untuk menampilkan form input yang dimana data yang di inputkan tersebut dapat menambahkan data ke dalam database secara otomatis karena sudah terhubung dengan database

```php
 <script>
       // Menambahkan event listener untuk elemen dengan ID 'id_user'
        document.getElementById('id_user').addEventListener('change', function(){
         // Mendapatkan opsi yang dipilih dari dropdown
            const selectedOption = this.options[this.selectedIndex];

            const namaUser = selectedOption.getAttribute('data-user');

            document.getElementById('instruktur').value = namaUser || '';
 
        });
    </script>
```
code di atas dibuat dengan tujuan untuk menampilja nama instruktur secara otomatis ketika pengguna memilih dari dropdown id_user yang dimana artinya instruktutr tidak perlu menambhkan secara manual nama namanya

```php
<script>
        document.getElementById('id_materi').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaMateri = selectedOption.getAttribute('data-materi');

            document.getElementById('judul_kursus').value = namaMateri || '';
        });
    </script>
```

code di atas dibuat dengan tujuan untuk menampilkan nama judul_kursus secara otomatis ketika pengguna memilih dari dropdown id_materi yang dimana artinya judul kursus tidak perlu menambhkan secara manual judul judulnya
### Edit (Views)
```php
<div class="mb-3">      
             <label for="id_user" class="form-label">ID User:</label>
                <select name="id_user" id="id_user" class="form-control" required>
                   <?php foreach ($users as $user): ?>
                     <option value="<?php echo $user['id_user']; ?>" 
                          data-user="<?php echo $user['nama']; ?>" 
                          <?php echo ($user['id_user'] == $kursus['id_user']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($user['id_user']); ?>
                     </option>
                     <?php endforeach; ?>
                </select>
         </div>
```
code di atas di buat untuk memberikan fungsi edit pada bagian id user, yang dimana data tersebut sudah ada, jadi di placeholdernya sudah tertera data apa yang sudah ada sebelumnya tinggal di edit dan diganti dengan apa yang akan diganti

```php
<div class="mb-3">
            <label for="id_materi" class="form-label">ID Materi:</label>
                <select name="id_materi" id="id_materi" class="form-control" required>
                    <?php foreach ($materis as $materi): ?>
                        <option value="<?php echo $materi['id_materi']; ?>" 
                            data-user="<?php echo $materi['kursus_terkait']; ?>" 
                            <?php echo ($materi['id_materi'] == $kursus['id_materi']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($materi['id_materi']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
         </div>
```
code di atas di buat untuk memberikan fungsi edit pada bagian id materi, yang dimana data tersebut sudah ada, jadi di placeholdernya sudah tertera data apa yang sudah ada sebelumnya tinggal di edit dan diganti dengan apa yang akan diganti

```php
 <div class="mb-3">
                <label for="judul_kursus" class="form-label">Judul Kursus :</label>
                <input type="text" name="judul_kursus" id="judul_kursus" class="form-control"  readonly value="<?php echo $kursus['judul_kursus']; ?>">
          </div>
``
code di atas di buat untuk memberikan fungsi edit pada bagian id user, yang dimana data tersebut sudah ada, jadi di placeholdernya sudah tertera data apa yang sudah ada sebelumnya tinggal di edit dan diganti dengan apa yang akan diganti

```php
<div class="mb-3">
                <label for="instruktur" class="form-label">Instruksi :</label>
                <input type="text" name="instruktur" id="instruktur" class="form-control"    value="<?php echo $kursus['instruktur']; ?>">
         </div>
```
code di atas di buat untuk memberikan fungsi edit pada bagian instruksi, yang dimana data tersebut sudah ada, jadi di placeholdernya sudah tertera data apa yang sudah ada sebelumnya tinggal di edit dan diganti dengan apa yang akan diganti

```php
 <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi :</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required>
                   <?php echo isset($kursus['deskripsi']) ? htmlspecialchars($kursus['deskripsi'], ENT_QUOTES, 'UTF-8') : ''; ?>
                </textarea>
         </div>
```
code di atas di buat untuk memberikan fungsi edit pada bagian deskripsi, yang dimana data tersebut sudah ada, jadi di placeholdernya sudah tertera data apa yang sudah ada sebelumnya tinggal di edit dan diganti dengan apa yang akan diganti
```php
<div class="mb-3">
                <label for="durasi" class="form-label">Durasi :</label>
                <input type="text" name="durasi" id="durasi" class="form-control"  value="<?php echo $kursus['durasi']; ?>"   required>
         </div>
```
code di atas di buat untuk memberikan fungsi edit pada bagian durasi, yang dimana data tersebut sudah ada, jadi di placeholdernya sudah tertera data apa yang sudah ada sebelumnya tinggal di edit dan diganti dengan apa yang akan diganti

```php
<div class="text-center">
                <button href="kursus/halaman_kursus" type="submit" class="btn btn-primary">Update</button>
                <a href="/kursus/halaman_kursus" class="btn btn-secondary">Back to List</a>
         </div>
```


```php
<script>
        document.getElementById('id_user').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaUser = selectedOption.getAttribute('data-user');

            document.getElementById('instruktur').value = namaUser || '';

        });
    </script>
```
code di atas dibuat dengan tujuan untuk menampilja nama instruktur secara otomatis ketika pengguna memilih dari dropdown id_user yang dimana artinya instruktutr tidak perlu menambhkan secara manual nama namanya, dimana juga artinya saat di akan edit juga data tersebut juga akan sudah tertera data seblumnya

```php
<script>
        document.getElementById('id_materi').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaMateri = selectedOption.getAttribute('data-materi');

            document.getElementById('judul_kursus').value = namaMateri || '';
        });
    </script>
```
code di atas dibuat dengan tujuan untuk menampilja nama judul kursus secara otomatis ketika pengguna memilih dari dropdown id_materi yang dimana artinya judul kursus tidak perlu menambhkan secara manual nama namanya, dimana juga artinya saat di akan edit juga data tersebut juga akan sudah tertera data seblumnya

### Halaman_Kursus (views)
```css
<style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        body {
            background-color: #f0f8ff; /* Light blue background */
        }
        .navbar {
            background-color: #007bff; /* Primary blue */
        }
        .card {
            border: none;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #004494;
        }
        .content {
            flex: 1; /* Buat konten mengisi ruang yang tersisa */
        }
        footer {
            width: 100%;
            background-color: #007bff; /* Footer warna biru */
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
```
Code di atas adalah code css yang dimana akan memberikan tampilan di web(halaman_kursus) dimana akan memberikan tampilan menrarik

```html
 <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand">Sistem Manajemen Kursus Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/halaman_user">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/materi/halaman_materi">Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kursus/halaman_kursus">Kursus</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
```
code di atas dibuat untuk membuat navbar dan diberikan link agar dapat mengarah ke link atau halaman yang diinginkan

```html
<thead style="background-color:rgb(80, 156, 238); color: white;">
                    <tr>
                        <th>Id Kursus</th>
                        <th>Id User</th>
                        <th>Id Materi</th>
                        <th>Judul Kursus</th>
                        <th>Instruktur</th>
                        <th>Deskripsi</th>
                        <th>Durasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

```
code di atas digunakan untuk membuat table untuk menampilkan data data

```php
//digunkaa untuk menginisialisasikan dan mebghitung index mulai dari 1 
<?php $id_kursus = 1; foreach ($kursuss as $kursus): ?>
                        <tr>
                        <td><?= $id_kursus++; ?> //diberikan agar id_kursus mulai dari 1 dan terus belanjut
                            <td><?= htmlspecialchars($kursus['id_user']) ?></td> digunakan untuk menamilkan id user dan menaruhnya di dalam tabel
                            <td><?= htmlspecialchars($kursus['id_materi']) ?></td> digunakan untuk menamilkan id materi dan menaruhnya di dalam tabel
                            <td><?= htmlspecialchars($kursus['judul_kursus']) ?></td> digunakan untuk menamilkan judul kursus dan menaruhnya di dalam tabel
                            <td><?= htmlspecialchars($kursus['instruktur']) ?></td>digunakan untuk menamilkan iinstruktur dan menaruhnya di dalam tabel
                            <td><?= htmlspecialchars($kursus['deskripsi']) ?></td>digunakan untuk menamilkan deskripsi dan menaruhnya di dalam tabel
                            <td><?= htmlspecialchars($kursus['durasi']) ?></td>digunakan untuk menamilkan durasi dan menaruhnya di dalam tabel
                            <td>
                                <a href="/kursus/edit/<?= $kursus['id_kursus']; ?>" class="btn btn-warning btn-sm">Edit</a> |
                                <a href="/kursus/delete/<?= $kursus['id_kursus']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
```
code di atas dibuat untuk menampilkan data yang telah di inputkan melalui form input

### Index(viewa)
```css
 <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        body {
            background-color: #f0f8ff; 
        }
        .navbar {
        background-color: #007bff; 
        color: white;
        padding: 10px 20px;
        text-align: center; 
        font-size: 18px;
        font-weight: bold;
    }
            .content {
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            min-height: calc(100vh - 120px); 
            padding: 20px; 
        }
        .row {
            display: flex; 
            justify-content: center; 
            gap: 20px; 
        }

        .card {
            border: none;
            transition: transform 0.3s;
            align-items:  center;
            justify-content: center;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #004494;
        }
        .content {
            flex: 1;
            
        }
        footer {
            width: 100%;
            background-color: #007bff; /* Footer warna biru */
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        
    </style>
```
Code di atas adalah code css yang dimana akan memberikan tampilan di web(halaman_kursus) dimana akan memberikan tampilan menarik

```html
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Manajemen Kursus Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/halaman_user">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/materi/halaman_materi">Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kursus/halaman_kursus">Kursus</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content container py-5">
        <h1 class="text-center mb-4 text-primary">Selamat Datang di Kursus Online</h1>

        <div class="row g-4">
            <!-- Menu 1 -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="foto/userpic.jpg" class="card-img-top" alt="Menu 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">User</h5>
                        <p class="card-text">Data user yang ada di kursus online</p>
                        <a href="/user/halaman_user" class="btn btn-primary">Cek Data User</a>
                    </div>
                </div>
            </div>

            <!-- Menu 2 -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="foto/materipic.jpg" class="card-img-top" alt="Menu 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Materi</h5>
                        <p class="card-text">Data Materi yang ada di Kursus Online</p>
                        <a href="/materi/halaman_materi" class="btn btn-primary">Cek Data Materi</a>
                    </div>
                </div>
            </div>

            <!-- Menu 3 -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="foto/kursuss.jpg" class="card-img-top" alt="Menu 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kursus</h5>
                        <p class="card-text">Data Kursus yang ada di Kursus Online </p>
                        <a href="/kursus/halaman_kursus" class="btn btn-primary">Cek Data Kursus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; 2024 AndinAuliaWindy.</p>
    </footer>
```


digunakan untuk memberikan tampilan berupa navbar yang diberikan link dan dapat mengarah ke halaman tertentu yang telah ditentukan

### Routes 
* routes.php

  "routes.php" memetakan permintaan masuk ke metode pengontrol yang sesuai.
  ````php
  <?php
// routes.php

require_once 'app/controllers/UserController.php';
require_once 'app/controllers/MateriController.php';
require_once 'app/controllers/KursusController.php';
```
mengimpor file pengontrol yang dibutuhkan yaitu useController, materiController, kursusController. setiap pengontrol berisi metode terkait entitas user, materi, kursus.

```php
$controllerUser = new UserController();
$controllerMateri = new MateriController();
$controllerKursus = new KursusController();
$url = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
```
instansiasi pengonrtol sehingga metodenya dapat dipanggil. 
$url: Mengambil jalur URL dari permintaan saat ini.
$requestMethod: Mendapatkan metode HTTP (seperti GET, POST) yang digunakan dalam permintaan.

```php
if ($url == '/kursus/halaman_kursus' ) {
    $controllerKursus->halaman_kursus();
} elseif ($url == '/Kursus/index' ) {
    $controllerKursus->index();
} elseif ($url == '/Kursus/home' ) {
    $controllerKursus->home();
} elseif ($url == '/') {
    $controllerKursus->index();
} elseif ($url == '/kursus/create' && $requestMethod == 'GET') {
    $controllerKursus->create();
} elseif ($url == '/kursus/store' && $requestMethod == 'POST') {
    $controllerKursus->store();
} elseif (preg_match('/\/kursus\/edit\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $kursusId = $matches[1];
    $controllerKursus->edit($kursusId);
} elseif (preg_match('/\/kursus\/update\/(\d+)/', $url, $matches) && $requestMethod == 'POST') {
    $kursusId = $matches[1];
    $controllerKursus->update($kursusId, $_POST);
} elseif (preg_match('/\/kursus\/delete\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $kursusId = $matches[1];
    $controllerKursus->delete($kursusId);
}
```
routing untuk kursus
1. halaman_kursus
Dipanggil ketika URL adalah /kursus/halaman_kursus.
Memanggil metode halaman_kursus() di KursusController.

2. index dan home
Memetakan /Kursus/index dan /Kursus/home ke metode yang sesuai di KursusController.
/ juga dipetakan ke index().

3. create dan store
/kursus/create dengan metode GET memanggil metode create().
/kursus/store dengan metode POST memanggil metode store(), meneruskan data formulir melalui $_POST.

4. edit, update, dan delete
Menggunakan regex untuk mencocokkan rute seperti /kursus/edit/{id} atau /kursus/update/{id}.
Menangkap {id} dari URL dan meneruskannya sebagai parameter ke metode yang sesuai.

``php
if ($url == '/materi/halaman_materi' ) {
    $controllerMateri->halaman_materi();
} elseif ($url == '/materi/create' && $requestMethod == 'GET') {
    $controllerMateri->create();
} elseif ($url == '/materi/store' && $requestMethod == 'POST') {
    $controllerMateri->store();
} elseif (preg_match('/\/materi\/edit\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $materiId = $matches[1];
    $controllerMateri->edit($materiId);
} elseif (preg_match('/\/materi\/update\/(\d+)/', $url, $matches) && $requestMethod == 'POST') {
    $materiId = $matches[1];
    $controllerMateri->update($materiId, $_POST);
} elseif (preg_match('/\/materi\/delete\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $materiId = $matches[1];
    $controllerMateri->delete($materiId);
    ```
routing untuk materi, sama halnya dengan routimg untuk kursus berlaku dan berfungsi sama.

```php
if ($url == '/user/halaman_user' ) {
    $controllerUser->halaman_user();
} elseif ($url == '/user/create' && $requestMethod == 'GET') {
    $controllerUser->create();
} elseif ($url == '/user/store' && $requestMethod == 'POST') {
    $controllerUser->store();
} elseif (preg_match('/\/user\/edit\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $userId = $matches[1];
    $controllerUser->edit($userId);
} elseif (preg_match('/\/user\/update\/(\d+)/', $url, $matches) && $requestMethod == 'POST') {
    $userId = $matches[1];
    $controllerUser->update($userId, $_POST);
} elseif (preg_match('/\/user\/delete\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $userId = $matches[1];
    $controllerUser->delete($userId);
}
```
routing untuk user

```php
else {
    http_response_code(404);
    echo "hihi";
}
digunakan untuk membuat link yang dapat mengarahkan file filenya, yang dapat mengarahkan berbagai permintaan ke controller yang sesuai berdasarkan url yang telah dibuat.


## MATERI
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

## USER
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

#Edit.php
```php
<!-- app/views/user/edit.php -->
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
        <h2 class="text-center text-primary mb-4">Edit Kursus</h2>
        <form action="/kursus/update/<?php echo $kursus['id_kursus']; ?>" method="POST" class="bg-white p-4 rounded shadow">
        <div class="mb-3">      
             <label for="id_user" class="form-label">Instruktur :</label>
                <select name="id_user" id="id_user" class="form-control" required>
                   <?php foreach ($users as $user): ?>
                     <option value="<?php echo $user['id_user']; ?>" 
                          data-user="<?php echo $user['nama']; ?>" 
                          <?php echo ($user['id_user'] == $kursus['id_user']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($user['nama']); ?>
                     </option>
                     <?php endforeach; ?>
                </select>
         </div>
         <div class="mb-3" >
            <label for="id_materi" class="form-label">Judul Kursus:</label>
                <select name="id_materi" id="id_materi" class="form-control" required>
                    <?php foreach ($materis as $materi): ?>
                        <option value="<?php echo $materi['id_materi']; ?>" 
                            data-user="<?php echo $materi['kursus_terkait']; ?>" 
                            <?php echo ($materi['id_materi'] == $kursus['id_materi']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($materi['kursus_terkait']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
         </div>
         <div class="mb-3" style="display: none;">
                <label for="judul_kursus" class="form-label">Judul Kursus :</label>
                <input type="text" name="judul_kursus" id="judul_kursus" class="form-control"  readonly value="<?php echo $kursus['judul_kursus']; ?>" readonly>
          </div>
         <div class="mb-3"style="display: none;">
                <label for="instruktur" class="form-label">Instruksi :</label>
                <input type="text" name="instruktur" id="instruktur" class="form-control"    value="<?php echo $kursus['instruktur']; ?>" readonly>
         </div>
         <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi :</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required>
                   <?php echo isset($kursus['deskripsi']) ? htmlspecialchars($kursus['deskripsi'], ENT_QUOTES, 'UTF-8') : ''; ?>
                </textarea>
         </div>
         <div class="mb-3">
                <label for="durasi" class="form-label">Durasi :</label>
                <input type="text" name="durasi" id="durasi" class="form-control"  value="<?php echo $kursus['durasi']; ?>"   required>
         </div>
         <div class="text-center">
                <button href="kursus/halaman_kursus" type="submit" class="btn btn-primary">Update</button>
                <a href="/kursus/halaman_kursus" class="btn btn-secondary">Back to List</a>
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
File ini adalah halaman web yang digunakan untuk mengedit data kursus yang sudah ada dalam sistem. Halaman ini dirancang menggunakan HTML, PHP, dan Bootstrap 5 untuk memberikan tampilan yang responsif dan fitur interaktif untuk mempermudah pengeditan data kursus.

Fitur Utama
Dropdown Dinamis:
Dropdown Instruktur otomatis mengisi kolom Instruksi berdasarkan pilihan user.
Dropdown Judul Kursus otomatis mengisi kolom Judul Kursus berdasarkan pilihan materi.
Form dengan Data Awal:
Data yang sudah ada sebelumnya ditampilkan secara otomatis di form untuk diedit.
Validasi:
Atribut required digunakan untuk memastikan semua data wajib diisi.
Navigasi:
Tombol Update untuk menyimpan perubahan.
Tombol Back to List untuk kembali ke halaman daftar kursus.
Struktur Input Form
Instruktur:
Dropdown yang terisi dengan daftar instruktur.
Kolom Instruksi otomatis terisi berdasarkan instruktur yang dipilih.
Judul Kursus:
Dropdown yang terisi dengan daftar materi.
Kolom Judul Kursus otomatis terisi berdasarkan materi yang dipilih.
Deskripsi:
Input teks area untuk memasukkan deskripsi kursus.
Durasi:
Input teks untuk memasukkan durasi kursus.
Tombol:
Update: Mengirimkan data ke endpoint /kursus/update/{id_kursus}.
Back to List: Mengarahkan kembali ke halaman daftar kursus.

# halaman_kursus.php
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kursus Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        body {
            background-color: #f0f8ff; /* Light blue background */
        }
        .navbar {
            background-color: #007bff; /* Primary blue */
        }
        .card {
            border: none;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #004494;
        }
        .content {
            flex: 1; /* Buat konten mengisi ruang yang tersisa */
        }
        footer {
            width: 100%;
            background-color: #007bff; /* Footer warna biru */
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand">Sistem Manajemen Kursus Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/halaman_user">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/materi/halaman_materi">Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kursus/halaman_kursus">Kursus</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="content">
        <div class="container mt-4">
            <h2 class="text-center mb-4" style="color:rgb(80, 156, 238);">Daftar Kursus</h2>
            <a href="/kursus/create" class="btn btn-primary mb-3">Tambah Kursus Baru</a>
            <table class="table table-bordered table-hover" style="border: 2px solid rgb(80, 156, 238);">
                <thead style="background-color:rgb(80, 156, 238); color: white;">
                    <tr>
                        <!-- <th>Id Kursus</th> -->
                        <!-- <th>Id User</th>
                        <th>Id Materi</th> -->
                        <th>Judul Kursus</th>
                        <th>Instruktur</th>
                        <th>Deskripsi</th>
                        <th>Durasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($kursuss as $kursus): ?>
                        <tr>
                        <!-- <td><?= $id_kursus++; ?> -->
                        <!-- <td><?= htmlspecialchars($kursus['id_kursus']) ?></td> -->
                            <!-- <td><?= htmlspecialchars($kursus['id_user']) ?></td>
                            <td><?= htmlspecialchars($kursus['id_materi']) ?></td> -->
                            <td><?= htmlspecialchars($kursus['judul_kursus']) ?></td>
                            <td><?= htmlspecialchars($kursus['instruktur']) ?></td>
                            <td><?= htmlspecialchars($kursus['deskripsi']) ?></td>
                            <td><?= htmlspecialchars($kursus['durasi']) ?></td>
                            <td>
                                <a href="/kursus/edit/<?= $kursus['id_kursus']; ?>" class="btn btn-warning btn-sm">Edit</a> |
                                <a href="/kursus/delete/<?= $kursus['id_kursus']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; 2024 Dashboard Inc. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
File ini adalah halaman utama untuk sistem manajemen kursus online. Halaman ini menampilkan daftar kursus yang tersedia serta menyediakan fitur untuk menambah, mengedit, dan menghapus kursus. Desain halaman ini menggunakan framework Bootstrap 5 dengan tambahan CSS custom untuk memberikan pengalaman antarmuka yang modern dan responsif.

Fitur Utama
Navbar Navigasi:
Menyediakan menu navigasi untuk halaman:
Home
User
Materi
Kursus
Tabel Daftar Kursus:
Menampilkan daftar kursus dalam bentuk tabel dengan kolom:
Judul Kursus
Instruktur
Deskripsi
Durasi
Aksi (Edit & Delete)
Tombol Tambah Kursus:
Memungkinkan pengguna untuk menambahkan kursus baru dengan mengarahkan ke halaman pembuatan kursus.
Aksi Edit dan Delete:
Edit: Mengarahkan pengguna ke halaman pengeditan kursus tertentu.
Delete: Menghapus kursus dengan konfirmasi untuk mencegah kesalahan.
Struktur Halaman
Navbar:
Posisi di bagian atas halaman.
Warna biru dengan teks putih untuk tampilan profesional.
Opsi navigasi menuju halaman lain yang relevan.
Konten Utama:
Tabel daftar kursus yang menampilkan informasi kursus.
Tombol tambah kursus untuk menambah data baru.
Footer:
Informasi hak cipta di bagian bawah halaman.
Warna biru dengan teks putih selaras dengan tema navbar.
