<?php
    session_start(); 
    if (!isset($_SESSION['USER_ID'])) {
        header("Location: login.php");
        exit();
    }
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

        .searchButton {
            padding: 5px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

        .search-container {
            text-align: center;
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-left: 20px;
        }

        .search-text {
            margin-right: 10px;
            font-size: 20px;
        }

        .search-bar {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-right: 25px;
        }

        .personalized-content {
            text-align: left;
            font-size: 15px;
            margin-top: 15px;
            margin-left: 15px;
        }

        .property-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .property-container p { 
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis;
        }
    </style>
</head>

<body>

    <header>
        <div>
            <a href="Thomepage.php" style="text-decoration: none; color:black">
              <h1 style="font-size:100px; line-height:30%; margin-bottom:25px; margin-top: 10px;">Heather‧࿐࿔ </h1>
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

    <div class="personalized-content">
        <h2>Welcome back, <?php echo $_SESSION['USER_FNAME']; ?>!</h2>
    </div>

    <form method="post">
    <div class="search-container">
        <div class="search-wrapper">
            <span class="search-text">Area or Postcode</span>
            <input name="searchTerm" value="" type="text" class="search-bar" placeholder="Search">
            <button class="searchButton" name="search">Search</button>
        </div>
    </div>
    </form>

<?php
    include "connection.php"; // Make sure this uses PDO

    if (isset($_POST['search'])) {
        $searchTerm = $_POST['searchTerm'];
        $sqlSearch = "SELECT *, CONCAT(users.USER_FNAME, ' ', users.USER_LNAME) AS user_name  
                      FROM property
                      INNER JOIN users ON property.ADVERTISER_ID = users.USER_ID
                      WHERE (POSTCODE = :search OR PROP_ADDRESS LIKE :likeTerm OR PROP_NAME LIKE :likeTerm)
                      AND status = 'available'";

        $stmt = $conn->prepare($sqlSearch);
        $likeTerm = '%' . $searchTerm . '%';
        $stmt->bindParam(':search', $searchTerm);
        $stmt->bindParam(':likeTerm', $likeTerm);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            foreach ($results as $row) {
                ?>
                <div class="property-container">
                    <h1><?php echo htmlspecialchars($row['PROP_NAME']); ?></h1>
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Property Image" style="max-width: 100%; height: auto;">
                    <p><strong>Property Advertiser:</strong> <?php echo htmlspecialchars($row['user_name']); ?></p>
                    <p><strong>Property Address:</strong> <?php echo htmlspecialchars($row['PROP_ADDRESS']); ?></p>
                    <p><strong>Postcode:</strong> <?php echo htmlspecialchars($row['POSTCODE']); ?></p>
                    <p><strong>Floor Area (in square metre):</strong> <?php echo htmlspecialchars($row['FLOOR_AREA']); ?></p>
                    <p><strong>Room Number:</strong> <?php echo htmlspecialchars($row['ROOM_NUM']); ?></p>
                    <p><strong>Property Description:</strong> <?php echo htmlspecialchars($row['PROP_DESCRIPTION']); ?></p>
                    <p><strong>Property Price:</strong> <?php echo htmlspecialchars($row['PROP_PRICE']); ?></p>
                    <p><strong>Property Rules:</strong> <?php echo htmlspecialchars($row['PROP_RULES']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                    <button class="searchButton" onclick="view(<?php echo $row['PROP_ID']; ?>)">View the Rooms!</button>
                </div>
                <?php
            }
        } else {
            echo '<p>No properties found matching your search.</p>';
        }
    } else {
        $sql = "SELECT *, CONCAT(users.USER_FNAME, ' ', users.USER_LNAME) AS user_name 
                FROM property 
                INNER JOIN users ON property.ADVERTISER_ID = users.USER_ID
                WHERE status = 'available'";
        $stmt = $conn->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            foreach ($results as $row) {
                ?>
                <div class="property-container">
                    <h1><?php echo htmlspecialchars($row['PROP_NAME']); ?></h1>
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Property Image" style="max-width: 100%; height: auto;">
                    <p><strong>Property Advertiser:</strong> <?php echo htmlspecialchars($row['user_name']); ?></p>
                    <p><strong>Property Address:</strong> <?php echo htmlspecialchars($row['PROP_ADDRESS']); ?></p>
                    <p><strong>Postcode:</strong> <?php echo htmlspecialchars($row['POSTCODE']); ?></p>
                    <p><strong>Floor Area (in square metre):</strong> <?php echo htmlspecialchars($row['FLOOR_AREA']); ?></p>
                    <p><strong>Room Number:</strong> <?php echo htmlspecialchars($row['ROOM_NUM']); ?></p>
                    <p><strong>Property Description:</strong> <?php echo htmlspecialchars($row['PROP_DESCRIPTION']); ?></p>
                    <p><strong>Property Price:</strong> <?php echo htmlspecialchars($row['PROP_PRICE']); ?></p>
                    <p><strong>Property Rules:</strong> <?php echo htmlspecialchars($row['PROP_RULES']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                    <button class="searchButton" onclick="view(<?php echo $row['PROP_ID']; ?>)">View the Rooms!</button>
                </div>
                <?php
            }
        } else {
            echo "No properties found.";
        }
    }
    ?>

    <script>
        function view(propId){
            window.location.href = 'propertyDetails.php?PROP_ID=' + propId;
        }

        function openChat() {
            window.location.href = 'chatroom.php';
        }

        function redirectToUserProfile() {
            var userId = "<?php echo $_SESSION['USER_ID']; ?>";
            window.location.href = 'userprofile.php?USER_ID=' + userId;
        }

        function redirectToHomepage() {
            window.location.href = 'homepage.php';
        }
    </script>

</body>
</html>
