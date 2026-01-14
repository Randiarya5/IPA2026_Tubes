<?php
require_once 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $jumlah = $_POST['jumlah'];
    $pesan = htmlspecialchars($_POST['pesan']);

    $sql = "INSERT INTO donasi (nama, email, jumlah, pesan) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssds", $nama, $email, $jumlah, $pesan);

    if ($stmt->execute()) {
        echo "<script>alert('Terima kasih atas donasi Anda!'); window.location.href='index.php';</script>";
    } else {
        echo "Gagal menyimpan donasi: " . $koneksi->error;
    }
}
?>123


    <style>
        .form-donasi {
            max-width: 600px;
            margin: 40px auto;
            background-color: #f7f7f7;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-donasi input,
        .form-donasi textarea,
        .form-donasi select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-donasi button {
            background-color: #00a86b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-donasi button:hover {
            background-color: #007e57;
        }

        .success-message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-donasi">
    <h2>Form Donasi</h2>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
        <p class="success-message">Terima kasih, donasi Anda telah diterima!</p>
    <?php endif; ?>

    <form method="POST" action="donasi.php">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Jumlah Donasi (Rp)</label>
        <input type="number" name="jumlah" required>

        <label>Pilih Kampanye</label>
        <label for="kampanye">Pilih Kampanye</label>
            <select name="kampanye" id="kampanye" required>
                <option value="">-- Pilih Kampanye --</option>
                <option value="Bantu Pendidikan Anak Desa">Bantu Pendidikan Anak Desa</option>
                <option value="Peduli Korban Bencana Alam">Peduli Korban Bencana Alam</option>
                <option value="Donasi Kesehatan Lansia">Donasi Kesehatan Lansia</option>
                <option value="Dukung UMKM Lokal">Dukung UMKM Lokal</option>
                <option value="Bantu Operasi Anak Penderita Jantung">Bantu Operasi Anak Penderita Jantung</option>
                <option value="Bangun Perpustakaan di Pelosok">Bangun Perpustakaan di Pelosok</option>
                <option value="Donasi Air Bersih">Donasi Air Bersih</option>
                <option value="Sumbangan Sembako Ramadhan">Sumbangan Sembako Ramadhan</option>
                <option value="Bantu Biaya Sekolah Anak Yatim">Bantu Biaya Sekolah Anak Yatim</option>
                <option value="Pembangunan Rumah Ibadah Desa Terpencil">Pembangunan Rumah Ibadah Desa Terpencil</option>
</select>


        <label>Pesan (opsional)</label>
        <textarea name="pesan" rows="4"></textarea>

        <button type="submit">Kirim Donasi</button>
    </form>
</div>

</body>
</html>
