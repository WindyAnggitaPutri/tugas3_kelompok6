<!-- app/views/user/edit.php -->
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
        <h2 class="text-center text-primary mb-4">Edit Kursus</h2>
        <form action="/kursus/update/<?php echo $kursus['id_kursus']; ?>" method="POST" class="bg-white p-4 rounded shadow">
        <div class="mb-3">      
             <label for="id_user" class="form-label">Instruktur :</label>
                <select name="id_user" id="id_user" class="form-control" required>
                   <?php foreach ($users as $user): ?>
                     <option value="<?php echo $user['id_user']; ?>" 
                          data-user="<?php echo $user['nama']; ?>" 
                          <?php echo ($user['id_user'] == $kursus['id_user']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($user['nama']); ?>
                     </option>
                     <?php endforeach; ?>
                </select>
         </div>
         <div class="mb-3" >
            <label for="id_materi" class="form-label">Judul Kursus:</label>
                <select name="id_materi" id="id_materi" class="form-control" required>
                    <?php foreach ($materis as $materi): ?>
                        <option value="<?php echo $materi['id_materi']; ?>" 
                            data-user="<?php echo $materi['kursus_terkait']; ?>" 
                            <?php echo ($materi['id_materi'] == $kursus['id_materi']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($materi['kursus_terkait']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
         </div>
         <div class="mb-3" style="display: none;">
                <label for="judul_kursus" class="form-label">Judul Kursus :</label>
                <input type="text" name="judul_kursus" id="judul_kursus" class="form-control"  readonly value="<?php echo $kursus['judul_kursus']; ?>" readonly>
          </div>
         <div class="mb-3"style="display: none;">
                <label for="instruktur" class="form-label">Instruksi :</label>
                <input type="text" name="instruktur" id="instruktur" class="form-control"    value="<?php echo $kursus['instruktur']; ?>" readonly>
         </div>
         <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi :</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required>
                   <?php echo isset($kursus['deskripsi']) ? htmlspecialchars($kursus['deskripsi'], ENT_QUOTES, 'UTF-8') : ''; ?>
                </textarea>
         </div>
         <div class="mb-3">
                <label for="durasi" class="form-label">Durasi :</label>
                <input type="text" name="durasi" id="durasi" class="form-control"  value="<?php echo $kursus['durasi']; ?>"   required>
         </div>
         <div class="text-center">
                <button href="kursus/halaman_kursus" type="submit" class="btn btn-primary">Update</button>
                <a href="/kursus/halaman_kursus" class="btn btn-secondary">Back to List</a>
         </div>
         </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('id_user').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaUser = selectedOption.getAttribute('data-user');

            document.getElementById('instruktur').value = namaUser || '';

        });
    </script>

    <script>
        document.getElementById('id_materi').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaMateri = selectedOption.getAttribute('data-materi');

            document.getElementById('judul_kursus').value = namaMateri || '';
        });
    </script>
</body>
</html>