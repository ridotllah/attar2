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
    <title>Berhasil Login</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>

    <?php
// File: index.php
// Simple PHP dashboard (no DB) with pages: Home, Nilai, Kehadiran, Jadwal, Pengaturan, Laporan
// Put this file in your webroot and create a file named styles.css (content provided below).

// Simple fake auth for demo
if (!isset($_SESSION['user'])) {
    // if login form submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
        // VERY SIMPLE: in production use hashed passwords + DB
        $_SESSION['user'] = htmlspecialchars($_POST['username']);
        header('Location: index.php');
        exit;
    }
}

// handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

// routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$pages = ['home','nilai','kehadiran','jadwal','pengaturan','laporan'];
if (!in_array($page, $pages)) $page = 'home';
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - SMKIT IBNUL QAYYIM</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php if (!isset($_SESSION['user'])): ?>
  <main class="login-page">
    <form class="card login-card" method="post" action="index.php">
      <h2>Masuk</h2>
      <label>Username
        <input type="text" name="username" required>
      </label>
      <label>Password
        <input type="password" name="password" required>
      </label>
      <div class="actions">
        <button type="submit">Login</button>
      </div>
      <p class="muted">Demo sederhana — tidak aman untuk produksi.</p>
    </form>
  </main>
<?php else: ?>
  <div class="app">
    <aside class="sidebar">
      <div class="brand">Ilmu Qayyim</div>
      <nav class="nav">
        <a href="?page=home" class="nav-item <?php echo $page==='home'?'active':''; ?>">Home</a>
        <a href="?page=nilai" class="nav-item <?php echo $page==='nilai'?'active':''; ?>">Nilai</a>
        <a href="?page=kehadiran" class="nav-item <?php echo $page==='kehadiran'?'active':''; ?>">Kehadiran</a>
        <a href="?page=jadwal" class="nav-item <?php echo $page==='jadwal'?'active':''; ?>">Jadwal</a>
        <a href="?page=laporan" class="nav-item <?php echo $page==='laporan'?'active':''; ?>">Laporan</a>
        <a href="?page=pengaturan" class="nav-item <?php echo $page==='pengaturan'?'active':''; ?>">Pengaturan</a>
      </nav>
      <div class="sidebar-foot">
        <span>Signed in as <strong><?php echo $_SESSION['user']; ?></strong></span>
        <a class="logout" href="?action=logout">Logout</a>
      </div>
    </aside>

    <section class="main">
      <header class="topbar">
        <h1><?php echo ucfirst($page); ?></h1>
        <div class="welcome">Welcome, <strong><?php echo $_SESSION['user']; ?></strong></div>
      </header>

      <div class="content">
        <?php
        // simple page contents
        switch($page) {
          case 'home':
            ?>
            <div class="grid">
              <div class="card">
                <h3>Ringkasan</h3>
                <p>Jumlah siswa: <strong>120</strong></p>
                <p>Rata-rata nilai: <strong>78.4</strong></p>
              </div>
              <div class="card">
                <h3>Notifikasi</h3>
                <ul>
                  <li>Rapat OSIS — Jumat, 10:00</li>
                  <li>Pengumpulan tugas — Senin</li>
                </ul>
              </div>
            </div>
            <?php
          break;

          case 'nilai':
            ?>
            <div class="card">
              <h3>Daftar Nilai (Contoh)</h3>
              <table class="table">
                <thead><tr><th>No</th><th>Nama</th><th>Mapel</th><th>Nilai</th></tr></thead>
                <tbody>
                  <tr><td>1</td><td>Asep</td><td>Matematika</td><td>85</td></tr>
                  <tr><td>2</td><td>Budi</td><td>Fisika</td><td>78</td></tr>
                </tbody>
              </table>
            </div>
            <?php
          break;

          case 'kehadiran':
            ?>
            <div class="card">
              <h3>Kehadiran Hari Ini</h3>
              <p>Hadir: 110 | Izin: 5 | Alfa: 5</p>
            </div>
            <?php
          break;

          case 'jadwal':
            ?>
            <div class="card">
              <h3>Jadwal Pelajaran</h3>
              <ol>
                <li>08:00 - 09:30: Matematika</li>
                <li>09:45 - 11:15: Bahasa Indonesia</li>
              </ol>
            </div>
            <?php
          break;

          case 'laporan':
?>
    <h3>Laporan Siswa</h3>

    <h4>Tambah Siswa Baru</h4>
    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td><label for="nama">Nama:</label></td>
                <td><input type="text" name="nama" id="nama" required></td>
            </tr>
            <tr>
                <td><label for="nis">NIS:</label></td>
                <td><input type="text" name="nis" id="nis" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email" required></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan:</label></td>
                <td>
                    <select name="jurusan" id="jurusan" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="gambar">Gambar Profil:</label></td>
                <td><input type="file" name="gambar" id="gambar" accept="image/*"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Tambah Siswa</button></td>
            </tr>
        </table>
    </form>

    <h4>Daftar Siswa</h4>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php
        $i = 1;
        $siswa = isset($siswa) ? $siswa : [];
        foreach ($siswa as $row) :
        ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row['id']; ?>">ubah</a>
                <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">hapus</a>
            </td>
            <td><img src="img/<?= htmlspecialchars($row['gambar']); ?>" width="50"></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= htmlspecialchars($row['nis']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= htmlspecialchars($row['jurusan']); ?></td>
        </tr>
        <?php $i++; endforeach; ?>
    </table>
<?php
    break;

          case 'pengaturan':
            ?>
            <div class="card">
              <h3>Pengaturan Akun</h3>
              <form>
                <label>Nama Lengkap
                  <input type="text" value="<?php echo $_SESSION['user']; ?>">
                </label>
                <label>Ubah Password
                  <input type="password">
                </label>
                <div class="actions"><button>Save</button></div>
              </form>
            </div>
            <?php
          break;
        }
        ?>
      </div>

      <footer class="footer">© SMKIT IBNUL QAYYIM — Ilmu Qayyim</footer>
    </section>
  </div>
<?php endif; ?>
</body>

   <div class="from">


   </div>
  
</html>

