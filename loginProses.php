<?php
include "koneksi.php";  // Menghubungkan ke file koneksi database

// Pastikan data dikirimkan dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form login
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Periksa jika data tidak kosong
    if (!empty($username) && !empty($password)) {
        // Mempersiapkan query dengan parameter terikat
        $sql = "SELECT password, role FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Mengecek apakah username ditemukan
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stored_password = $user['password'];
            $role = $user['role'];

            // Debugging output
            echo "Username: " . htmlspecialchars($username) . "<br>";
            echo "Stored Password: " . htmlspecialchars($stored_password) . "<br>";
            echo "Entered Password: " . htmlspecialchars($password) . "<br>";

            // Memverifikasi password
            if ($password === $stored_password) {
                // Login berhasil
                echo "Anda berhasil login sebagai " . htmlspecialchars($role);
                echo "<a href='adminDashboard.html'>Dashboard</a>";
            } else {
                echo "Username atau password salah.";
                echo "<a href='loginForm.html'>Login Form</a>";
            }
        } else {
            echo "Username tidak ditemukan.";
            echo "<a href='loginForm.html'>Login Form</a>";
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
