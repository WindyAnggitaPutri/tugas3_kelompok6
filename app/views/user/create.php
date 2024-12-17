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
        <form action="/materi/store" method="POST" class="bg-white p-4 rounded shadow">
            <!-- <div class="mb-3">
                <label for="id_kursus" class="form-label">Id Kursus:</label>
                <input type="id" name="id_kursus" id="judul_materi" class="form-control" placeholder="Masukkan Id Kursus" required>
            </div> -->
            <div class="mb-3">
                <label for="judul_kursus" class="form-label">Judul Kursus:</label>
                <textarea name="judul_kursus" id="judul_kursus" class="form-control" rows="4" placeholder="Masukkan Judul Kursus" required></textarea>
            </div>
            <!-- <div class="mb-3">
                <label for="instruksi" class="form-label">Instruksi:</label>
                <input type="text" name="instruksi" id="instruksi" class="form-control" placeholder="Masukkan nama instruksi" required>
            </div> -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Masukkan Deskripsi Kursus" required></textarea>
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi:</label>
                <textarea name="durasi" id="durasi" class="form-control" rows="4" placeholder="Masukkan Judul Kursus" required></textarea>
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


