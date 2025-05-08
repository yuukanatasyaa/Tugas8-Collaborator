<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $kodemk = $_POST['kodemk'];
    $nama = $_POST['nama'];
    $jumlah_sks = $_POST['jumlah_sks'];
    mysqli_query($koneksi, "INSERT INTO matakuliah VALUES('$kodemk', '$nama', '$jumlah_sks')");
    echo "<div class='alert alert-success'>Data Matakuliah berhasil ditambahkan.</div>";
}

$data = mysqli_query($koneksi, "SELECT * FROM matakuliah");

echo '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Kuliah App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="mahasiswa.php">Mahasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="matakuliah.php">Mata Kuliah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="krs.php">KRS</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

';
echo "<h2>Data Matakuliah</h2>";
echo "<ul class='list-group mb-4'>";
while ($d = mysqli_fetch_array($data)) {
    echo "<li class='list-group-item'>" . $d['nama'] . " (" . $d['jumlah_sks'] . " SKS)</li>";
}
echo "</ul>";
?>

<form method="post" class="card card-body shadow-sm">
    <h3 class="mb-3">Tambah Matakuliah</h3>
    <div class="mb-3">
        <label class="form-label">Kode MK</label>
        <input type="text" name="kodemk" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah SKS</label>
        <input type="number" name="jumlah_sks" class="form-control">
    </div>
    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
</form>
<?php echo '
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
'; ?>