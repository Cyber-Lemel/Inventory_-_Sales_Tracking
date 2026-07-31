<?php
require "../Sign-Up/config.php";

$productId = $_GET["id"] ?? "";

if (!empty($productId) && is_numeric($productId)) {
    // Only order products that are currently 'accepted' (visible in the catalog).
    // This also stops someone from re-ordering a product that's already pending
    // or double-clicking the order button.
    $stmt = $conn->prepare("UPDATE products_tbl SET status = 'pending' WHERE id = ? AND status = 'accepted'");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: customer_dashboard.php");
            exit();
        } else {
            // Query ran fine, but no row matched (bad id, or it's not 'accepted' anymore).
            echo "That product is no longer available to order.";
        }
    } else {
        echo "Error ordering product: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Invalid product ID.";
}

$conn->close();
?><?php
require "../Sign-Up/config.php";

$productId = $_GET["id"] ?? "";

if (!empty($productId) && is_numeric($productId)) {
    // Only order products that are currently 'accepted' (visible in the catalog).
    // This also stops someone from re-ordering a product that's already pending
    // or double-clicking the order button.
    $stmt = $conn->prepare("UPDATE products_tbl SET status = 'pending' WHERE id = ? AND status = 'accepted'");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: customer_dashboard.php");
            exit();
        } else {
            // Query ran fine, but no row matched (bad id, or it's not 'accepted' anymore).
            echo "That product is no longer available to order.";
        }
    } else {
        echo "Error ordering product: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>