# Project_SQL_injeksion

### Kode Project

### Data Base
```CREATE DATABASE keamanan_web;

USE keamanan_web;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO users (username, password) VALUES 
('admin', '12345'),
('user', '12345');
```


### Koneksi.php
```php
<?php
$conn = mysqli_connect("localhost", "root", "", "keamanan_web");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
```
### login.php
```
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login System</h2>

    <form method="POST" action="proses_login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="password" placeholder="Password" required>

        <select name="mode">
            <option value="rentan">Mode Rentan (SQL Injection)</option>
            <option value="aman">Mode Aman (Secure)</option>
        </select>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
```

### Proses_login.php

```<?php
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
```

### dashboard.php

```<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body style="font-family: Arial; text-align:center; margin-top:100px;">

<h2>🎉 Login Berhasil</h2>
<p>Selamat datang di dashboard</p>

</body>
</html>
```
### Style.css
```
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: white;
    padding: 30px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

h2 {
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #4facfe;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: #00c6ff;
}
.success-box {
    background: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    width: 300px;
    margin: 100px auto;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    border-top: 5px solid #28a745;
}

.error-box {
    background: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    width: 300px;
    margin: 100px auto;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    border-top: 5px solid red;
}

a {
    display: inline-block;
    margin-top: 10px;
    color: #007bff;
    text-decoration: none;
}
select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
}
```

### Hasil Project

**Halaman Login**
Halaman login memiliki form input username dan password serta pilihan mode sistem. Tampilan dibuat menggunakan CSS agar lebih menarik dan mudah digunakan.


<img width="795" height="540" alt="image" src="https://github.com/user-attachments/assets/61cbeede-2bc5-43ea-9ef4-dd7c39b52dd1" />


**Halaman Proses Login**
Saat login berhasil, sistem menampilkan notifikasi bahwa login berhasil dan kemudian mengarahkan pengguna ke dashboard secara otomatis. Jika login gagal, sistem menampilkan pesan kesalahan.

**Login Berhasil**

<img width="975" height="374" alt="image" src="https://github.com/user-attachments/assets/740d0d17-c72c-4bf7-bfb3-46b0c044546e" />

**Login Gagal**

<img width="728" height="389" alt="image" src="https://github.com/user-attachments/assets/17a59f02-ec23-4f9a-bebd-1a4ed25041ae" />



**Dashboard**


Dashboard merupakan halaman utama setelah login berhasil. Halaman ini menandakan bahwa proses autentikasi telah berhasil dilakukan.

<img width="557" height="185" alt="image" src="https://github.com/user-attachments/assets/5f4cb358-c833-4cc1-9f2c-731ff135d6d3" />


