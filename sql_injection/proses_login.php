<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $mode = $_POST['mode'] ?? 'rentan';

    if ($mode == 'rentan') {

        // 🔴 MODE RENTAN
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

    } else {

        // 🟢 MODE AMAN
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    if ($result && mysqli_num_rows($result) > 0) {

        echo "
        <html>
        <head><link rel='stylesheet' href='style.css'></head>
        <body>
            <div class='success-box'>
                <h2>✅ Login Berhasil ($mode)</h2>
                <p>Masuk ke dashboard...</p>
            </div>
            <script>
                setTimeout(function(){
                    window.location='dashboard.php';
                }, 2000);
            </script>
        </body>
        </html>
        ";
        exit;

    } else {

        echo "
        <html>
        <head><link rel='stylesheet' href='style.css'></head>
        <body>
            <div class='error-box'>
                <h2>❌ Login Gagal ($mode)</h2>
                <p>Coba lagi</p>
                <a href='login.php'>Kembali</a>
            </div>
        </body>
        </html>
        ";
        exit;
    }

} else {
    echo "Akses tidak valid";
}
?>