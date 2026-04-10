<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            <h3>Login</h3>
            <?php
session_start();
?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

            <form action="../../controllers/authController.php" method="POST">

                <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                <button type="submit" name="login" class="btn btn-primary">Login</button>

            </form>

            <a href="register.php">Create account</a>

        </div>
    </div>
</div>

</body>
</html>