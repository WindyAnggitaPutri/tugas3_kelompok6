<!-- app/views/user/index.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kursus</title>
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
    <h2 class="text-center mb-4" style="color:rgb(80, 156, 238);">Daftar Kursus</h2>
    <a href="/user/create" class="btn btn-primary mb-3">Tambah Kursus Baru</a>
    <table class="table table-bordered table-hover" style="border: 2px solid rgb(80, 156, 238);">
        <tbody style="background-color:rgb(80, 156, 238); color: white;">
            <tr>
                <th>Id kursus</th>
                <th>Id User</th>
                <th>Id Materi</th>
                <th>Judul Kursus</th>
                <th>Instruktur</th>
                <th>Deskripsi</th>
                <th>Durasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
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
                <td><a href="/materi/edit/<?= $materi['id_materi']; ?>" class="btn btn-warning btn-sm">Edit</a> |
                        <a href="/materi/delete/<?= $materi['id_materi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</a>
                    </td></td>
             
            
        
            
            </p>
            </tr>
        </div>

        
    <?php endforeach; ?>
</ul>


</tbody>

</body>