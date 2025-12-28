<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Ambil semua jadwal kegiatan
$query = "SELECT * FROM jadwal ORDER BY id DESC";
$result = mysqli_query($conn, $query);
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
}
.navbar a { color: white; text-decoration: none; margin-left: 20px; }
.navbar a.active { color: #f4c430; }

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

.content { padding: 30px; }
h2 { color: #1e3d8f; }
.btn-add {
    background: #f4c430;
    padding: 12px 16px;
    text-decoration: none;
    color: #333;
    border-radius: 10px;
    font-weight: bold;
}
.btn-add:hover { background: #e2b325; }
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}
th { background: #1e3d8f; color: white; }

.btn-edit {
    padding: 6px 10px;
    background: #1e3d8f;
    color: white;
    border-radius: 6px;
    text-decoration: none;
}

.btn-edit:hover {
    background: #132c70ff;
}

.btn-delete {
    padding: 6px 10px;
    background: #cc3333;
    color: white;
    border-radius: 6px;
    text-decoration: none;
}

.btn-delete:hover {
    background: #791212ff;
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
        <a href="jadwal.php" class="active">Jadwal Kegiatan</a>
        <a href="profil.php">Profil Kelas</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</div>

<div class="content">
    <h2>Kelola Jadwal Kegiatan Kelas</h2>

    <a href="tambah_jadwal.php" class="btn-add">+ Tambah Kegiatan</a>

    <table>
        <tr>
            <th>No</th>
            <th>Hari</th>
            <th>Kegiatan</th>
            <th>Penanggung Jawab</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>".$no++."</td>
                <td>".$row['hari']."</td>
                <td>".$row['kegiatan']."</td>
                <td>".$row['penanggung_jawab']."</td>
                <td>".$row['jam']."</td>
                <td>
                    <a class='btn-edit' href='edit_jadwal.php?id=".$row['id']."'>Edit</a>
                    <a class='btn-delete' href='hapus_jadwal.php?id=".$row['id']."' onclick=\"return confirm('Hapus kegiatan ini?')\">Hapus</a>
                </td>
            </tr>
            ";
        }
        ?>
    </table>
</div>

<footer>
    © 2025 Mading Digital Sistem Informasi
</footer>
