<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/User.php";

class AuthController
{
    private $pdo;
    private $userModel;

    public function __construct($pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->pdo = $pdo;
        $this->userModel = new User($pdo);

        // auto login dari cookie kalau sessionnya kosong
        $this->autoLoginFromCookie();
    }

    // bagian form login
    public function loginForm(string $error = '')
    {
        $success = '';
        include __DIR__ . "/../views/auth/login.php";
    }

    // bagian proses login
    public function login()
    {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && $this->userModel->verifyPlainPassword($password, $user['password'])) {

            // buat session login
            $_SESSION['user'] = $user;

            // auto login dari cookie (remember_user)
            $token = base64_encode(json_encode([
                "email" => $user["email"]
            ]));

            setcookie("remember_user", $token, time() + (86400 * 30), "/", "", false, true);


            // menyimpan login histori (menyimpan semua user yang pernah login) //
            $history = [];

            if (isset($_COOKIE['login_history'])) {
                $decoded = json_decode($_COOKIE['login_history'], true);
                if (is_array($decoded)) {
                    $history = $decoded;
                }
            }

            // tambah email kalau belum ada di historynya
            if (!in_array($user["email"], $history)) {
                $history[] = $user["email"];
            }

            // simpan kembali ke cookie selama 30 hari
            setcookie("login_history", json_encode($history), time() + (86400 * 30), "/", "", false, true);


            // mengalihkan domain ke url lain secara otomatis sesuai role
            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: user/dashboard.php");
            }
            exit;
        }

        // jika loginnya gagal
        $error   = "Email atau password salah!";
        $success = '';
        include __DIR__ . "/../views/auth/login.php";
    }

    //  auto login dari cookie 
    public function autoLoginFromCookie()
    {
        // kalau sudah punya session: tidak perlu auto login
        if (isset($_SESSION['user'])) {
            return;
        }

        if (!isset($_COOKIE['remember_user'])) {
            return;
        }

        $data = json_decode(base64_decode($_COOKIE['remember_user']), true);

        if (!$data || !isset($data['email'])) {
            return;
        }

        // mencari user berdasarkan email
        $user = $this->userModel->findByEmail($data['email']);

        if ($user) {
            $_SESSION['user'] = $user;
        }
    }

    // bagian form register
    public function registerForm(string $error = '', string $success = '')
    {
        include __DIR__ . "/../views/auth/register.php";
    }

    // bagian proses register
    public function register()
    {
        $nama     = trim($_POST['nama'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $role     = "user";

        $existing = $this->userModel->findByEmail($email);

        if ($existing) {
            $error   = "Email sudah terdaftar!";
            $success = '';
            include __DIR__ . "/../views/auth/register.php";
            return;
        }

        $created = $this->userModel->createUser($nama, $email, $password, $role);

        if ($created) {
            $error   = '';
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $error   = "Terjadi kesalahan saat menyimpan data.";
            $success = '';
        }

        include __DIR__ . "/../views/auth/register.php";
    }

    // bagian logout
    public function logout()
    {
        // hapus session loginnya
        $_SESSION = [];
        session_destroy();

        // meghapus auto-login cookie
        setcookie("remember_user", "", time() - 3600, "/", "", false, true);

        // cookie login_history tidak dihapus karena harus menyimpan riwayat user yang pernah login

        header("Location: index.php");
        exit;
    }
}
