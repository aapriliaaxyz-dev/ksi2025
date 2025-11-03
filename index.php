<?php
// --- Bagian Koneksi Database ---
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_praktikum_ksi';

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
// --- Akhir Bagian Koneksi ---

// --- Bagian Logika SELECT ---
$sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
$result = mysqli_query($koneksi, $sql);
// --- Akhir Bagian Logika SELECT ---
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa - KSI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">Praktikum KSI</a>
      </div>
    </nav>

    <div class="container mt-4">
      <h2>Daftar Mahasiswa</h2>
      
      <table class="table table-striped table-bordered mt-3">
        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            <th scope="col">Jurusan</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $i = 1; ?>
            <?php while($mhs = mysqli_fetch_assoc($result)): ?>
              <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= htmlspecialchars($mhs["nama"]); ?></td>
                <td><?= htmlspecialchars($mhs["nim"]); ?></td>
                <td><?= htmlspecialchars($mhs["jurusan"]); ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center">Belum ada data mahasiswa.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php
// 3. Tutup koneksi
mysqli_close($koneksi);
?>