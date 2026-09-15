<?php
session_start(); // Must be the very first line!
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    $passwordMatches = $user && (password_verify($password, $user['password']) || hash_equals((string) $user['password'], $password));

    if ($passwordMatches) {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: user.php");
            exit();
        }
    } else {
        $error = "The username or password is not correct.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <canvas class="node-field" aria-hidden="true"></canvas>
    <header class="site-header">
        <a class="brand" href="login.php">Valencia 3A</a>
        <span class="mono">Account access</span>
    </header>
    <main class="auth-shell">
        <section class="intro">
            <span class="mono">01 / Welcome back</span>
            <h1>Sign in<br>to continue.</h1>
            <p>Enter your account details to open your workspace.</p>
        </section>
        <section class="form-panel">
            <h2>Account details</h2>
            <?php if ($error): ?><p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
            <form method="POST" autocomplete="on">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" autocomplete="username" required>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" autocomplete="current-password" required>
                <button class="button" type="submit">Sign in</button>
            </form>
        </section>
    </main>
    <script src="motion.js"></script>
</body>
</html>
