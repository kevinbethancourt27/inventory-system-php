<?php
require_once __DIR__ . "/../config/db.php";
session_start();

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        header("Location: ../views/auth/login.php");
    } else {
        die("Error: " . $stmt->error);
    }
}

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = $user;

        header("Location: ../views/products/index.php");
    } else {
       $_SESSION['error'] = "Invalid email or password";
header("Location: ../views/auth/login.php");
exit;
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../views/auth/login.php");
}