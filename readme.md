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
