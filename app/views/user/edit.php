<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Edit User</title>
=======
    <title>Edit Materi</title>
>>>>>>> a40eea4b550db65386708ff810de9f23a38ef61c
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
<<<<<<< HEAD
        <h2 class="text-center text-primary mb-4">Edit User</h2>
        <form action="/user/update/<?php echo $user['id_user']; ?>" method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $user['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin diubah):</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="peran" class="form-label">Peran:</label>
                <select name="peran" id="peran" class="form-select" required>
                    <option value="instruktur" <?php echo $user['peran'] == 'instruktur' ? 'selected' : ''; ?>>Instruktur</option>
                    <option value="peserta" <?php echo $user['peran'] == 'peserta' ? 'selected' : ''; ?>>Peserta</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/user/index" class="btn btn-secondary">Back to List</a>
=======
        <h2 class="text-center text-primary mb-4">Edit Kursus</h2>
        <form action="/user/update/<?php echo $data['id_kursus']; ?>" method="POST" class="bg-white p-4 rounded shadow">

        <div class="mb-3">
                <label for="id_kursus" class="form-label">Id Kursus:</label>
                <input type="number" name="id_kursus" id="id_kursus" class="form-control"  value="<?php echo $id_kursus; ?>"  required>
             
                
                
        </div>
        <div class="mb-3">
                <label for="id_user" class="form-label">ID User:</label>
                <select name="id_user" id="id_user" class="form-control" required>
                <option value="<?php echo $id_user; ?>" selected>
        <?php echo htmlspecialchars($id_user); ?>
    </option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id_user']; ?>" data-user="<?php echo $user['nama']; ?>">
                            <?php echo htmlspecialchars($user['id_user']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>



            <div class="mb-3">
                <label for="id_materi" class="form-label">ID Materi:</label>
                <select name="id_materi" id="id_materi" class="form-control" required>
                    <option value="">ID Materi</option>
                    <?php foreach ($materi as $materi): ?>
                        <option value="<?php echo $materi['id_materi']; ?>" data-materi="<?php echo $materi['kursus_terkait']; ?>">
                            <?php echo htmlspecialchars($materi['id_materi']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        <!-- <?php
        $judul_kursus = isset($kursus['judul_kursus']) ? htmlspecialchars($kursus['judul_kursus'], ENT_QUOTES, 'UTF-8') : '';
        ?> -->
        <div class="mb-3">
                <label for="judul_kursus" class="form-label">Judul Kursus :</label>
                <input type="text" name="judul_kursus" id="judul_kursus" class="form-control"    value="<?php echo isset($data['judul_kursus']) ? htmlspecialchars($kursus['judul_kursus'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
              
              
        </div>
        <div class="mb-3">
                <label for="instruktur" class="form-label">Instruksi :</label>
                <input type="text" name="instruktur" id="instruktur" class="form-control"    value="<?php echo isset($data['instruktur']) ? htmlspecialchars($data['instruktur'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
        </div>

        <!-- <?php $deskripsi = isset($deskripsi) ? $deskripsi : '';?> -->
        <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi :</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required>
    <?php echo isset($data['deskripsi']) ? htmlspecialchars($data['deskripsi'], ENT_QUOTES, 'UTF-8') : ''; ?>
</textarea>
    </textarea>
        </div>
        <div class="mb-3">
                <label for="durasi" class="form-label">Durasi :</label>
                <input type="text" name="durasi" id="durasi" class="form-control"  value="<?php echo $durasi; ?>"   required>
                </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/materi/index" class="btn btn-secondary">Back to List</a>
>>>>>>> a40eea4b550db65386708ff810de9f23a38ef61c
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<<<<<<< HEAD
=======
    <script>
        document.getElementById('id_user').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaUser = selectedOption.getAttribute('data-user');

            document.getElementById('instruktur').value = namaUser || '';

        //     const namaUser = selectedOption.getAttribute('data-user');
        // const peran = selectedOption.getAttribute('data-peran');

        // // Periksa apakah peran adalah 'instruktur'
        // if (peran == 'instruktur') {
        //     document.getElementById('instruktur').value = namaUser || '';
        // } else {
        //     document.getElementById('instruktur').value = 'Bukan Instruktur';
        // }

            
        });
    </script>

<script>
        document.getElementById('id_materi').addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];

            const namaMateri = selectedOption.getAttribute('data-materi');

            document.getElementById('judul_kursus').value = namaMateri || '';
        });
    </script>
>>>>>>> a40eea4b550db65386708ff810de9f23a38ef61c
</body>
</html>
