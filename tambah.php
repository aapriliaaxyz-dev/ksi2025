<?php
// File: tambah.php

// Kita BELUM punya koneksi.php di branch ini, jadi konek manual
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_praktikum_ksi';
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$koneksi) { die("Koneksi Gagal: " . mysqli_connect_error()); }

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $nim = htmlspecialchars(trim($_POST['nim']));
    $jurusan = htmlspecialchars(trim($_POST['jurusan']));

    if (!empty($nama) && !empty($nim) && !empty($jurusan)) {
        $sql = "INSERT INTO mahasiswa (nama, nim, jurusan) VALUES (?, ?, ?)";

        if ($stmt = $koneksi->prepare($sql)) {
            $stmt->bind_param("sss", $nama, $nim, $jurusan);

            if ($stmt->execute()) {
                header("Location: index.php?status=sukses");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $koneksi->error;
        }
    } else {
        echo "Semua kolom wajib diisi!";
    }
    $koneksi->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"><title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="index.php">Praktikum KSI</a></div></nav>
    <div class="container mt-4">
      <h2>Tambah Data Mahasiswa</h2>
      <a href="tambah.php" class="btn btn-primary mb-3">Tambah Data</a>
  <table class="table table-striped table-bordered mt-3">
      <a href="index.php" class="btn btn-secondary btn-sm mb-3">Kembali</a>
      <div class="card"><div class="card-body">
        <form action="tambah.php" method="POST">
          <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" required></div>
          <div class="mb-3"><label class="form-label">NIM</label><input type="text" class="form-control" name="nim" required></div>
          <div class="mb-3"><label class="form-label">Jurusan</label><input type="text" class="form-control" name="jurusan" required></div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div></div>
    </div>
  </body>
</html>