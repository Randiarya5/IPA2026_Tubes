<?php
require_once 'koneksi.php';

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $role = 'user'; 

    $check_query = "SELECT email FROM users WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $message = "<div class='alert alert-danger'>Email sudah terdaftar!</div>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($koneksi, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, "sss", $email, $hashed_password, $role);

        if (mysqli_stmt_execute($stmt_insert)) {
            $message = "<div class='alert alert-success'>Akun berhasil dibuat. <a href='login.php'>Login sekarang</a></div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal daftar: " . mysqli_error($koneksi) . "</div>";
        }
        mysqli_stmt_close($stmt_insert);
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pastibisa</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }
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

        /* --- BAGIAN PENTING: AGAR LABEL MUNCUL --- */
        .login-box label {
            display: block;       /* Wajib: agar label punya baris sendiri */
            margin-bottom: 8px;   
            font-weight: bold;    /* Tulisan Tebal */
            color: #333;          
            text-align: left;     /* Rata kiri */
            font-size: 16px;      
        }

        .login-box input[type="text"],
        .login-box input[type="password"],
        .login-box input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px; 
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }
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
            font-weight: bold;
        }
        .login-box button:hover {
            background-color: #0056b3;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h2>Daftar Pastibisa</h2>
        
        <?php echo $message; ?>

        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Daftar</button>
        </form>

        <p class="login-link">Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</div>

</body>
</html>