<?php
session_start();
include "koneksi.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Cek ID
if (!isset($_GET['id'])) {
    header("Location: pengumuman.php");
    exit;
}

$id = $_GET['id'];

// Ambil data lama (untuk ambil nama file gambar)
$getData = mysqli_query($conn, "SELECT gambar FROM pengumuman WHERE id='$id'");
$data = mysqli_fetch_assoc($getData);

if (!$data) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href='pengumuman.php';
         </script>";
    exit;
}

// Path gambar
$gambarPath = "../uploads/" . $data['gambar'];

// Hapus dari database
$query = mysqli_query($conn, "DELETE FROM pengumuman WHERE id='$id'");

if ($query) {

    // Hapus file gambar jika ada
    if (file_exists($gambarPath)) {
        unlink($gambarPath);
    }

    echo "<script>
            alert('Pengumuman berhasil dihapus!');
            window.location.href='pengumuman.php';
         </script>";
} else {
    echo "<script>
            alert('Gagal menghapus pengumuman!');
            window.location.href='pengumuman.php';
         </script>";
}
?>
