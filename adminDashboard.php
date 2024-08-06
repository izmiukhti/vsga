<html>
    <body>
        <?php
        session_start();
        if ($_SESSION['status'] == 'login') {
            echo '<h1>Selamat Datang ' . $_SESSION['username'] . '</h1><br>';
            echo '<a href="sessionLogout.php">Logout</a>';
        }
        ?>
    </body>
</html>