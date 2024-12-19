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
                        <th>NO</th>
                        <th>Judul Kursus</th>
                        <th>Instruktur</th>
                        <th>Deskripsi</th>
                        <th>Durasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($kursuss as $kursus): ?>
                        <tr>
                        <!-- <td><?= $id_kursus++; ?> -->
                        <!-- <td><?= htmlspecialchars($kursus['id_kursus']) ?></td> -->
                            <!-- <td><?= htmlspecialchars($kursus['id_user']) ?></td>
                            <td><?= htmlspecialchars($kursus['id_materi']) ?></td> -->
                            <td><?= $no++ ?></td>
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
        <p class="mb-0">&copy; 2024 AndinAuliaWindy.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>