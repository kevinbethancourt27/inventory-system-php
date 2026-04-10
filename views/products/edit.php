<?php
require_once __DIR__ . "/../../models/Product.php";
require_once __DIR__ . "/../../config/db.php";

$product = Product::getById($_GET['id']);
$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            <h3 class="mb-4">Edit Product</h3>

            <form action="../../controllers/productController.php" method="POST">

                <!-- ID oculto -->
                <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" value="<?= $product['description'] ?>">
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <?php while($c = $categories->fetch_assoc()): ?>
                            <option value="<?= $c['id'] ?>"
                                <?= ($c['id'] == $product['category_id']) ? 'selected' : '' ?>>
                                <?= $c['name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="index.php" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>
</div>

</body>
</html>