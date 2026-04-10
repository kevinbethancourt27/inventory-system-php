<?php
require_once __DIR__ . "/../../config/db.php";
$result = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            <h3 class="mb-4">Add Product</h3>

            <form action="../../controllers/productController.php" method="POST">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>">
                                <?= $row['name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" name="create" class="btn btn-success">Save</button>
                <a href="index.php" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>
</div>

</body>
</html>