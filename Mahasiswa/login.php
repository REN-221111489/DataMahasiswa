<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        // cari user di database
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
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f2;
        }
        .login-box {
            width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            animation: fadeIn 0.6s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert {
            animation: slideDown 0.4s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .input-group button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="text-center mb-4 text-primary">Login Admin</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label><strong>Username</strong></label>
                <input type="text" class="form-control" name="username" 
                       value="<?= htmlspecialchars($username ?? '') ?>" 
                       placeholder="Masukkan username">
            </div>

            <div class="mb-3">
                <label><strong>Password</strong></label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password">
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">👁️</button>
                </div>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100 mt-2">Login</button>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
        });
    </script>
</body>
</html>
