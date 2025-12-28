<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil data lama
$query = mysqli_query($conn, "SELECT * FROM profil WHERE id = 1");
$profil = mysqli_fetch_assoc($query);

// Jika tombol update ditekan
if (isset($_POST['update'])) {

    $nama   = mysqli_real_escape_string($conn, $_POST['nama_kelas']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $visi   = mysqli_real_escape_string($conn, $_POST['visi']);
    $misi   = mysqli_real_escape_string($conn, $_POST['misi']);

    $namaFileBaru = $profil['foto']; // default: tetap foto lama

    // Jika upload foto baru
    if (!empty($_FILES['foto']['name'])) {

        $namaFile   = $_FILES['foto']['name'];
        $tmpFile    = $_FILES['foto']['tmp_name'];

        $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
        $namaFileBaru = "profil_" . time() . "." . $ext;

        // Hapus foto lama
        if (!empty($profil['foto']) && file_exists("../assets/img" . $profil['foto'])) {
            unlink("../assets/img" . $profil['foto']);
        }

        // Upload foto baru
        move_uploaded_file($tmpFile, "../assets/img" . $namaFileBaru);
    }

    // Update DB
    $sql = "UPDATE profil SET 
                nama_sekolah = '$nama',
                alamat = '$alamat',
                visi = '$visi',
                misi = '$misi',
                foto = '$namaFileBaru'
            WHERE id = 1";

    if (mysqli_query($conn, $sql)) {
        header("Location: profil.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
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
    max-width: 750px;
    margin: 40px auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #1e3d8f;
    margin-bottom: 25px;
}

label {
    font-weight: bold;
    margin-bottom: 6px;
    display: block;
    color: #1e3d8f;
}

input, textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #bbb;
    margin-bottom: 18px;
    font-size: 15px;
}

textarea {
    height: 110px;
    resize: vertical;
}

.btn-submit {
    background: #1e3d8f;
    color: white;
    padding: 12px 16px;
    border-radius: 8px;
    cursor: pointer;
    border: none;
    width: 100%;
    font-size: 16px;
    font-weight: bold;
}

.btn-submit:hover {
    background: #162f6b;
}

.foto-preview {
    width: 100%;
    max-height: 250px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 15px;
}

footer {
        margin-top: 40px;
        background: #1e3d8f;
        color: white;
        padding: 18px;
        text-align: center;
}
</style>

<div class="navbar">
    <div style="font-weight: bold;">Dashboard Admin</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="pengumuman.php">Pengumuman</a>
        <a href="jadwal.php">Jadwal Kegiatan</a>
        <a href="profil.php" class="active">Profil Kelas</a>
        <a href="logout.php"class="btn-logout">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Edit Profil Kelas</h2>

    <form action="" method="post" enctype="multipart/form-data">

        <?php if (!empty($profil['foto'])) { ?>
            <img src="../assets/img<?= $profil['foto'] ?>" class="foto-preview">
        <?php } ?>

        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" value="<?= htmlspecialchars($profil['nama_sekolah']) ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" required><?= htmlspecialchars($profil['alamat']) ?></textarea>

        <label>Visi</label>
        <textarea name="visi" required><?= htmlspecialchars($profil['visi']) ?></textarea>

        <label>Misi</label>
        <textarea name="misi" required><?= htmlspecialchars($profil['misi']) ?></textarea>

        <label>Foto (Opsional)</label>
        <input type="file" name="foto" accept="image/*">

        <button type="submit" name="update" class="btn-submit">Update Profil</button>
    </form>
</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>

