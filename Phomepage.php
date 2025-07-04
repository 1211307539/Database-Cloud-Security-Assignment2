<?php
include "connection.php";
session_start();

if (!isset($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit();
}

$advertiserId = $_SESSION['USER_ID'];

// Use PDO for secure query
$stmt = $conn->prepare("SELECT * FROM property WHERE ADVERTISER_ID = :advertiserId");
$stmt->bindParam(':advertiserId', $advertiserId, PDO::PARAM_INT);
$stmt->execute();
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>
    <link rel="icon" href="icon.ico" type="image/x-icon">

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

        .container {
            box-sizing: border-box;
            width: 1200px;
            height: 100%;
            margin-top: 20px;
            overflow: hidden;
            margin-left: 80px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .personalized-content {
            text-align: left;
            font-size: 15px;
            margin-top: 15px;
            margin-left: 15px;
        }

        .addProp {
            padding: 5px;
            font-size: 15px;
            border-radius: 2px;
            background-color: powderblue;
            color: #000;
            border: 1px solid #000;
        }

    </style>
</head>

<body>

    <header>
        <div>
        <a href="Phomepage.php" style="text-decoration: none; color: black;">
            <h1 style="font-size:100px; line-height:30%; margin-bottom:25px;">Heather‧࿐࿔ </h1>
        </a>
            <h2 style="font-size:22px;">Find the right cohabitation for you.</h2>
        </div>

        <div class="header-buttons">
            <a href="abtus.html" class="underline-button">About Us</a>
            <div class="dropdown">
                <a href="#" class="underline-button">Contact Us</a>
                <div class="dropdown-content">
                    <a href="mailto:1211103282@student.mmu.edu.my" class="dropdown-item">Hanju</a>
                    <a href="mailto:1211103293@student.mmu.edu.my" class="dropdown-item">Farah</a>
                    <a href="mailto:1211307539@student.mmu.edu.my" class="dropdown-item">Amirah</a>
                </div>
            </div>
            <a href="updatebooking.html" class="underline-button">Booking Status</a>
            <button class="button" onclick="openChat()">
                <img src="img/chatbox.ico" alt="Chat Box">
            </button>
            <div class="dropdown">
                <button class="button"> <img class="button" src="img/user.ico" alt="User Profile"> </button>
                <div class="dropdown-content">
                    <a href="#" class="dropdown-item" onclick="redirectToUserProfile()">View Profile</a>
                    <a href="#" class="dropdown-item" onclick="redirectToHomepage()">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="personalized-content">
        <h2>Welcome back, <?php echo $_SESSION['USER_FNAME']; ?>!</h2>
    </div>

<div class="container">
    <h1>Your Properties</h1>

    <?php if ($properties): ?>
        <?php foreach ($properties as $property): ?>
            <div class="property-container">
                <img src="<?= htmlspecialchars($property['PROP_IMAGE']) ?>" alt="Property Image">
                <h2><?= htmlspecialchars($property['PROP_NAME']) ?></h2>
                <p><strong>Address:</strong> <?= htmlspecialchars($property['PROP_ADDRESS']) ?>, <?= htmlspecialchars($property['POSTCODE']) ?></p>
                <p><strong>Floor Area:</strong> <?= htmlspecialchars($property['FLOOR_AREA']) ?> sq ft</p>
                <p><strong>Rooms:</strong> <?= htmlspecialchars($property['ROOM_NUM']) ?></p>
                <p><strong>Description:</strong> <?= htmlspecialchars($property['PROP_DESCRIPTION']) ?></p>
                <p><strong>Price:</strong> RM <?= htmlspecialchars($property['PROP_PRICE']) ?></p>
                <p><strong>Rules:</strong> <?= htmlspecialchars($property['PROP_RULES']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($property['status']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have no properties listed.</p>
    <?php endif; ?>

    <button class="addProp" onclick="redirectToPortal()">Add Property</button>
</div>  

    <script>
        function openChat() {
            window.location.href = 'chatrooms.php';
        }

        function redirectToUserProfile() {
            window.location.href = 'advertiserprofile.php';
        }
        
        function redirectToHomepage() {
            window.location.href = 'homepage.php'
        }

        function redirectToPortal() {
            window.location.href = 'portal.php'
        }
    </script>

</body>

</html>
