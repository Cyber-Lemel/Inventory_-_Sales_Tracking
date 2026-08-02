<?php
require "../Sign-Up/config.php";

// Only clears finished orders (accepted/rejected) — pending orders are left alone.
$stmt = $conn->prepare("DELETE FROM orders_tbl WHERE status IN ('accepted', 'rejected')");

if ($stmt->execute()) {
    header("Location: customer_dashboard.php");
    exit();
} else {
    echo "Error clearing order history: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>