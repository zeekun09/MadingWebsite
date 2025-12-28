<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID pengumuman dari URL
$id = $_GET['id'];

// Ambil data lama dari database
$query = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id = '$id'");
$pengumuman = mysqli_fetch_assoc($query);

// Jika tidak ditemukan
if (!$pengumuman) {
    die("Data pengumuman tidak ditemukan!");
}

// Proses UPDATE
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $isi = $_POST['isi'];

    // Cek apakah gambar baru diupload
    if (!empty($_FILES['gambar']['name'])) {
        $nama_file = time() . "_" . $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // Upload file
        move_uploaded_file($tmp, "../assets/img" . $nama_file);

        // Hapus gambar lama (optional)
        if (!empty($pengumuman['gambar']) && file_exists("../assets/img" . $pengumuman['gambar'])) {
            unlink("../assets/img" . $pengumuman['gambar']);
        }

        $gambar_baru = $nama_file;
    } else {
        // Tetap gunakan yang lama
        $gambar_baru = $pengumuman['gambar'];
    }

    // Update database
    mysqli_query($conn, "
        UPDATE pengumuman SET
            judul = '$judul',
            tanggal = '$tanggal',
            isi = '$isi',
            gambar = '$gambar_baru'
        WHERE id = '$id'
    ");

    header("Location: pengumuman.php");
    exit;
}
?>

<style>
    body {
        margin: 0;
        font-family: Arial;
        background: #f8f9fa;
    }

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

    .preview-img {
        margin-top: 15px;
        width: 180px;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
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
    <h2>Edit Pengumuman</h2>

    <?php if (!empty($pesan)) { ?>
        <div class="success"><?php echo $pesan; ?></div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <label>Judul Pengumuman</label>
        <input type="text" name="judul" value="<?php echo $pengumuman['judul']; ?>" required>

        <label>Tanggal</label>
        <input type="date" name="tanggal" value="<?php echo $pengumuman['tanggal']; ?>" required>

        <label>Gambar Saat Ini</label><br>
        <img class="preview-img" src="..assets/img<?php echo $pengumuman['gambar']; ?>">

        <label>Ganti Gambar (Opsional)</label>
        <input type="file" name="gambar" accept="image/*">

        <label>Isi Pengumuman</label>
        <textarea name="isi" required><?php echo $pengumuman['isi']; ?></textarea>

        <button type="submit" name="submit">Update Pengumuman</button>
        
    </form>

</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>
