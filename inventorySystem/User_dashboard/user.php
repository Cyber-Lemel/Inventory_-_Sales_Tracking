<?php

require "../Sign-in/config.php";

// Only accepted products show up in the category boards.
function getProductsByCategory($conn) {
    $sql = "SELECT id, product_name, category, price, quantity FROM products_tbl WHERE status = 'accepted' ORDER BY category, product_name";
    $result = $conn->query($sql);

    $products = [
        "Frozen" => [],
        "Pork"   => [],
        "Beef"   => []
    ];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cat = $row['category'];
            if (isset($products[$cat])) {
                $products[$cat][] = $row;
            }
        }
    }

    return $products;
}

// Products staff have added that an admin hasn't accepted yet.
function getPendingProducts($conn) {
    $sql = "SELECT id, product_name, category, price, quantity FROM products_tbl WHERE status = 'pending' ORDER BY id DESC";
    $result = $conn->query($sql);

    $pending = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pending[] = $row;
        }
    }

    return $pending;
}
?>