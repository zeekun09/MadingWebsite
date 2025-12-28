<?php include "../includes/header.php"; ?>
<?php include "../admin/koneksi.php"; ?>

<link rel="stylesheet" href="../assets/css/jadwal.css">

<section class="section-title">
    <h2>Jadwal Kegiatan Kelas</h2>
    <p>Temukan informasi terbaru mengenai kegiatan, acara, dan aktivitas di Kelas 07SISE001</p>
</section>

<section class="jadwal-container">

<?php
// Ambil data dari database
$query = mysqli_query($conn, "SELECT * FROM jadwal ORDER BY 
    FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat'), jam ASC");

if (mysqli_num_rows($query) === 0) {
    echo "<p style='text-align:center;'>Belum ada jadwal kegiatan.</p>";
}

while ($j = mysqli_fetch_assoc($query)) {
?>
    <div class="jadwal-card">
        <h3><?php echo htmlspecialchars($j['kegiatan']); ?></h3>

        <p class="kegiatan">
            Penanggung Jawab: <strong><?php echo htmlspecialchars($j['penanggung_jawab']); ?></strong>
        </p>

        <p class="waktu">
            <?php echo htmlspecialchars($j['hari']); ?> — <?php echo htmlspecialchars($j['jam']); ?>
        </p>
    </div>
<?php } ?>

</section>

<?php include "../includes/footer.php"; ?>
