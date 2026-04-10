<?php
require_once __DIR__ . "/../config/db.php";

class Product {

  public static function getAll($search = "", $category = "") {
    global $conn;

    $sql = "SELECT products.*, categories.name AS category
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE 1";

    $params = [];
    $types = "";

    if (!empty($search)) {
        $sql .= " AND products.name LIKE ?";
        $params[] = "%" . $search . "%";
        $types .= "s";
    }

    if (!empty($category)) {
        $sql .= " AND products.category_id = ?";
        $params[] = $category;
        $types .= "i";
    }

    $stmt = $conn->prepare($sql);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt->get_result();
}

public static function create($name, $description, $price, $stock, $category_id) {
    global $conn;
if (empty($name) || empty($price)) {
    die("Required fields missing");
}
    $stmt = $conn->prepare("
        INSERT INTO products (name, description, price, stock, category_id)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssdii", $name, $description, $price, $stock, $category_id);

    if ($stmt->execute()) {
        header("Location: ../views/products/index.php");
    } else {
        die("Error: " . $stmt->error);
    }
}

    public static function delete($id) {
        global $conn;
       $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../views/products/index.php");
    }

    public static function getById($id) {
    global $conn;
    return $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();


}

public static function update($id, $name, $description, $price, $stock, $category_id) {
    global $conn;

    $stmt = $conn->prepare("
        UPDATE products 
        SET name=?, description=?, price=?, stock=?, category_id=?
        WHERE id=?
    ");

    $stmt->bind_param("ssdiis", $name, $description, $price, $stock, $category_id, $id);

    if ($stmt->execute()) {
        header("Location: ../views/products/index.php");
    } else {
        die("Error: " . $stmt->error);
    }
}
}
?>