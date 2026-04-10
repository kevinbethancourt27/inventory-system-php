<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            <h3>Register</h3>

            <form action="../../controllers/authController.php" method="POST">

                <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>

                <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                <button type="submit" name="register" class="btn btn-success">Register</button>

            </form>

            <a href="login.php">Already have an account?</a>

        </div>
    </div>
</div>

</body>
</html>