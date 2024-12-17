<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
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
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
