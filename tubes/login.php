<?php
session_start();
require_once 'koneksi.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $errors[] = "Email dan password wajib diisi.";
    } else {
        $stmt = $koneksi->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Arahkan sesuai role
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;
        } else {
            $errors[] = "Email atau password salah.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Pastibisa</title>
     
</head>
<body>
    
    <form action="login.php" method="POST">
     <div class="login-container">
    <div class="login-box">
        <h2>Login ke Pastibisa</h2>
        
        <?php if ($errors): ?>
        <div style="color:red;">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
            
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p class="daftar-link">Belum punya akun? <a href="daftar.php">Daftar</a></p>
    </div>
</div>
  </body>
  
  <!-- css login -->
  
  <style>
  
  
  /* Reset dasar */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
}

/* Kontainer utama */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Kotak login/daftar */
.login-box {
    background-color: #fff;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
}

.login-box h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}

/* Input form */
.login-box label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #333;
}

.login-box input[type="text"],
.login-box input[type="password"],
.login-box input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 15px;
}

/* Tombol */
.login-box button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    border: none;
    border-radius: 6px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.login-box button:hover {
    background-color: #0056b3;
}

/* Link ke daftar atau login */
.daftar-link {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.daftar-link a {
    color: #007bff;
    text-decoration: none;
}

.daftar-link a:hover {
    text-decoration: underline;
}
  </style>
</html>
