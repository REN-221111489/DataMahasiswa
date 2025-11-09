<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        $sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Username atau password salah!";
        }
    } else {
        $error = "⚠️ Silakan isi username dan password!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

    <div class="login-box">
        <h3 class="text-center mb-4 text-primary">Login Admin</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center fade-in"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label><strong>Username</strong></label>
                <input type="text" class="form-control" name="username" placeholder="Masukkan username" value="<?= htmlspecialchars($username ?? '') ?>">
            </div>
            <div class="mb-3 position-relative">
                <label><strong>Password</strong></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password">
                <span class="password-toggle" onclick="togglePassword()">👁️</span>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100 mt-3">Login</button>
        </form>
    </div>

    <script src="interaksi.js"></script>
</body>
</html>
