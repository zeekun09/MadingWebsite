<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$pesan = "";

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];

    // Upload gambar
    $nama_file = "";
    if (!empty($_FILES['gambar']['name'])) {
        $nama_file = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // folder img harus ada
        move_uploaded_file($tmp, "../assets/img" . $nama_file);
    }

    // INSERT ke database
    $query = "INSERT INTO pengumuman (judul, isi, tanggal, gambar)
              VALUES ('$judul', '$isi', '$tanggal', '$nama_file')";

    if (mysqli_query($conn, $query)) {
        $pesan = "Pengumuman berhasil ditambahkan!";
    } else {
        $pesan = "Gagal menambah pengumuman: " . mysqli_error($conn);
    }
}
?>

<style>
    body {
        margin: 0;
        font-family: Arial;
        background: #f8f9fa;
    }

    /* NAVBAR */
    .navbar {
        background: #1e3d8f;
        padding: 15px 25px;
        color: white;
        font-size: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .navbar a {
        color: white;
        text-decoration: none;
        margin-left: 20px;
    }

    .navbar a.active {
    color: #f4c430;
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

    .container {
        width: 700px;
        background: white;
        margin: 30px auto;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.15);
    }

    h2 {
        color: #1e3d8f;
        margin-top: 0;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 15px;
    }

    input, textarea {
        width: 96%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-size: 15px;
        margin-top: 5px;
    }

    textarea {
        height: 130px;
        resize: vertical;
    }

    button {
        margin-top: 20px;
        padding: 12px 18px;
        font-size: 16px;
        background: #f4c430;
        color: #333;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background: #e2b325;
    }

    .success {
        background: #d2ffd2;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 15px;
        border-left: 5px solid #2f8f2f;
        color: #2f662f;
    }

    footer {
        margin-top: 40px;
        background: #1e3d8f;
        color: white;
        padding: 18px;
        text-align: center;
    }
</style>


<!-- NAVBAR -->
<div class="navbar">
    <div style="font-weight: bold;">Dashboard Admin</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="pengumuman.php" class="active">Pengumuman</a>
        <a href="jadwal.php">Jadwal Kegiatan</a>
        <a href="profil.php">Profil Kelas</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</div>


<div class="container">
    <h2>Tambah Pengumuman</h2>

    <?php if (!empty($pesan)) { ?>
        <div class="success"><?php echo $pesan; ?></div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Judul Pengumuman</label>
        <input type="text" name="judul" required>

        <label>Tanggal</label>
        <input type="date" name="tanggal" required>

        <label>Upload Gambar Pengumuman</label>
        <input type="file" name="gambar" accept="image/*" required>

        <label>Isi Pengumuman</label>
        <textarea name="isi" required></textarea>

        <button type="submit" name="submit">Simpan Pengumuman</button>
        <a class="btn-back" href="pengumuman.php">← Kembali</a>
    </form>

</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>
