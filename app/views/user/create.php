<!-- app/views/user/create.php -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
<<<<<<< HEAD
        <h2 class="text-center text-primary mb-4">Tambah Pengguna Baru</h2>
        <form action="/user/store" method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <textarea name="email" id="email" class="form-control" rows="4" placeholder="Masukkan email" required></textarea>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <div class="mb-3">
                <label for="peran" class="form-label">Peran:</label>
                <input type="text" name="peran" id="peran" class="form-control" placeholder="Masukkan peran" required>
=======
        <h2 class="text-center text-primary mb-4">Tambah Kursus Baru</h2>
        <form action="/user/store" method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="id_kursus" class="form-label">Id Kursus:</label>
                <input type="number" name="id_kursus" id="id_kursus" class="form-control" placeholder="Masukkan Id Kursus" required>
            </div>
            <div class="mb-3">
                <label for="id_user" class="form-label">ID User:</label>
                <select name="id_user" id="id_user" class="form-control" required>
                    <option value="">Pilih User</option>
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
                
           

            <!-- <div class="mb-3">
                <label for="id_user" class="form-label">Id user:</label>
                <input type="id" name="id_user" id="id_user" class="form-control" placeholder="Masukkan Id Kursus" required>
            </div> -->
            <!-- <div class="mb-3">
                <label for="id_materi" class="form-label">Id materi:</label>
                <input type="id" name="id_materi" id="id_materi" class="form-control" placeholder="Masukkan Id Kursus" required>
            </div> -->
            <div class="mb-3">
                <label for="judul_kursus" class="form-label">Judul Kursus :</label>
                <input type="text" name="judul_kursus" id="judul_kursus" class="form-control" placeholder="Masukkan Judul Instruksi" readonly>
               
            </div>
            <div class="mb-3">
                <label for="instruktur" class="form-label">Instruktur:</label>
                <input type="text" name="instruktur" id="instruktur" class="form-control" placeholder="Masukkan nama instruksi" readonly>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Masukkan Deskripsi Kursus" required></textarea>
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi:</label>
                <input type="text" name="durasi" id="durasi" class="form-control" placeholder="Masukkan nama instruksi" required>
                
>>>>>>> a40eea4b550db65386708ff810de9f23a38ef61c
            </div>
            <div class="text-center">
                <button  type="submit" class="btn btn-primary">Simpan</button>
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
</body>
</html>
