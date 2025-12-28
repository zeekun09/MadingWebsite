<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Pastikan ada ID
if (!isset($_GET['id'])) {
    header("Location: jadwal.php");
    exit;
}

$id = $_GET['id'];

// Ambil data jadwal berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM jadwal WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
            alert('Jadwal tidak ditemukan!');
            window.location.href='jadwal.php';
          </script>";
}

// Jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hari = $_POST['hari'];
    $kegiatan = $_POST['kegiatan'];
    $pj = $_POST['pj'];
    $jam = $_POST['jam'];

    $update = "UPDATE jadwal SET 
                hari='$hari', 
                kegiatan='$kegiatan', 
                penanggung_jawab='$pj', 
                jam='$jam'
               WHERE id='$id'";

    if (mysqli_query($conn, $update)) {
        echo "<script>
                alert('Jadwal berhasil diperbarui!');
                window.location.href='jadwal.php';
              </script>";
    } else {
        echo "<script>alert('Gagal mengupdate jadwal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal</title>
    <style>
        body { font-family: Arial; background:#f8f9fa; margin:0; }

        .navbar {
            background: #1e3d8f;
            padding: 15px 25px;
            color: white;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a { color:white; text-decoration:none; margin-left:20px; }
        .navbar a.active { color:#f4c430; }

        .content { padding:30px; }
        h2 { color:#1e3d8f; }

        form {
            background:white; padding:20px; border-radius:10px;
            max-width:500px; box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        input, select {
            width:100%; padding:10px; margin-bottom:15px;
            border-radius:6px; border:1px solid #ccc;
        }

        .btn-logout {
            background: #f5c400;
            padding: 8px 18px;
            color: #123c8b !important;
            border-radius: 25px;
            font-weight: bold;
        }

        .btn-logout:hover {
            background: #987e14ff;
        }

        .btn-submit {
            background:#1e3d8f; color:white; padding:10px 15px;
            border:none; border-radius:8px; font-weight:bold; cursor:pointer;
        }
        .btn-submit:hover { background:#162e6a; }

        footer {
            margin-top:40px; background:#1e3d8f; color:white;
            padding:18px; text-align:center;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div style="font-weight:bold;">Dashboard Admin</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="pengumuman.php">Pengumuman</a>
        <a href="jadwal.php" class="active">Jadwal Kegiatan</a>
        <a href="profil.php">Profil Kelas</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</div>

<div class="content">
    <h2>Edit Kegiatan</h2>

    <form action="" method="post">

        <label>Hari:</label>
        <select name="hari" required>
            <option <?= ($data['hari']=="Senin" ? "selected":"") ?>>Senin</option>
            <option <?= ($data['hari']=="Selasa" ? "selected":"") ?>>Selasa</option>
            <option <?= ($data['hari']=="Rabu" ? "selected":"") ?>>Rabu</option>
            <option <?= ($data['hari']=="Kamis" ? "selected":"") ?>>Kamis</option>
            <option <?= ($data['hari']=="Jumat" ? "selected":"") ?>>Jumat</option>
            <option <?= ($data['hari']=="Sabtu"  ? "selected":"") ?>>Sabtu</option>
        </select>

        <label>Kegiatan:</label>
        <input type="text" name="kegiatan" value="<?= $data['kegiatan'] ?>" required>

        <label>Penanggung Jawab:</label>
        <input type="text" name="pj" value="<?= $data['penanggung_jawab'] ?>" required>

        <label>Jam:</label>
        <input type="text" name="jam" value="<?= $data['jam'] ?>" required>

        <button class="btn-submit" type="submit">Update</button>
        <a class="btn-back" href="jadwal.php">← Kembali</a>
    </form>
</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>

</body>
</html>
