<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // mencari user berdasarkan email
    public function findByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // buat user baru (plain password)
    public function createUser(string $nama, string $email, string $password, string $role = 'user'): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (nama, email, password, role)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$nama, $email, $password, $role]);
    }

    // verifikasi password 
    public function verifyPlainPassword(string $inputPassword, string $storedPassword): bool
    {
        return $inputPassword === $storedPassword;
    }
}
