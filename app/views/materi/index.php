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
