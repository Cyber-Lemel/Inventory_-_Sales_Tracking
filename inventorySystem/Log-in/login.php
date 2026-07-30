<?php

require "../Sign-in/config.php";

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

function getUserByEmail($email) {
    global $conn;

    $email = sanitizeInput($email);
    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = isset($_POST['username']) ? sanitizeInput($_POST['username']) : "";
    $email    = isset($_POST['email']) ? sanitizeInput($_POST['email']) : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $user = getUserByEmail($email);

        if ($user === null) {
            $error = "Invalid email or password.";
        } elseif (!password_verify($password, $user['password'])) {
            $error = "Invalid email or password.";
        } else {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email']    = $user['email'];
            $_SESSION['role']     = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        }
    }
}

?>