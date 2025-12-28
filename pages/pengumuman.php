<?php include "../includes/header.php"; ?>
<?php 
include "../admin/koneksi.php"; 
?>

<!-- Include CSS khusus pengumuman -->
<link rel="stylesheet" href="../assets/css/pengumuman1.css">

<section class="section-title">
    <h2>Pengumuman Kelas</h2>
    <p>Temukan informasi terbaru mengenai kegiatan, acara, dan aktivitas di 07SISE001.</p>
</section>

<section class="pengumuman-list">

<?php
// Ambil semua pengumuman dari database
$query = mysqli_query($conn, "SELECT * FROM pengumuman ORDER BY id DESC");

if (mysqli_num_rows($query) == 0) {
    echo "<p style='text-align:center;'>Belum ada pengumuman.</p>";
} else {
    while ($p = mysqli_fetch_assoc($query)) {
?>
        <div class="pengumuman-card">
            
            <!-- Tampilkan gambar jika ada -->
            <?php if (!empty($p['gambar'])) { ?>
                <img src="../assets/img/<?php echo $p['gambar']; ?>" alt="Gambar pengumuman">
            <?php } ?>

            <div class="card-text">
                <h3><?php echo $p['judul']; ?></h3>
                <p class="tanggal"><?php echo $p['tanggal']; ?></p>

                <!-- Deskripsi singkat -->
                <p>
                    <?php echo substr(strip_tags($p['isi']), 0, 120); ?>...
                </p>

                <!-- Tombol detail -->
                <a href="detail_pengumuman.php?id=<?php echo $p['id']; ?>" class="btn-detail">
                    Selengkapnya
                </a>
            </div>
        </div>
<?php 
    } 
}
?>

</section>

<?php include "../includes/footer.php"; ?>
