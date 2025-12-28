<?php include "../includes/header.php"; ?>
<?php include "../admin/koneksi.php"; ?>

<link rel="stylesheet" href="../assets/css/profil.css">

<?php
// Ambil data profil dari database
$query = mysqli_query($conn, "SELECT * FROM profil WHERE id = 1");
$profil = mysqli_fetch_assoc($query);
?>

<section class="section-title">
    <h2>PROFIL Kelas</h2>
    <p>Kenali lebih dekat sejarah, visi, misi, dan informasi Kelas 07SISE001.</p>
</section>

<section class="profil-container">

    <!-- FOTO SEKOLAH -->
    <div class="profil-foto">
        <?php if (!empty($profil['foto'])) { ?>
            <img src="../assets/img<?= $profil['foto']; ?>" alt="Foto Sekolah">
        <?php } else { ?>
            <img src="../assets/img/profil.png" alt="Foto Sekolah">
        <?php } ?>
    </div>

    <!-- NAMA & ALAMAT -->
    <div class="profil-box">
        <h3><?= htmlspecialchars($profil['nama_sekolah']); ?></h3>
        <p><b>Alamat:</b> <?= nl2br(htmlspecialchars($profil['alamat'])); ?></p>
    </div>

    <!-- SEJARAH SEKOLAH -->
    <div class="profil-box">
        <h3>Sejarah Kelas</h3>
        <p>
            Kelas 07SISE001 merupakan salah satu kelas dari 3 reguler, reguler CS dari semester 7
            Program Studi Sistem Informasi, Universitas Pamulang PSDKU Serang. Yang mana merupakan Angkatan Ketiga
            di Program Studi Sistem Informasi, Universitas Pamulang PSDKU Serang.
        </p>
    </div>

    <!-- VISI -->
    <div class="profil-box">
        <h3>Visi</h3>
        <p><?= nl2br(htmlspecialchars($profil['visi'])); ?></p>
    </div>

    <!-- MISI -->
    <div class="profil-box">
        <h3>Misi</h3>
        <p><?= nl2br(htmlspecialchars($profil['misi'])); ?></p>
    </div>

    <!-- TUJUAN SEKOLAH (STATIC) -->
    <div class="profil-box">
        <h3>Tujuan Kelas</h3>
        <ul>
            <li>Menumbuhkan mahasiswa yang beriman kepada Tuhan Yang Maha Esa, berintegritas, dan beretika akademik tinggi.</li>
            <li>Membekali mahasiswa dengan kompetensi keilmuan dan keterampilan profesional yang relevan dengan kebutuhan dunia kerja dan penelitian.</li>
            <li>Mendorong terbentuknya etos kerja akademik yang produktif, inovatif, kreatif, dan berdaya saing global.</li>
            <li>Mengembangkan kelas sebagai ruang pembelajaran kolaboratif berbasis riset dan inovasi yang mendukung daya saing universitas di tingkat nasional dan internasional.</li>
            <li>Mengintegrasikan nilai-nilai Profil Pelajar Pancasila serta semangat kebangsaan dalam kegiatan perkuliahan dan budaya akademik.</li>
        </ul>
    </div>

</section>

<?php include "../includes/footer.php"; ?>
