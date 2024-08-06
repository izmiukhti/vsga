<?php
include "koneksi.php"; // Menghubungkan ke file koneksi database

// Pastikan data dikirimkan dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form login
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Periksa jika data tidak kosong
    if (!empty($username) && !empty($password)) {
        // Menghindari SQL Injection dengan menggunakan prepared statements
        $stmt = $pdo->prepare("SELECT password, role FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Mengecek apakah username ditemukan
        if ($user) {
            $stored_password = $user['password'];
            $role = $user['role'];

            // Verifikasi password
            if ($password === $stored_password) { // jika menggunakan hash, ganti dengan password_verify
                // Login berhasil
                switch ($role) {
                    case 'admin':
                        header('Location: adminDashboard.html');
                        exit();
                    case 'user':
                        header('Location: userDashboard.html');
                        exit();
                    default:
                        echo "Peran tidak dikenali.";
                        echo "<a href='loginForm.html'>Login</a>";
                        break;
                }
            } else {
                echo "Username atau password salah.";
                echo "<a href='loginForm.html'>Login</a>";
            }
        } else {
            echo "Username tidak ditemukan.";
            echo "<a href='loginForm.html'>Login</a>";
        }
    } else {
        echo "Username dan password harus diisi.";
    }

    // Menutup koneksi
    $pdo = null;
} else {
    echo "Form harus dikirim dengan metode POST.";
}
?>
