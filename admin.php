<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

if (($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
    $denied = true;
} else {
    $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
    $denied = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $denied ? 'Access denied' : 'Admin workspace'; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <canvas class="node-field" aria-hidden="true"></canvas>
    <header class="site-header">
        <a class="brand" href="admin.php">Valencia 3A</a>
        <nav class="nav">
            <span class="mono">Admin / <?php echo $username; ?></span>
            <a href="logout.php">Log out</a>
        </nav>
    </header>
    <main class="dashboard">
        <?php if ($denied): ?>
            <span class="mono">403 / Restricted area</span>
            <h1>This space is<br>not yours.</h1>
            <p class="intro p">Your account does not have administrator access.</p>
            <div class="action-row"><a class="button" href="user.php">Back to workspace</a><a class="button secondary" href="logout.php">Log out</a></div>
        <?php else: ?>
            <div class="dashboard-top">
                <div>
                    <span class="mono">03 / Control room</span>
                    <h1>Welcome,<br><?php echo $username; ?>.</h1>
                </div>
                <p>System overview and account access, all in one place.</p>
            </div>
            <section class="dashboard-grid" aria-label="Administration overview">
                <div class="stat"><span class="mono">Status</span><strong>Online</strong></div>
                <div class="stat"><span class="mono">Access</span><strong>Admin</strong></div>
                <div class="stat"><span class="mono">Users</span><strong>Manage</strong></div>
            </section>
            <div class="action-row"><a class="button" href="logout.php">Log out</a></div>
        <?php endif; ?>
    </main>
    <script src="motion.js"></script>
</body>
</html>