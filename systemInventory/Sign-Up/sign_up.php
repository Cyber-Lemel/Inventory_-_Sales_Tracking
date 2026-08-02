<?php

require "config.php"; // gives us $conn

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $role = trim($_POST["role"] ?? "");
    $email = trim($_POST["email"] ?? "");

    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (!in_array($role, ["Customer", "Admin"])) {
        $errors[] = "Please select a valid role.";
    }
    if(empty($email)){
        $errors[] = "Email is required.";
    }

    // Check if the username already exists
    if (empty($errors)) {
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $errors[] = "That username is already taken.";
        }
        $checkStmt->close();
    }

    if (empty($errors)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, role, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashedPassword, $role, $email);

        if ($stmt->execute()) {
            if($role === "Admin"){
                header("Location: ../Admin_dashboard/admin_dashboard.php");
            } else {
                header("Location: ../Customer_dashboard/customer_dashboard.php");
            }
        } else {
            echo "<h3>Something went wrong:</h3>";
            echo "<p>" . htmlspecialchars($stmt->error) . "</p>";
        }

        $stmt->close();
    } else {
        echo "<h3>Please fix the following errors:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="sign_up.html">Go back</a></p>';
    }

    $conn->close();

} else {
    header("Location: sign_up.html");
    exit();
}