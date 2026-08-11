<?php
require_once __DIR__ . '/../app/Helpers/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = 'admin';
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Khaled Taha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-dark">
    <div class="card-custom" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <h3 class="text-white fw-bold mb-1">Admin Portal</h3>
            <span class="text-muted small">Khaled Taha Management</span>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger py-2 fs-6 mb-3"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label-custom">Username</label>
                <input type="text" name="username" class="form-control form-control-custom" placeholder="admin" required>
            </div>
            <div class="mb-4">
                <label class="form-label-custom">Password</label>
                <input type="password" name="password" class="form-control form-control-custom" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-custom-primary w-100 py-2">Login</button>
        </form>
    </div>
</body>
</html>
