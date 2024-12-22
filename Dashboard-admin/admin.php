<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Tambahan CSS untuk desain */
        .card-custom {
            color: white;
            padding: 15px;
            border-radius: 10px;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .navbar {
        z-index: 1050; /* Navbar di atas elemen lain */
        }

        .card-blue { background-color: #1E90FF; }
        .card-green { background-color: #28a745; }
        .card-red { background-color: #dc3545; }
        .icon-large {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #343a40;
            min-height: 100vh;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }

        /* Hide sidebar on small devices */
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
<!-- Navbar untuk HP -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Zahrarental</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-car me-2"></i>Data Mobil</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-book me-2"></i>Data Booking</a></li>
                <li class="nav-item"><a class="nav-link" href="../Final.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar untuk Laptop -->
        <div class="col-lg-2 sidebar d-none d-lg-block">
            <h4 class="text-center py-3">Zahrarental</h4>
            <ul class="nav flex-column">
                <li><a href="#"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                <li><a href="#"><i class="fas fa-car me-2"></i>Data Mobil</a></li>
                <li><a href="#"><i class="fas fa-book me-2"></i>Data Booking</a></li>
                <li><a href="../Final.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="col-lg-10 col-12 p-4">
            <h3>Dashboard</h3>
            <p>Hai <strong>Admin</strong>, selamat datang di halaman admin</p>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-12 col-md-4">
                    <div class="card-custom card-blue">
                        <i class="fas fa-car icon-large"></i>
                        <h5>Jumlah Mobil</h5>
                        <a href="update.php" class="stretched-link"></a>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-12 col-md-4">
                    <div class="card-custom card-green">
                        <i class="fas fa-clipboard-list icon-large"></i>
                        <h5>Mobil yang Dibooking</h5>
                        <a href="update.php" class="stretched-link"></a>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-12 col-md-4">
                    <div class="card-custom card-red">
                        <i class="fas fa-user-edit icon-large"></i>
                        <h5>Update Mobil</h5>
                        <a href="update.php" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
