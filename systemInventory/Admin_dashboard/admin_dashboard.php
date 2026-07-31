<?php
    require "admin.php"; // gives us getProductsByCategory(), getPendingProducts(), and $conn
    $products = getProductsByCategory($conn);
    $pendingProducts = getPendingProducts($conn);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

<div class="parent">
    <div class="title">
        <h1>Inventory Management System</h1>
    </div>

    <div class="menu">
        <h3>Sales</h3>
    </div>

    <div class="cat1">
        <h3>Frozen</h3>
        <?php foreach ($products["Frozen"] as $item): ?>
            <div class="product-item">
                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong><br>
                Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                ₱<?php echo htmlspecialchars($item['price']); ?>
                <button class="deleteProduct" data-id="<?php echo $item['id']; ?>">Delete product</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cat2">
        <h3>Pork</h3>
        <?php foreach ($products["Pork"] as $item): ?>
            <div class="product-item">
                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong><br>
                Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                ₱<?php echo htmlspecialchars($item['price']); ?>
                <button class="deleteProduct" data-id="<?php echo $item['id']; ?>">Delete product</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cat3">
        <h3>Beef</h3>
        <?php foreach ($products["Beef"] as $item): ?>
            <div class="product-item">
                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong><br>
                Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                ₱<?php echo htmlspecialchars($item['price']); ?>
                <button class="deleteProduct" data-id="<?php echo $item['id']; ?>">Delete product</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="addProduct">
        <h3>Add Product</h3>
        <button id="addProduct">Add product</button>
        
    </div>

    <div id="categoryTitle">
        <h2>Category</h2>
    </div>

    <div class="pending">
        <h3>Orders</h3>
        <?php if (empty($pendingProducts)): ?>
            <p>No pending orders.</p>
        <?php else: ?>
            <?php foreach ($pendingProducts as $item): ?>
                <div class="product-item">
                    <strong><?php echo htmlspecialchars($item['product_name']); ?></strong>
                    (<?php echo htmlspecialchars($item['category']); ?>)<br>
                    Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                    ₱<?php echo htmlspecialchars($item['price']); ?><br>
                    <button class="acceptOrder" data-id="<?php echo $item['id']; ?>">Accept</button>
                    <button class="rejectOrder" data-id="<?php echo $item['id']; ?>">Reject</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="Product.js"></script>
</body>
</html>

<?php $conn->close(); ?>