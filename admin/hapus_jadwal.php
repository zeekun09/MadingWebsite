<?php
session_start();
include "koneksi.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Pastikan ID dikirim
if (!isset($_GET['id'])) {
    header("Location: jadwal.php");
    exit;
}

$id = $_GET['id'];

// Hapus data
$query = mysqli_query($conn, "DELETE FROM jadwal WHERE id='$id'");

if ($query) {
    echo "<script>
            alert('Kegiatan berhasil dihapus!');
            window.location.href='jadwal.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus kegiatan.');
            window.location.href='jadwal.php';
          </script>";
}
?>
