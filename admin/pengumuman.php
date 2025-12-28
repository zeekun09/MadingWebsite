<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";
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

    .content {
        padding: 30px;
    }

    h2 {
        color: #1e3d8f;
        margin-bottom: 10px;
    }

    .btn-add {
        background: #f4c430;
        padding: 12px 16px;
        text-decoration: none;
        color: #333;
        border-radius: 10px;
        font-weight: bold;
    }
    .btn-add:hover {
        background: #e2b325;
    }

    .pengumuman-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 25px;
    }

    .pengumuman-card {
        width: 300px;
        background: white;
        border-radius: 14px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        overflow: hidden;
    }

    .pengumuman-card img {
        width: 100%;
        height: 170px;
        object-fit: cover;
    }

    .pengumuman-body {
        padding: 15px;
    }

    .pengumuman-body h3 {
        margin: 0;
        font-size: 18px;
        color: #1e3d8f;
    }

    .pengumuman-body p {
        font-size: 14px;
        color: #555;
        margin-top: 8px;
    }

    .action-btn {
        margin-top: 12px;
    }

    .btn-edit, .btn-delete {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        margin-right: 5px;
    }

    .btn-edit {
        background: #1e3d8f;
        color: white;
    }
    .btn-edit:hover { background: #162e6a; }

    .btn-delete {
        background: #cc3333;
        color: white;
    }
    .btn-delete:hover { background: #962424; }

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
        <a href="pengumuman.php" style="color:#f4c430;">Pengumuman</a>
        <a href="jadwal.php">Jadwal Kegiatan</a>
        <a href="profil.php">Profil Kelas</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</div>

<div class="content">
    <h2>Kelola Pengumuman</h2>
    <a class="btn-add" href="tambah_pengumuman.php">+ Tambah Pengumuman</a>

    <div class="pengumuman-grid">

        <?php
        $query = "SELECT * FROM pengumuman ORDER BY id DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 0) {
            echo "<p style='margin-top:20px;'>Belum ada pengumuman.</p>";
        }

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="pengumuman-card">
                <img src="../assets/img<?php echo $row['gambar']; ?>">

                <div class="pengumuman-body">
                    <h3><?php echo $row['judul']; ?></h3>
                    <p><?php echo substr($row['isi'], 0, 80); ?>...</p>

                    <div class="action-btn">

                        <a class="btn-edit" href="edit_pengumuman.php?id=<?php echo $row['id']; ?>">
                            Edit
                        </a>

                        <a class="btn-delete"
                           href="hapus_pengumuman.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </a>

                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>
