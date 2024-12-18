<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar pertama (Navbar Beranda) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Manajemen Kursus Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbar1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                        <a class="nav-link" href="#courses">Kursus</a>
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div> -->
        </div>
    </nav>

   

    <!-- Section Beranda -->
    <!-- <section id="home" class="text-center py-5">
        <div class="container">
            <h2>Selamat datang di Kursus Online</h2>
            <p>Temukan berbagai kursus untuk meningkatkan keterampilan Anda di bidang yang Anda minati!</p>
            <a href="#courses" class="btn btn-primary">Lihat Kursus</a>
        </div>
    </section> -->

    <!-- Section Kursus -->
    <section id="courses" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">DATA KURSUS ONLINE</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Course 1">
                        <div class="card-body">
                            <h5 class="card-title">USER</h5>
                            <p class="card-text">Data User yang terdapat pada Kursus Online</p>
                            <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Course 2">
                        <div class="card-body">
                            <h5 class="card-title">MATERI</h5>
                            <p class="card-text">Data Materi yang terdapat pada kursus</p>
                            <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Course 3">
                        <div class="card-body">
                            <h5 class="card-title">KURSUS</h5>
                            <p class="card-text">Data Kursus Online</p>
                            <a href="user/kursus" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Kontak
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Kontak Kami</h2>
            <p class="text-center">Jika Anda memiliki pertanyaan atau butuh bantuan, silakan hubungi kami.</p>
            <form action="#" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Anda</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Anda</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </form>
        </div>
    </section> -->

    <!-- Footer -->
   
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 Kursus Online. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
