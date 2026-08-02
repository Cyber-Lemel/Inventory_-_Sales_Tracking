<?php
require "../Sign-Up/config.php";

$orderId = $_GET["id"] ?? "";

if (!empty($orderId) && is_numeric($orderId)) {
    $stmt = $conn->prepare("UPDATE orders_tbl SET status = 'accepted' WHERE id = ? AND status = 'pending'");
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "That order is no longer pending.";
        }
    } else {
        echo "Error accepting order: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Invalid order ID.";
}

$conn->close();
?>