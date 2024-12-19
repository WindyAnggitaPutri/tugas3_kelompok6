<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kursus Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        footer {
            margin-top: auto;
            width: 100%;
            background-color: #007bff;
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
            <a class="navbar-brand" href="#">Sistem Manajemen Kursus Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user/halaman_user">User</a></li>
                    <li class="nav-item"><a class="nav-link" href="/materi/halaman_materi">Materi</a></li>
                    <li class="nav-item"><a class="nav-link" href="/kursus/halaman_kursus">Kursus</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-4">
        <h2 class="text-center mb-4" style="color:rgb(80, 156, 238);">Daftar User</h2>
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
            <tbody>
                <?php $no = 1; foreach ($user as $user): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($user['nama']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                    <td><?= htmlspecialchars($user['peran']) ?></td>
                    <td>
                        <a href="/user/edit/<?= $user['id_user'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/user/delete/<?= $user['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; 2024 Dashboard Inc. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>