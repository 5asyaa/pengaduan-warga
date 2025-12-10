<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/User.php";

// bagian auto login jika ada cookie remember_user
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_user'])) {

    $data = json_decode(base64_decode($_COOKIE['remember_user']), true);

    if ($data && isset($data['email'])) {

        $userModel = new User($pdo);
        $user = $userModel->findByEmail($data['email']);

        if ($user) {
            $_SESSION['user'] = $user;
        }
    }
}

// jika tetap belum login
if (!isset($_SESSION['user'])) {
    header("Location: /pengaduan-warga-project/public/index.php");
    exit;
}

// menyimpan info user yang sedang login
$role = $_SESSION['user']['role'];

function cekRole($allowedRoles = [])
{
    if (!in_array($_SESSION['user']['role'], $allowedRoles)) {
        echo "Akses ditolak!";
        exit;
    }
}

// simpan CSRF token di session kalau belum ada
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
