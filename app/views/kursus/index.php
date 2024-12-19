<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kursus Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        body {
            background-color: #f0f8ff; 
        }
        .navbar {
        background-color: #007bff; 
        color: white;
        padding: 10px 20px;
        text-align: center; 
        font-size: 18px;
        font-weight: bold;
    }
            .content {
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            min-height: calc(100vh - 120px); 
            padding: 20px; 
        }
        .row {
            display: flex; 
            justify-content: center; 
            gap: 20px; 
        }

        .card {
            border: none;
            transition: transform 0.3s;
            align-items:  center;
            justify-content: center;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #004494;
        }
        .content {
            flex: 1;
            
        }
        footer {
            width: 100%;
            background-color: #007bff; /* Footer warna biru */
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Manajemen Kursus Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/halaman_user">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/materi/halaman_materi">Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kursus/halaman_kursus">Kursus</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content container py-5">
        <h1 class="text-center mb-4 text-primary">Selamat Datang di Kursus Online</h1>

        <div class="row g-4">
            <!-- Menu 1 -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="foto/userpic.jpg" class="card-img-top" alt="Menu 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">User</h5>
                        <p class="card-text">Data user yang ada di kursus online</p>
                        <a href="/user/halaman_user" class="btn btn-primary">Cek Data User</a>
                    </div>
                </div>
            </div>

            <!-- Menu 2 -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="foto/materipic.jpg" class="card-img-top" alt="Menu 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Materi</h5>
                        <p class="card-text">Data Materi yang ada di Kursus Online</p>
                        <a href="/materi/halaman_materi" class="btn btn-primary">Cek Data Materi</a>
                    </div>
                </div>
            </div>

            <!-- Menu 3 -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="foto/kursuss.jpg" class="card-img-top" alt="Menu 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kursus</h5>
                        <p class="card-text">Data Kursus yang ada di Kursus Online </p>
                        <a href="/kursus/halaman_kursus" class="btn btn-primary">Cek Data Kursus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; 2024 AndinAuliaWindy.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>