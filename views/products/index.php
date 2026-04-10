<?php
require_once __DIR__ . "/../../models/Product.php";
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$products = Product::getAll($search, $category);
?>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

   <div class="d-flex justify-content-between mb-3">
    
    <h2>Inventory System</h2>

    <div>
        <a href="create.php" class="btn btn-primary">+ Add Product</a>

        <a href="../../controllers/authController.php?logout=1" 
           class="btn btn-danger">
            Logout
        </a>
    </div>

</div>

    <div class="card shadow">
        <div class="card-body">
        <?php
require_once __DIR__ . "/../../config/db.php";
$categories = $conn->query("SELECT * FROM categories");
?>

<form method="GET" class="row mb-3">

    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Search by name..."
               value="<?= $search ?>">
    </div>

    <div class="col-md-4">
        <select name="category" class="form-control">
            <option value="">All Categories</option>
            <?php while($c = $categories->fetch_assoc()): ?>
                <option value="<?= $c['id'] ?>"
                    <?= ($c['id'] == $category) ? 'selected' : '' ?>>
                    <?= $c['name'] ?>
                </option>
            <?php endwhile; ?>
            
        </select>
    </div>

    <div class="col-md-4">
        <button class="btn btn-primary">Search</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
    </div>

</form>
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($p = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?= $p['name'] ?></td>
                        <td>$<?= $p['price'] ?></td>
                        <td>
                            <span class="badge bg-<?= $p['stock'] > 5 ? 'success' : 'danger' ?>">
                                <?= $p['stock'] ?>
                            </span>
                        </td>
                        <td><?= $p['category'] ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../../controllers/productController.php?delete=1&id=<?= $p['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>