<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Jika form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hari = $_POST['hari'];
    $kegiatan = $_POST['kegiatan'];
    $pj = $_POST['pj'];
    $jam = $_POST['jam'];

    $query = "INSERT INTO jadwal (hari, kegiatan, penanggung_jawab, jam) 
              VALUES ('$hari', '$kegiatan', '$pj', '$jam')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Jadwal berhasil ditambahkan!');
                window.location.href='jadwal.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan jadwal!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jadwal</title>
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

        .btn-submit {
            background:#f4c430; color:#333; padding:10px 15px;
            border:none; border-radius:8px; font-weight:bold; cursor:pointer;
        }

        .btn-submit:hover { background:#e2b325; }

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
    <h2>Tambah Kegiatan Baru</h2>

    <form action="" method="post">
        <label>Hari:</label>
        <select name="hari" required>
            <option value="">-- Pilih Hari --</option>
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
            <option>Sabtu</option>
        </select>

        <label>Kegiatan:</label>
        <input type="text" name="kegiatan" placeholder="Masukkan nama kegiatan" required>

        <label>Penanggung Jawab:</label>
        <input type="text" name="pj" placeholder="Nama Dosen" required>

        <label>Jam:</label>
        <input type="text" name="jam" placeholder="Contoh: 07.00 - 08.00" required>

        <button class="btn-submit" type="submit">Simpan</button>
        <a class="btn-back" href="jadwal.php">← Kembali</a>
    </form>
</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>

</body>
</html>
