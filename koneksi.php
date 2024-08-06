<!-- <?php
$dsn = 'mysql:host=localhost;dbname=tsa_web';
$user = 'username'; 
$pass = 'password';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?> -->

<?php
$servername = "localhost"; // atau 127.0.0.1
$username = "root";
$password = "";
$dbname = "tsa_web";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

