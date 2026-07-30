<?php
require "../Sign-in/config.php";

$productId = $_GET["id"] ?? "";

if (!empty($productId) && is_numeric($productId)) {
    $stmt = $conn->prepare("UPDATE products_tbl SET status = 'accepted' WHERE id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        header("Location: ../Admin_dashboard/admin_dashboard.php");
        exit();
    } else {
        echo "Error accepting product: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>