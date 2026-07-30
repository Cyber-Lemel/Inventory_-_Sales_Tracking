<?php
    // Admin dashboard content
    require "../Sign-in/config.php";

    if (!isset($_SESSION)) {
        session_start();
    }

    function getAllProducts($conn) {
        $sql = "SELECT id, product_name, category, price, quantity, status FROM products_tbl ORDER BY status ASC, id DESC";
        return $conn->query($sql);
    }

    $products = getAllProducts($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, Admin!</p>

    <table class="product-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($products && $products->num_rows > 0): ?>
            <?php while ($item = $products->fetch_assoc()): ?>
                <tr class="status-<?php echo htmlspecialchars($item['status']); ?>">
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                    <td>₱<?php echo htmlspecialchars($item['price']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td class="status-label"><?php echo htmlspecialchars(ucfirst($item['status'])); ?></td>
                    <td class="actions">
                        <?php if ($item['status'] === 'pending'): ?>
                            <button class="acceptProduct" data-id="<?php echo $item['id']; ?>">Accept</button>
                        <?php endif; ?>
                        <button class="updateProduct" data-id="<?php echo $item['id']; ?>">Update</button>
                        <button class="deleteProduct" data-id="<?php echo $item['id']; ?>">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No products found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

<script src="admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>