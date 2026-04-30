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