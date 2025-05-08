<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES('$npm', '$nama', '$jurusan', '$alamat')");
    echo "<div class='alert alert-success'>Data Mahasiswa berhasil ditambahkan.</div>";
}

$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

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
echo "<h2>Data Mahasiswa</h2>";
echo "<ul class='list-group mb-4'>";
while ($d = mysqli_fetch_array($data)) {
    echo "<li class='list-group-item'>" . $d['nama'] . " (" . $d['npm'] . ")</li>";
}
echo "</ul>";
?>

<form method="post" class="card card-body shadow-sm">
    <h3 class="mb-3">Tambah Mahasiswa</h3>
    <div class="mb-3">
        <label class="form-label">NPM</label>
        <input type="text" name="npm" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Jurusan</label>
        <select name="jurusan" class="form-select">
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Operasi">Sistem Operasi</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>
    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
</form>
<?php echo '
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
'; ?>