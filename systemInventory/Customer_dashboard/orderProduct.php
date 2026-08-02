<?php
require "../Sign-Up/config.php";

$productId = $_GET["id"] ?? "";
$requestedQty = $_GET["qty"] ?? 1;

if (!empty($productId) && is_numeric($productId) && is_numeric($requestedQty) && (int) $requestedQty > 0) {
    $productId = (int) $productId;
    $requestedQty = (int) $requestedQty;

    $conn->begin_transaction();

    try {
        // Lock the product row so stock checks stay accurate even with concurrent orders.
        $check = $conn->prepare("SELECT quantity FROM products_tbl WHERE id = ? AND status = 'accepted' FOR UPDATE");
        $check->bind_param("i", $productId);
        $check->execute();
        $check->bind_result($stockQty);
        $hasProduct = $check->fetch();
        $check->close();

        if (!$hasProduct) {
            throw new Exception("That product is no longer available to order.");
        }

        if ($stockQty < $requestedQty) {
            throw new Exception("Only {$stockQty} left in stock — you requested {$requestedQty}.");
        }

        // Reduce available stock by the requested amount.
        $decrement = $conn->prepare("UPDATE products_tbl SET quantity = quantity - ? WHERE id = ?");
        $decrement->bind_param("ii", $requestedQty, $productId);
        $decrement->execute();
        $decrement->close();

        // If this product already has a pending order, just add to its quantity
        // instead of creating a separate order row for the same product.
        $existing = $conn->prepare("SELECT id FROM orders_tbl WHERE product_id = ? AND status = 'pending'");
        $existing->bind_param("i", $productId);
        $existing->execute();
        $existing->store_result();

        if ($existing->num_rows > 0) {
            $existing->bind_result($orderId);
            $existing->fetch();
            $existing->close();

            $update = $conn->prepare("UPDATE orders_tbl SET quantity = quantity + ? WHERE id = ?");
            $update->bind_param("ii", $requestedQty, $orderId);
            $update->execute();
            $update->close();
        } else {
            $existing->close();

            $insert = $conn->prepare("INSERT INTO orders_tbl (product_id, quantity, status) VALUES (?, ?, 'pending')");
            $insert->bind_param("ii", $productId, $requestedQty);
            $insert->execute();
            $insert->close();
        }

        $conn->commit();
        header("Location: customer_dashboard.php");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        echo htmlspecialchars($e->getMessage());
    }

} else {
    echo "Invalid product ID or quantity.";
}

$conn->close();
?>