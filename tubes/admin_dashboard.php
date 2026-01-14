<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Pastibisa</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat Datang, Admin!</h1>
        <p>Halo, <?php echo $_SESSION['email']; ?> 👋</p>

        <div class="button-group">
            <a href="buat_kampanye.php" class="btn">➕ Buat Kampanye Baru</a>
            <a href="index.php" class="btn">🌐 Lihat Website</a>
            <a href="logout.php" class="btn logout">🚪 Logout</a>
        </div>
    </div>
</body>
</html>

<style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f2f4f8;
    margin: 0;
    padding: 0;
}

.dashboard-container {
    max-width: 700px;
    margin: 100px auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
    text-align: center;
}

.dashboard-container h1 {
    margin-bottom: 10px;
    color: #2c3e50;
}

.dashboard-container p {
    color: #555;
    margin-bottom: 30px;
}

.button-group {
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: center;
}

.btn {
    text-decoration: none;
    padding: 12px 25px;
    font-size: 16px;
    background-color: #007bff;
    color: #fff;
    border-radius: 8px;
    transition: 0.3s ease;
    width: 80%;
    max-width: 300px;
    text-align: center;
}

.btn:hover {
    background-color: #0056b3;
}

.btn.logout {
    background-color: #dc3545;
}

.btn.logout:hover {
    background-color: #b02a37;
}

</style>
