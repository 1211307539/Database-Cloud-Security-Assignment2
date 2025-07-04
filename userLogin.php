<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connection.php"; // Ensure this uses PDO

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Fill in the blank");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE (USER_EMAIL = :email OR USER_CONTACT = :email) AND USER_PASS = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // You should hash passwords instead of storing plain text
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $role = $row["USER_TYPE"];

            $_SESSION["USER_ID"] = $row["USER_ID"];
            $_SESSION["USER_TYPE"] = $role;
            $_SESSION["USER_FNAME"] = $row["USER_FNAME"];
            $_SESSION["user"] = $email;

            switch ($role) {
                case "Tenant":
                    header("Location: Thomepage.php");
                    break;
                case "Advertiser":
                    header("Location: Phomepage.php");
                    break;
                default:
                    echo "Unknown user role.";
                    break;
            }
        } else {
            header("Location: login.php?error=Incorrect email/phone-number or password.");
            exit();
        }
    }
}
?>
