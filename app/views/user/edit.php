<!-- app/views/user/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Kursus</title>
</head>
<body>
    <h2>Edit Kursus</h2>
    <form action="/user/update/<?php echo $kursus['id_kursus']; ?>" method="POST">
        <label for="id_kursus">Id Kursus:</label>
        <input type="id" id="id_kursus" name="id_kursus" value="<?php echo $kursus['id_kursus']; ?>" required>
        <br>
        <label for="id_user">Id User:</label>
        <input type="id" id="id_user" name="id_user" value="<?php echo $kursus['id_user']; ?>" required>
        <br>
        <label for="id_materi">Id Materi:</label>
        <input type="id" id="id_materi" name="id_materi" value="<?php echo $kursus['id_materi']; ?>" required>
        <br>
        <label for="judul_kursus">Judul Kursus:</label>
        <input type="text" id="judul_kursus" name="judul_kursus" value="<?php echo $kursus['judul_kursus']; ?>" required>
        <br>
        <label for="instruktur">Instruktur:</label>
        <input type="text" id="instruktur" name="instruktur" value="<?php echo $kursus['instruktur']; ?>" required>
        <br>
        <label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" value="<?php echo $kursus['deskripsi']; ?>" required>
        <br>
        <label for="durasi">Durasi:</label>
        <input type="text" id="durasi" name="durasi" value="<?php echo $kursus['durasi']; ?>" required>
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="/user/index">Back to List</a>
</body>
</html>