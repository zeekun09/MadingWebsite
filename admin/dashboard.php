<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
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
        background: #1e3d8f; /* biru kuat */
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
    
    /* LAYOUT */
    .content {
        padding: 30px;
    }

    /* CARD */
    .card-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .card {
        background: white;
        width: 280px;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .card h3 {
        margin: 0 0 10px;
        color: #1e3d8f;
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

    .btn {
        display: inline-block;
        padding: 10px 15px;
        background: #f4c430; /* kuning lembut sunflower */
        color: #333;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 8px;
    }

    .btn:hover {
        background: #e2b325;
    }

    /* FOOTER */
    footer {
        margin-top: 30px;
        padding: 18px;
        text-align: center;
        background: #1e3d8f;
        color: white;
    }
</style>

<!-- NAVBAR -->
<div class="navbar">
    <div style="font-weight: bold;">Dashboard Admin</div>
    <div>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="pengumuman.php">Pengumuman</a>
        <a href="jadwal.php">Jadwal Kegiatan</a>
        <a href="profil.php">Profil Kelas</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</div>

<div class="content">
    <h2 style="color:#1e3d8f;">Selamat Datang, <?php echo $_SESSION['username']; ?> 👋</h2>
    <p>Silakan kelola pengumuman, jadwal, dan profil kelas melalui menu dibawah ini. </p>

    <!-- CARD MENU -->
    <div class="card-container">
        <div class="card">
            <h3>Kelola Pengumuman</h3>
            <p>Tambah, edit, dan hapus pengumuman .</p>
            <a class="btn" href="pengumuman.php">Masuk</a>
        </div>

        <div class="card">
            <h3>Kelola Jadwal</h3>
            <p>Atur jadwal kegiatan kelas dengan mudah.</p>
            <a class="btn" href="jadwal.php">Masuk</a>
        </div>

        <div class="card">
            <h3>Profil Kelas</h3>
            <p>Edit visi, misi, dan informasi lainnya.</p>
            <a class="btn" href="profil.php">Masuk</a>
        </div>
    </div>
</div>

<footer>
    © 2025 Mading Digital Sistem Informasi 
</footer>
