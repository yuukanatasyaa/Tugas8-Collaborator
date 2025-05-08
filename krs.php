<?php
include 'koneksi.php';

if (isset($_POST['ambil'])) {
    $npm = $_POST['npm'];
    $kodemk = $_POST['kodemk'];
    mysqli_query($koneksi, "INSERT INTO krs(mahasiswa_npm, matakuliah_kodemk) VALUES('$npm', '$kodemk')");
    echo "<div class='alert alert-success'>Mata kuliah berhasil diambil.</div>";
}

$mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
$matakuliah = mysqli_query($koneksi, "SELECT * FROM matakuliah");

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
?>

<form method="post" class="card card-body shadow-sm mb-4">
    <h3 class="mb-3">Ambil Mata Kuliah</h3>
    <div class="mb-3">
        <label class="form-label">Mahasiswa</label>
        <select name="npm" class="form-select">
            <?php while($m = mysqli_fetch_array($mahasiswa)) { ?>
                <option value="<?= $m['npm']; ?>"><?= $m['nama']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Mata Kuliah</label>
        <select name="kodemk" class="form-select">
            <?php while($mk = mysqli_fetch_array($matakuliah)) { ?>
                <option value="<?= $mk['kodemk']; ?>"><?= $mk['nama']; ?> (<?= $mk['jumlah_sks']; ?> SKS)</option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" name="ambil" class="btn btn-primary">Ambil</button>
</form>

<?php
$query = "
SELECT 
    krs.id, 
    mahasiswa.nama AS nama_mahasiswa, 
    matakuliah.nama AS nama_matakuliah,
    matakuliah.jumlah_sks
FROM krs 
JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm
JOIN matakuliah ON krs.matakuliah_kodemk = matakuliah.kodemk
";

$result = mysqli_query($koneksi, $query);
$no = 1;

echo "<h2>Data KRS</h2>";
echo "<table class='table table-striped table-bordered'>";
echo "<thead class='table-dark'><tr><th>No</th><th>Nama Lengkap</th><th>Mata Kuliah</th><th>Keterangan</th></tr></thead><tbody>";

while($data = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$data['nama_mahasiswa']."</td>";
    echo "<td>".$data['nama_matakuliah']."</td>";
    echo "<td><span class='text-primary fw-bold'>".$data['nama_mahasiswa']."</span> Mengambil Mata Kuliah <span class='text-danger fw-bold'>".$data['nama_matakuliah']."</span> (".$data['jumlah_sks']." SKS)</td>";
    echo "</tr>";
}

echo "</tbody></table>";
echo '
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
';
?>