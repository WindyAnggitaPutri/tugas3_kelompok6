<<<<<<< HEAD
=======
<!-- app/views/user/index.php -->

>>>>>>> cd039f1faf0b96715bf10b5ee575e61be282ac11
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Kursus Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar pertama (Navbar Beranda) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Manajemen Kursus Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbar1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                        <a class="nav-link" href="#courses">Kursus</a>
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div> -->
=======
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
=======
        <tbody>
<ul>
    <?php foreach ($kursus as $kursus): ?>
       
            <tr>
                <td><p><?= htmlspecialchars($kursus['id_kursus']) ?> </td>
                <td><?= htmlspecialchars($kursus['id_user']) ?></td>
                <td><?= htmlspecialchars($kursus['id_materi']) ?></td>
                <td> <?= htmlspecialchars($kursus['judul_kursus']) ?></td>
                <td><?= htmlspecialchars($kursus['instruktur']) ?></td>
                <td><?= htmlspecialchars($kursus['deskripsi']) ?></td>
                <td><?= htmlspecialchars($kursus['durasi']) ?></td>
                <td><a href="/user/edit/<?= $kursus['id_kursus']; ?>" class="btn btn-warning btn-sm">Edit</a> |
                        <a href="/user/delete/<?= $kursus['id_kursus']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</a>
                    </td></td>
             
            
        
            
            </p>
            </tr>
>>>>>>> cd039f1faf0b96715bf10b5ee575e61be282ac11
        </div>
    </nav>

   

    <!-- Section Beranda -->
    <!-- <section id="home" class="text-center py-5">
        <div class="container">
            <h2>Selamat datang di Kursus Online</h2>
            <p>Temukan berbagai kursus untuk meningkatkan keterampilan Anda di bidang yang Anda minati!</p>
            <a href="#courses" class="btn btn-primary">Lihat Kursus</a>
        </div>
    </section> -->

    <!-- Section Kursus -->
    <section id="courses" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">DATA KURSUS ONLINE</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Course 1">
                        <div class="card-body">
                            <h5 class="card-title">USER</h5>
                            <p class="card-text">Data User yang terdapat pada Kursus Online</p>
                            <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Course 2">
                        <div class="card-body">
                            <h5 class="card-title">MATERI</h5>
                            <p class="card-text">Data Materi yang terdapat pada kursus</p>
                            <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Course 3">
                        <div class="card-body">
                            <h5 class="card-title">KURSUS</h5>
                            <p class="card-text">Data Kursus Online</p>
                            <a href="user/kursus" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<<<<<<< HEAD
    <!-- Section Kontak
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Kontak Kami</h2>
            <p class="text-center">Jika Anda memiliki pertanyaan atau butuh bantuan, silakan hubungi kami.</p>
            <form action="#" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Anda</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Anda</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </form>
        </div>
    </section> -->

    <!-- Footer -->
   
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 Kursus Online. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
</body>
>>>>>>> a40eea4b550db65386708ff810de9f23a38ef61c
>>>>>>> cd039f1faf0b96715bf10b5ee575e61be282ac11
