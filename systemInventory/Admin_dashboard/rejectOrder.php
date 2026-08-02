<?php
require "../Sign-Up/config.php";

$orderId = $_GET["id"] ?? "";

if (!empty($orderId) && is_numeric($orderId)) {

    $conn->begin_transaction();

    try {
        // Lock the order row and grab what product/quantity it's for before rejecting it.
        $lookup = $conn->prepare("SELECT product_id, quantity FROM orders_tbl WHERE id = ? AND status = 'pending' FOR UPDATE");
        $lookup->bind_param("i", $orderId);
        $lookup->execute();
        $lookup->bind_result($productId, $orderedQty);
        $found = $lookup->fetch();
        $lookup->close();

        if (!$found) {
            throw new Exception("That order is no longer pending.");
        }

        $reject = $conn->prepare("UPDATE orders_tbl SET status = 'rejected' WHERE id = ?");
        $reject->bind_param("i", $orderId);
        $reject->execute();
        $reject->close();

        // Give the stock back to the product since the order didn't go through.
        $restock = $conn->prepare("UPDATE products_tbl SET quantity = quantity + ? WHERE id = ?");
        $restock->bind_param("ii", $orderedQty, $productId);
        $restock->execute();
        $restock->close();

        $conn->commit();
        header("Location: admin_dashboard.php");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        echo htmlspecialchars($e->getMessage());
    }

} else {
    echo "Invalid order ID.";
}

$conn->close();
?>