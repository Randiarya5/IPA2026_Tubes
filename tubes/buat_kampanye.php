<?php
session_start();
include 'koneksi.php';

// 1. Cek Login & Role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$message = ""; // Variabel pesan error/sukses

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    
    // Ambil info file
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];

    // 2. Validasi Ekstensi Gambar (Security)
    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        $message = "<script>alert('Yang anda upload bukan gambar!');</script>";
    } 
    // 3. Cek Ukuran File (Max 2MB)
    else if ($ukuranFile > 2000000) { 
        $message = "<script>alert('Ukuran gambar terlalu besar! (Max 2MB)');</script>";
    } 
    else {
        // 4. Generate Nama File Baru (Agar tidak duplikat/ditimpa)
        $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
        $folderTujuan = 'img/' . $namaFileBaru;

        // Pastikan folder img ada
        if (!is_dir('img')) {
            mkdir('img', 0777, true);
        }

        // Upload file
        if (move_uploaded_file($tmpName, $folderTujuan)) {
            // 5. Simpan ke DB menggunakan Prepared Statement (Anti SQL Injection)
            $query = "INSERT INTO kampanye (judul, deskripsi, gambar) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $query);
            
            // "sss" artinya 3 data bertipe String
            mysqli_stmt_bind_param($stmt, "sss", $judul, $deskripsi, $namaFileBaru);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Kampanye berhasil dibuat!'); window.location='index.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan ke database!');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Gagal upload gambar!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kampanye</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .form-container {
            background: #fff;
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        /* Box-sizing fix agar padding tidak membuat input melebar */
        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box; /* PENTING */
        }

        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .form-container button:hover {
            background-color: #218838;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
        }
        
        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Buat Kampanye Baru</h2>
        <?php echo $message; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Kampanye</label>
                <input type="text" id="judul" name="judul" placeholder="Contoh: Bantuan Bencana Alam" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan detail kampanye..." required></textarea>
            </div>

            <div class="form-group">
                <label for="gambar">Upload Gambar (Max 2MB)</label>
                <input type="file" id="gambar" name="gambar" accept=".jpg, .jpeg, .png" required>
            </div>

            <button type="submit">Buat Kampanye</button>
        </form>
        
        <a href="admin_dashboard.php" class="btn-back">Kembali ke Dashboard</a>
    </div>
</body>
</html>