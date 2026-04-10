<?php
require_once __DIR__ . "/../models/Product.php";

if (isset($_POST['create'])) {
    Product::create(
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['stock'],
        $_POST['category_id']
    );
}

if (isset($_GET['delete'])) {
    Product::delete($_GET['id']);
}

if (isset($_POST['update'])) {
    Product::update(
        $_POST['id'],
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['stock'],
        $_POST['category_id']
    );
}
?>