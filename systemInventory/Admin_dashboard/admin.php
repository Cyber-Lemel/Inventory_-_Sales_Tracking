<?php

require "../Sign-Up/config.php";

// Only accepted, in-stock products show up in the category boards.
function getProductsByCategory($conn) {
    $sql = "SELECT id, product_name, category, price, quantity FROM products_tbl WHERE status = 'accepted' AND quantity > 0 ORDER BY category, product_name";
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

// Orders customers have placed that an admin hasn't accepted or rejected yet.
// Used on the admin dashboard's "Orders" panel.
function getPendingOrders($conn) {
    $sql = "SELECT o.id, o.quantity, o.status, p.product_name, p.category, p.price,
                   (p.price * o.quantity) AS total_price
            FROM orders_tbl o
            JOIN products_tbl p ON o.product_id = p.id
            WHERE o.status = 'pending'
            ORDER BY o.created_at DESC";
    $result = $conn->query($sql);

    $orders = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}

// Orders a customer is still waiting on (not yet accepted or rejected).
// Used on the customer dashboard's "Your Orders Status" panel.
function getCustomerOrders($conn) {
    $sql = "SELECT o.id, o.quantity, o.status, p.product_name, p.category, p.price,
                   (p.price * o.quantity) AS total_price
            FROM orders_tbl o
            JOIN products_tbl p ON o.product_id = p.id
            WHERE o.status = 'pending'
            ORDER BY o.created_at DESC";
    $result = $conn->query($sql);

    $orders = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}

// Orders that have already been accepted or rejected, combined per product name + outcome
// so reordering the same-named item (even if it was re-added as a new product row)
// still merges into one history line instead of fragmenting.
// Used on the customer dashboard's "Order History" panel.
function getCustomerOrderHistory($conn) {
    $sql = "SELECT p.product_name,
                   MAX(p.category) AS category,
                   o.status,
                   SUM(o.quantity) AS quantity,
                   SUM(o.quantity * p.price) AS total_price,
                   ROUND(SUM(o.quantity * p.price) / SUM(o.quantity), 2) AS price
            FROM orders_tbl o
            JOIN products_tbl p ON o.product_id = p.id
            WHERE o.status IN ('accepted', 'rejected')
            GROUP BY p.product_name, o.status
            ORDER BY MAX(o.created_at) DESC";
    $result = $conn->query($sql);

    $history = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    }

    return $history;
}
// Products sold — orders an admin has accepted, grouped by category then by product name
// so repeat sales of the same item show as one running total, and categories can be
// compared side by side. Used on the admin dashboard's "Sales" panel.
function getSales($conn) {
    $sql = "SELECT p.category, p.product_name,
                   SUM(o.quantity) AS quantity_sold,
                   SUM(o.quantity * p.price) AS total_sales
            FROM orders_tbl o
            JOIN products_tbl p ON o.product_id = p.id
            WHERE o.status = 'accepted'
            GROUP BY p.category, p.product_name
            ORDER BY p.category, total_sales DESC";
    $result = $conn->query($sql);

    $sales = [
        "Frozen" => [],
        "Pork"   => [],
        "Beef"   => []
    ];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cat = $row['category'];
            if (isset($sales[$cat])) {
                $sales[$cat][] = $row;
            }
        }
    }

    return $sales;
}
?>