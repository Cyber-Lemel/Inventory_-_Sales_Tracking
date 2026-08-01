<?php
    require "../User_dashboard/user.php"; // gives us getProductsByCategory(), getPendingProducts(), and $conn
    $products = getProductsByCategory($conn);
    $pendingProducts = getPendingProducts($conn);
    require "../Sign-in/config.php"; // gives us $conn

    // ginamit ko nlng din dito yung sa user na admin na ngayon, may mga pinaltan nlng ako ok, remove nyo din to pag nag present kay sir
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../User_dashboard/user.css">
</head>
<body>

<div class="parent">
    <div class="title">
        <h1>Inventory Management System</h1>
    </div>

    <div class="menu">
        <h3>Menu</h3>
    </div>

    <div class="cat1">
        <h3>Frozen</h3>
        <?php foreach ($products["Frozen"] as $item): ?>
            <div class="product-item">
                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong><br>
                Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                ₱<?php echo htmlspecialchars($item['price']); ?>
                <button class="orderProduct" data-id="<?php echo $item['id']; ?>">Order product</button>
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
                <button class="orderProduct" data-id="<?php echo $item['id']; ?>">Order product</button>ton>
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
                <button class="orderProduct" data-id="<?php echo $item['id']; ?>">Order product</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="addProduct">
        
    </div>

    <div id="categoryTitle">
        <h2>Category</h2>
    </div>

    <div class="pending">
        <h3>Pending Orders</h3>
        <?php if (empty($pendingProducts)): ?>
            <p>No order yet</p>
        <?php else: ?>
            <?php foreach ($pendingProducts as $item): ?>
                <div class="product-item">
                    <strong><?php echo htmlspecialchars($item['product_name']); ?></strong>
                    (<?php echo htmlspecialchars($item['category']); ?>)<br>
                    Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                    ₱<?php echo htmlspecialchars($item['price']); ?><br>
                    <em>Waiting for approval of order</em>
                    <button class="cancelOrder" data-id="<?php echo $item['id']; ?>">Cancel order</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="addproduct.js"></script>
</body>
</html>

<?php $conn->close(); ?>
