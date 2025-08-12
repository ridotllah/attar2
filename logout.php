<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Portofolio</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        nav {
            background: #34495e;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
        }
        .card {
            background: white;
            padding: 15px;
            margin: 15px auto;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    </header>

    <nav>
        <a href="welcome.php">Home</a>
        <a href="nilai.php">Nilai</a>
        <a href="kehadiran.php">Kehadiran</a>
        <a href="jadwal.php">Jadwal</a>
        <a href="pengaturan.php">Pengaturan</a>
        <a href="laporan.php">Laporan</a>
        <a href="logout.php">Logout</a>
    </nav>

    <main>
        <div class="card">
            <h2>📌 Informasi Dashboard</h2>
            <p>Ini adalah halaman utama setelah login. Anda dapat mengakses semua fitur portofolio Anda melalui menu di atas.</p>
        </div>

        <div class="card">
            <h2>📊 Ringkasan</h2>
            <ul>
                <li>Jumlah Proyek: 5</li>
                <li>Nilai Rata-rata: 90</li>
                <li>Persentase Kehadiran: 98%</li>
            </ul>
        </div>
    </main>
</body>
</html>