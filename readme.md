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
  public function add($id_kursus, $id_user, $id_materi, $judul_kursus, $instruktur, $deskripsi, $durasi) {
        $query = $this->db->prepare("INSERT INTO tbl_kursus (id_kursus, id_user, id_materi, judul_kursus, instruktur, deskripsi, durasi) VALUES (:id_kursus ,:id_user, :id_materi, :judul_kursus, :instruktur, :deskripsi, :durasi)");
        $query->bindParam(':id_kursus', $id_kursus);
        $query->bindParam(':id_user', $id_user);
        $query->bindParam(':id_materi', $id_materi);
        $query->bindParam(':judul_kursus', $judul_kursus);
        $query->bindParam(':instruktur', $instruktur);
        $query->bindParam(':deskripsi', $deskripsi);
        $query->bindParam(':durasi', $durasi);
        return $query->execute();
    }
berfungsi untuk menambahkan kursus baru dalam database dengan data yang diberikan

```php
public function update($id_kursus, $data) {
        $query = "UPDATE tbl_kursus SET id_kursus = :id_kursus, id_user = :id_user, id_materi = :id_materi, judul_kursus = :judul_kursus, instruktur = :instruktur, deskripsi = :deskripsi, durasi = :durasi WHERE id_kursus = :id_kursus";
        $stmt = $this->db->prepare($query);
        
        // $stmt->bindParam(':id_kursus', $data['id_kursus']);
        $stmt->bindParam(':id_user', $data['id_user']);
        $stmt->bindParam(':id_materi', $data['id_materi']);
        $stmt->bindParam(':judul_kursus', $data['judul_kursus']);
        $stmt->bindParam(':instruktur', $data['instruktur']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        $stmt->bindParam(':durasi', $data['durasi']);
        return $stmt->execute();
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


