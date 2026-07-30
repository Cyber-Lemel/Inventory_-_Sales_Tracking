<?php
    require "../Sign-in/config.php";

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $productName = trim($_POST["product_name"] ?? "");
        $productCategory = trim($_POST["category"] ?? "");
        $productPrice = trim($_POST["price"] ?? "");
        $productQuantity = trim($_POST["quantity"] ?? "");

        $errors = [];

        if (empty($productName)) {
            $errors[] = "Product name is required.";
        }

        if (empty($productCategory)) {
            $errors[] = "Product category is required.";
        }

        if (empty($productPrice) || !is_numeric($productPrice) || $productPrice < 0) {
            $errors[] = "Please enter a valid product price.";
        }

        if (empty($productQuantity) || !is_numeric($productQuantity) || $productQuantity < 0) {
            $errors[] = "Please enter a valid product quantity.";
        }

        if (empty($errors)) {
            // New products always start as "pending" until an admin accepts them.
            $stmt = $conn->prepare("INSERT INTO products_tbl (product_name, category, price, quantity, status) VALUES (?, ?, ?, ?, 'pending')");
            $stmt->bind_param("ssdi", $productName, $productCategory, $productPrice, $productQuantity);

            if ($stmt->execute()) {
                echo "<h3>Success!</h3>";
                echo "<p>Product added: " . htmlspecialchars($productName) . " (" . htmlspecialchars($productCategory) . "). It will appear in the store once an admin accepts it.</p>";
                echo '<p><a href="user_dashboard.php">Back to dashboard</a></p>';
                header("Location: user_dashboard.php");
            } else {
                echo "<h3>Something went wrong:</h3>";
                echo "<p>" . htmlspecialchars($stmt->error) . "</p>";
            }
            $stmt->close();
        } else {
            foreach ($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p>";
            }
            echo '<p><a href="addproduct.html">Back to form</a></p>';
        }
    }
?>