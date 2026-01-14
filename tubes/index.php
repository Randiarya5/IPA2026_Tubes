<?php
include 'koneksi.php';


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastibisa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">Pastibisa</h1>
          <nav>
    <ul>
      
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#tentang">Tentang Kami</a></li>
        <li><a href="#kontak">Kontak</a></li>
         <li><a href="login.php">Login</a></li>
        <li><a href="daftar.php">Daftar</a></li>

        <?php if (isset($_SESSION['email'])): ?>
            <li><a href="donasi.php">Donasi</a></li>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="admin_dashboard.php">Dashboard Admin</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
    


        
    </ul>
</nav>

        </div>
    </header>

    <section class="beranda">
    <div class="beranda-konten">
        <h2>Selamat Datang di Pastibisa</h2>
        <p>
            Pastibisa adalah platform donasi online yang memudahkan Anda untuk membantu sesama.
            Kami percaya bahwa setiap orang bisa berbagi dan memberi dampak positif bagi masyarakat.
        </p>
        <a href="#kampanye" class="btn-donasi">Donasi Sekarang</a>
    </div>
</section>

    
  <!-- ======= Tentang Kami ======= -->
<section class="tentang-kami" id="tentang">
  <div class="container">
    <h1>Tentang Kami</h1>
    <p><strong>Pastibisa</strong> Pastibisa adalah platform donasi online yang menghubungkan orang-orang dermawan dengan berbagai kampanye sosial, kemanusiaan, dan pendidikan di seluruh Indonesia. Melalui teknologi yang mudah diakses, kami memudahkan siapa saja untuk memberi bantuan secara transparan, cepat, dan aman.</p>
    
    <h2>Misi Kami</h2>
    <ul>
        <li>Menyediakan Platform Donasi yang Transparan dan Akuntabel Kami berkomitmen untuk menjaga kepercayaan publik dengan menampilkan laporan perkembangan donasi secara terbuka dan jujur, serta memastikan setiap dana yang dikumpulkan disalurkan tepat sasaran.</li>
        <li>Mendorong Partisipasi Sosial dari Semua Kalangan Pastibisa ingin menjadi ruang inklusif bagi siapa pun—baik individu, komunitas, maupun lembaga—untuk dapat ikut serta dalam aksi sosial melalui donasi, kampanye, atau dukungan moral.
        <li>Menghubungkan Donatur dan Penerima Manfaat Secara Langsung dan Efektif Dengan sistem yang mudah diakses dan efisien, kami memudahkan proses penyaluran bantuan agar tepat guna, tepat waktu, dan membawa dampak nyata bagi para penerima manfaat.</li>
        <li>Mengedukasi Masyarakat tentang Kepedulian Sosial dan Nilai Berbagi Kami percaya bahwa kesadaran sosial tumbuh dari pengetahuan. Oleh karena itu, Pastibisa juga aktif dalam mengedukasi masyarakat tentang isu-isu kemanusiaan, solidaritas, dan pentingnya peran bersama dalam menciptakan perubahan.</li>
        <li>Berinovasi Secara Berkelanjutan untuk Mempermudah Aksi Kebaikan Kami terus mengembangkan fitur dan teknologi yang memudahkan pengguna dalam menjelajahi kampanye, melakukan donasi, serta memantau dampaknya secara langsung.</li>
      
    </ul>

    <h2>Visi Kami</h2>
    <p>Mewujudkan ekosistem digital donasi yang transparan, aman, dan memberdayakan, di mana setiap individu dari berbagai latar belakang dapat berkontribusi dalam menciptakan perubahan sosial yang bermakna dan berkelanjutan di seluruh penjuru Indonesia.
        Kami percaya bahwa kekuatan kebaikan dapat datang dari siapa saja, kapan saja, dan dalam bentuk apa pun. Dengan teknologi dan kolaborasi, Pastibisa bertujuan menjadi jembatan kepercayaan antara mereka yang membutuhkan dan mereka yang ingin membantu, tanpa batasan geografis maupun sosial.</p>
  </div>
</section>
  <main class="container">
    <h2>Kampanye Donasi Terbaru</h2>

    <!-- Search box -->
    <form action="index.php" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Cari kampanye..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Cari</button>
    </form>
    <?php if (!isset($_GET['semua'])): ?>
        <div style="text-align: center; margin-top: 30px;">
    <a href="index.php?semua=true" class="lihat-semua-btn">Lihat Semua Kampanye</a>
</div>
<?php endif; ?>
    

    <div class="kampanye" id="kampanye">
        <?php

        $kampanye = [
            ["judul" => "Bantu Pendidikan Anak Desa", "deskripsi" => "Mari bantu anak-anak desa mendapatkan akses pendidikan yang layak...", "gambar" => "img/Bantu Pendidikan Anak Desa.jpg"],
            ["judul" => "Peduli Korban Bencana Alam", "deskripsi" => "Bersama kita ringankan beban saudara-saudara kita yang terdampak...", "gambar" => "img/Peduli Korban Bencana Alam.jpg"],
            ["judul" => "Donasi Kesehatan Lansia", "deskripsi" => "Bantu lansia mendapatkan pengobatan dan perawatan yang mereka butuhkan...", "gambar" => "img/Donasi Kesehatan Lansia.jpg"],
            ["judul" => "Dukung UMKM Lokal", "deskripsi" => "Berikan bantuan modal dan pelatihan kepada pelaku usaha kecil di desa.", "gambar" => "img/Dukung UMKM Lokal.jpg"],
            ["judul" => "Bantu Operasi Anak Penderita Jantung", "deskripsi" => "Bantu biaya operasi anak-anak yang menderita kelainan jantung bawaan.", "gambar" => "img/Bantu Operasi Anak Penderita Jantung.jpg"],
            ["judul" => "Bangun Perpustakaan di Pelosok", "deskripsi" => "Ajak anak-anak daerah terpencil mengenal buku dengan membangun perpustakaan.", "gambar" => "img/Bangun Perpustakaan di Pelosok.jpg"],
            ["judul" => "Donasi Air Bersih", "deskripsi" => "Wujudkan akses air bersih untuk warga daerah kekeringan ekstrem.", "gambar" => "img/Donasi Air Bersih.jpg"],
            ["judul" => "Sumbangan Sembako Ramadhan", "deskripsi" => "Bantu keluarga prasejahtera mendapatkan kebutuhan pokok di bulan Ramadhan.", "gambar" => "img/Sumbangan Sembako Ramadhan.jpg"],
            ["judul" => "Bantu Biaya Sekolah Anak Yatim", "deskripsi" => "Mari bantu anak-anak yatim melanjutkan sekolah mereka dengan biaya pendidikan yang layak.", "gambar" => "img/Bantu Biaya Sekolah Anak Yatim.jpg"],
            ["judul" => "Pembangunan Rumah Ibadah Desa Terpencil", "deskripsi" => "Dukung pembangunan masjid dan gereja untuk masyarakat di daerah pelosok.", "gambar" => "img/masjid.jpg"]

];


        // Filter berdasarkan keyword
        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $keyword = strtolower($_GET['search']);
            $kampanye = array_filter($kampanye, function($item) use ($keyword) {
                return strpos(strtolower($item['judul']), $keyword) !== false || strpos(strtolower($item['deskripsi']), $keyword) !== false;
            });
        }

        // Tampilkan hasil
        $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
        if ($search !== '') {
        $result = mysqli_query($koneksi, "SELECT * FROM kampanye WHERE judul LIKE '%$search%' OR deskripsi LIKE '%$search%' ORDER BY id DESC");
        } else {
        $result = mysqli_query($koneksi, "SELECT * FROM kampanye ORDER BY id DESC");
}

        while ($k = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
            echo "<img src='img/{$k['gambar']}' alt='{$k['judul']}'>";
            echo "<h3>{$k['judul']}</h3>";
            echo "<p>{$k['deskripsi']}</p>";
            echo "<a href='donasi.php'>Donasi Sekarang</a>";
            echo "</div>";
}


        if (empty($kampanye)) {
            echo "<p>Tidak ada kampanye yang sesuai dengan pencarian Anda.</p>";
        }

        // Filter kampanye berdasarkan pencarian jika ada
   if (isset($_GET['search']) && $_GET['search'] !== '') {
    $keyword = strtolower($_GET['search']);
    $kampanye = array_filter($kampanye, function ($item) use ($keyword) {
        return strpos(strtolower($item['judul']), $keyword) !== false || strpos(strtolower($item['deskripsi']), $keyword) !== false;
    });
    } elseif (!isset($_GET['semua'])) 
    // Jika tidak dalam mode 'lihat semua', hanya tampilkan 3
    $kampanye = array_slice($kampanye, 0, 3);

        ?>
        
    </div>
</main>

<section class="kontak" id="kontak">
    <div class="kontak-container">
        <h2>Hubungi Kami</h2>
        <p>Jika Anda memiliki pertanyaan atau butuh bantuan, silakan isi form di bawah ini.</p>
        <?php
        if (isset($_GET['pesan']) && $_GET['pesan'] === 'terkirim') {
            echo "<p style='color: green;'>Pesan Anda berhasil dikirim!</p>";
        }
        ?>
        <form action="https://formspree.io/f/xqabqybz" method="POST" class="form-kontak">
            <input type="text" name="nama" placeholder="Nama Anda" required>
            <input type="email" name="email" placeholder="Email Anda" required>
            <textarea name="pesan" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
            <button type="submit">Kirim Pesan</button>
        </form>
    </div>
</section>


       
    <footer>
        <div class="container">
            &copy; 2025 Pastibisa. Semua hak cipta dilindungi. Bersama kita bisa membawa perubahan.</p>
        </div>
    </footer>
        </body>
</html>