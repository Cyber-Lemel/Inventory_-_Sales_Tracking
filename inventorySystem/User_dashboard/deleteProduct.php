<?php
require "../Sign-in/config.php";

$productId = $_GET["id"] ?? "";

if (!empty($productId) && is_numeric($productId)) {
    $stmt = $conn->prepare("DELETE FROM products_tbl WHERE id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        header("Location: user_dashboard.php"); // go back to dashboard after deleting
        exit();
    } else {
        echo "Error deleting product: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>