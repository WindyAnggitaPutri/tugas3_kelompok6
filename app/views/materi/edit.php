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
