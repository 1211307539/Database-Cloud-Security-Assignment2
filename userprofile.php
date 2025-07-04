<?php
session_start();
include "connection.php"; // Must use PDO connection

if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION["USER_ID"];

$sql = "SELECT USER_ID, USER_EMAIL, CONCAT(USER_FNAME, ' ', USER_LNAME) AS USER_NAME, USER_CONTACT, USER_TYPE 
        FROM users 
        WHERE USER_ID = :userId";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>
    <link rel="icon" href="img/icon.ico" type="image/x-icon">

    <style>
        body {
            margin: 0;
        }

        header {
            background-color: powderblue;
            padding: 20px;
            margin: 0;
            color: black;
            box-sizing: border-box;
            height: 200px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .header-buttons {
            display: flex;
            gap: 20px;
            margin-left: auto;
            margin-top: 90px;
            font-size: 20px;
        }

        .button {
            padding: 0;
            border: none;
            cursor: pointer;
            background-color: transparent;
        }

        .button img {
            width: 40px;
            height: 40px;
        }

        .underline-button {
            position: relative;
            text-decoration: none;
            color: black;
        }

        .underline-button::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-color: #3498db;
            transform: scaleX(0);
            transform-origin: 100%;
            transition: transform 0.3s ease-in-out;
        }

        .underline-button:hover::after {
            transform: scaleX(1);
            transform-origin: 0%;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: hsl(155, 83%, 69%);
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-item {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: black;
        }

        .dropdown-item:hover {
            background-color: hsl(162, 68%, 49%);
        }

        .user-details {
            max-width: 800px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: powderblue;
        }
    </style>
</head>

<body>

    <header>
        <div>
        <a href="Thomepage.php" style="text-decoration: none; color: black;">
            <h1 style="font-size:100px; line-height:30%; margin-bottom:25px;">Heather‧࿐࿔ </h1>
        </a>
            <h2 style="font-size:22px;">Find the right cohabitation for you.</h2>
        </div>

        <div class="header-buttons">
            <a href="abouts.html" class="underline-button">About Us</a>
            <div class="dropdown">
                <a href="#" class="underline-button">Contact Us</a>
                <div class="dropdown-content">
                    <a href="mailto:1211103282@student.mmu.edu.my" class="dropdown-item">Aida</a>
                    <a href="mailto:1211103293@student.mmu.edu.my" class="dropdown-item">Farah</a>
                    <a href="mailto:1211307539@student.mmu.edu.my" class="dropdown-item">Amirah</a>
                </div>
            </div>
            <a href="bookingstat.php" class="underline-button">Booking Status</a>
            <button class="button" onclick="openChat()">
                <img src="img/chatbox.ico" alt="Chat Box">
            </button>
            <div class="dropdown">
                <button class="button"> <img src="img/user.ico" alt="User Profile"> </button>
                <div class="dropdown-content">
                    <a href="#" class="dropdown-item" onclick="redirectToUserProfile()">View Profile</a>
                    <a href="#" class="dropdown-item" onclick="redirectToHomepage()">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <?php if ($row): ?>
        <div class="user-details">
            <h1>User Profile</h1>
            <p><strong>User ID :</strong> <?= htmlspecialchars($row['USER_ID']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($row['USER_EMAIL']) ?></p>
            <p><strong>Name :</strong> <?= htmlspecialchars($row['USER_NAME']) ?></p>
            <p><strong>Contact Info :</strong> <?= htmlspecialchars($row['USER_CONTACT']) ?></p>
            <p><strong>Role :</strong> <?= htmlspecialchars($row['USER_TYPE']) ?></p>
        </div>
    <?php else: ?>
        <div class="user-details">
            <p>No user found.</p>
        </div>
    <?php endif; ?>


    <script>
        function openChat() {
            window.location.href = 'chatroom.php';
        }

        function redirectToUserProfile() {
            window.location.href = 'userprofile.php';
        }

        function redirectToHomepage() {
            window.location.href = 'homepage.php';
        }
    </script>
</body>
</html>
