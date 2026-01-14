<?php
function cek_admin() {
    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php");
        exit;
    }
}