<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User workspace</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <canvas class="node-field" aria-hidden="true"></canvas>
    <header class="site-header">
        <a class="brand" href="user.php">Valencia 3A</a>
        <nav class="nav">
            <span class="mono">User / <?php echo $username; ?></span>
            <a href="logout.php">Log out</a>
        </nav>
    </header>
    <main class="dashboard">
        <div class="dashboard-top">
            <div>
                <span class="mono">02 / Workspace</span>
                <h1>Good to see you,<br><?php echo $username; ?>.</h1>
            </div>
            <p>Your personal space is ready. Keep moving through the work that matters.</p>
        </div>
        <section class="dashboard-grid" aria-label="Workspace overview">
            <div class="stat"><span class="mono">Status</span><strong>Active</strong></div>
            <div class="stat"><span class="mono">Access</span><strong>User</strong></div>
            <div class="stat"><span class="mono">Session</span><strong>Open</strong></div>
        </section>
        <div class="action-row">
            <a class="button" href="logout.php">Log out</a>
        </div>
    </main>
    <script src="motion.js"></script>
</body>
</html>