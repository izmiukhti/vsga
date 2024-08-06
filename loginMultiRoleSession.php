<?php
include "koneksi.php";  // Menghubungkan ke file koneksi database

// Mengambil data dari form login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Mencegah SQL Injection dengan menggunakan prepared statements
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$fechResult = $result->fetch_assoc();
$rowcount = $result->num_rows;

if ($rowcount > 0) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'login';

    // Mengarahkan pengguna berdasarkan role
    if ($fechResult['role'] == 'admin') {
        echo "Anda berhasil login";
        echo "<a href='adminDashboard.html'>Admin Dashboard</a>";
    } else if ($fechResult['role'] == 'user') {
        echo "Anda berhasil login";
        echo "<a href='userDashboard.html'>User Dashboard</a>";
    } else {
        echo "Peran tidak dikenali.";
        echo "<a href='loginForm.html'>Login</a>";
    }
} else {
    echo "Username atau password salah.";
    echo "<a href='loginForm.html'>Login</a>";
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
