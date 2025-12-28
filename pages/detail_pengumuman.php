<?php 
include "../includes/header.php"; 
include "../admin/koneksi.php";

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data pengumuman dari database
$query = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id = $id");

// Jika tidak ada datanya
if (mysqli_num_rows($query) == 0) {
    echo "<section class='section-title'><h2>Pengumuman tidak ditemukan</h2></section>";
    include "../includes/footer.php";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<link rel="stylesheet" href="../assets/css/pengumuman1.css">

<!-- Section Judul -->
<section class="section-title">
    <h2><?php echo htmlspecialchars($data['judul']); ?></h2>
    <p><?php echo htmlspecialchars($data['tanggal']); ?></p>
</section>

<!-- Detail Pengumuman -->
<section class="detail-pengumuman">
    <img src="../assets/img<?php echo $data['gambar']; ?>" 
         alt="Gambar Pengumuman" 
         class="detail-img">

    <p class="detail-isi">
        <?php echo nl2br(htmlspecialchars($data['isi'])); ?>
    </p>

    <a href="pengumuman.php" class="btn-kembali">← Kembali</a>
</section>

<?php include "../includes/footer.php"; ?>
