<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM profil WHERE id = 1");
$profil = mysqli_fetch_assoc($query);
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

    /* CONTENT */
    .content {
        padding: 30px;
        max-width: 900px;
        margin: auto;
    }

    h2 {
        color: #1e3d8f;
        margin-bottom: 25px;
        text-align: center;
    }

    /* BOX PROFIL */
    .profil-box {
        background: white;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        margin-bottom: 25px;
    }

    .profil-item {
        margin-bottom: 18px;
        font-size: 16px;
        color: #333;
    }

    .profil-label {
        font-weight: bold;
        color: #1e3d8f;
    }

    /* FOTO */
    .profil-foto {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    /* BUTTON */
    a.btn-edit {
        background: #f4c430;
        padding: 10px 16px;
        text-decoration: none;
        color: #333;
        border-radius: 10px;
        font-weight: bold;
    }

    a.btn-edit:hover {
        background: #e2b325;
    }

    footer {
        background: #1e3d8f;
        color: white;
        padding: 18px;
        text-align: center;
        margin-top: 40px;
    }
</style>

<div class="navbar">
    <div style="font-weight: bold;">Dashboard Admin</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="pengumuman.php">Pengumuman</a>
        <a href="jadwal.php">Jadwal Kegiatan</a>
        <a href="profil.php" class="active">Profil Kelas</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</div>

<div class="content">

    <h2>Profil Sekolah</h2>

    <div class="profil-box">

        <!-- FOTO -->
        <?php if (!empty($profil['foto'])) { ?>
            <img src="../assets/img/profil.png" "<?= $profil['foto'] ?>" class="profil-foto" alt="Foto Kelas">
        <?php } ?>

        <!-- Nama -->
        <div class="profil-item">
            <span class="profil-label">Nama Sekolah:</span><br>
            <?= nl2br(htmlspecialchars($profil['nama_kelas'])) ?>
        </div>

        <!-- Alamat -->
        <div class="profil-item">
            <span class="profil-label">Alamat:</span><br>
            <?= nl2br(htmlspecialchars($profil['alamat'])) ?>
        </div>

        <!-- Visi -->
        <div class="profil-item">
            <span class="profil-label">Visi:</span><br>
            <?= nl2br(htmlspecialchars($profil['visi'])) ?>
        </div>

        <!-- Misi -->
        <div class="profil-item">
            <span class="profil-label">Misi:</span><br>
            <?= nl2br(htmlspecialchars($profil['misi'])) ?>
        </div>

        <a href="edit_profil.php" class="btn-edit">✎ Edit Profil</a>

    </div>
</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>
