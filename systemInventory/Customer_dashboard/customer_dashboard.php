<?php
    require "../Admin_dashboard/admin.php"; // gives us getProductsByCategory(), getCustomerOrders(), getCustomerOrderHistory(), and $conn
    $products = getProductsByCategory($conn);
    $orders = getCustomerOrders($conn);
    $orderHistory = getCustomerOrderHistory($conn);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboards</title>
    <link rel="stylesheet" href="../Admin_dashboard/admin.css">
</head>

<body>

<div class="parent">
    <div class="title">
        <h1>Customer Dashboard</h1>
    </div>

    <div class="menu">
        <h3>Order History</h3>
        <?php if (empty($orderHistory)): ?>
            <p>No past orders yet.</p>
        <?php else: ?>
            <?php foreach ($orderHistory as $item): ?>
                <div class="product-item">
                    <strong><?php echo htmlspecialchars($item['product_name']); ?></strong>
                    (<?php echo htmlspecialchars($item['category']); ?>)<br>
                    Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                    ₱<?php echo htmlspecialchars($item['price']); ?> each — Total: ₱<?php echo htmlspecialchars($item['total_price']); ?><br>
                    Status: <?php echo htmlspecialchars(ucfirst($item['status'])); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?><br>
        <button class="clearHistory">Clear Order History</button>
    </div>

    <div class="cat1">
        <h3>Frozen</h3>
        <?php foreach ($products["Frozen"] as $item): ?>
            <div class="product-item">
                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong><br>
                Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                ₱<?php echo htmlspecialchars($item['price']); ?><br>
                <input type="number" class="orderQty" min="1" max="<?php echo (int) $item['quantity']; ?>" value="1" style="width:50px;">
                <button class="orderProduct" data-id="<?php echo $item['id']; ?>">Order Product</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cat2">
        <h3>Pork</h3>
        <?php foreach ($products["Pork"] as $item): ?>
            <div class="product-item">
                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong><br>
                Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                ₱<?php echo htmlspecialchars($item['price']); ?><br>
                <input type="number" class="orderQty" min="1" max="<?php echo (int) $item['quantity']; ?>" value="1" style="width:50px;">
                <button class="orderProduct" data-id="<?php echo $item['id']; ?>">Order Product</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cat3">
        <h3>Beef</h3>
        <?php foreach ($products["Beef"] as $item): ?>
            <div class="product-item">
                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong><br>
                Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                ₱<?php echo htmlspecialchars($item['price']); ?><br>
                <input type="number" class="orderQty" min="1" max="<?php echo (int) $item['quantity']; ?>" value="1" style="width:50px;">
                <button class="orderProduct" data-id="<?php echo $item['id']; ?>">Order Product</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="addProduct">
        <h3>Hindi ko maisip gagawin dito</h3>
    </div>

    <div id="categoryTitle">
        <h2>Products by category</h2>
    </div>

    <div class="pending">
        <h3>Your Orders Status</h3>
        <?php if (empty($orders)): ?>
            <p>No pending orders.</p>
        <?php else: ?>
            <?php foreach ($orders as $item): ?>
                <div class="product-item">
                    <strong><?php echo htmlspecialchars($item['product_name']); ?></strong>
                    (<?php echo htmlspecialchars($item['category']); ?>)<br>
                    Qty: <?php echo htmlspecialchars($item['quantity']); ?><br>
                    ₱<?php echo htmlspecialchars($item['price']); ?> each — Total: ₱<?php echo htmlspecialchars($item['total_price']); ?><br>
                    Status: <?php echo htmlspecialchars(ucfirst($item['status'])); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        
    </div>
</div>

<script src="customer.js"></script>
</body>
</html>

<?php $conn->close(); ?>