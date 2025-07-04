<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../connection.php"; // Make sure this sets up a valid $conn (PDO)

    $identifier = trim($_POST["email"]);
    $password = $_POST["password"];

    // Check if fields are empty
    if (empty($identifier) || empty($password)) {
        header("Location: adminLoginPage.php?error=" . urlencode("Please fill in all fields."));
        exit();
    }

    try {
        // Determine whether the input is an email or a contact number
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("SELECT TOP 1 * FROM heather.admins WHERE ADMIN_EMAIL = ?");
        } elseif (ctype_digit($identifier)) {
            $stmt = $conn->prepare("SELECT TOP 1 * FROM heather.admins WHERE ADMIN_CONTACT = ?");
        } else {
            header("Location: adminLoginPage.php?error=" . urlencode("Please enter a valid email or contact number."));
            exit();
        }

        $stmt->execute([$identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['ADMIN_PASS']) {
            session_regenerate_id(true);
            $_SESSION["USER_TYPE"] = $user["USER_TYPE"];
            $_SESSION["user"] = $user["ADMIN_EMAIL"];

            if ($user["USER_TYPE"] === "Admin") {
                header("Location: adminDashboard.php");
                exit();
            } else {
                header("Location: adminLoginPage.php?error=" . urlencode("Access denied for this user type."));
                exit();
            }
        } else {
            header("Location: adminLoginPage.php?error=" . urlencode("Incorrect email/phone number or password."));
            exit();
        }

    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        header("Location: adminLoginPage.php?error=" . urlencode("A database error occurred. Please try again later."));
        exit();
    }
} else {
    header("Location: adminLoginPage.php");
    exit();
}
?>
