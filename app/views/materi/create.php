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
